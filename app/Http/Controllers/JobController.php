<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $maxRetries;
    protected $attempt;
    protected $perPage;

    public function __construct()
    {
        $this->maxRetries = 3;
        $this->perPage = 10;
        $this->attempt = 0;
    }

    public function index(Request $request)
    {
        while ($this->attempt < $this->maxRetries) {
            try {
                $client = new Client();
                $endpoint = 'https://lokersulawesi.com/wp-json/wp/v2/job-listings?per_page='.$this->perPage;
                $response = $client->request('GET', $endpoint);
                $res = $response->getBody()->getContents();

                if ($request->has('offset')) {
                    $endpoint .= '&offset='.$request->input('offset');
                }

                $response = $client->request('GET', $endpoint);
                $res = $response->getBody()->getContents();

                $result = collect(json_decode($res, true))->map(function ($item) {
                    $jobTypes = $this->jobTypes($item['job-types']);
                    return [
                        // 'id' => $item['id'],
                        'image' => $item['yoast_head_json']['og_image'][0]['url'] ?? asset('assets/images/default-lowongan.png'),
                        'title' => $item['title']['rendered'] ?? '',
                        'company' => $item['meta']['_company_name']  ?? 'Tidak Diketahui',
                        'location' => $item['meta']['_job_location']  ?? 'Seluruh Sulawesi',
                        'slug' => $item['slug'] ?? '',
                        'job_types' => $jobTypes,
                        'status' => $item['status'],
                        'created_at' => $item['date'],
                        'publish_on' => Carbon::parse($item['date'])->diffForHumans(),
                    ];
                })
                ->toArray();

                if ($request->ajax()) {
                    $viewHtml = view('jobs.list', [
                        'jobs' => $result,
                    ])->render();

                    return response()->json($viewHtml);
                }

                return view('jobs.index');
            } catch (\Exception $e) {
                $this->attempt++;
                if ($this->attempt >= $this->maxRetries) {
                    if (config('app.debug')) {
                        return $e->getMessage();
                    }

                    return abort(404);
                }
            }
        }
    }

    public function show(Request $request, $slug)
    {
        while ($this->attempt < $this->maxRetries) {
            try {
                $client = new Client();
                $endpoint = 'https://lokersulawesi.com/wp-json/wp/v2/job-listings?slug='.$slug;
                $response = $client->request('GET', $endpoint);
                $res = $response->getBody()->getContents();

                $result = collect(json_decode($res, true))->transform(function ($item) {
                    $jobTypes = $this->jobTypes($item['job-types']);
                    return [
                        'id' => $item['id'],
                        'image' => $item['yoast_head_json']['og_image'][0]['url'] ?? asset('assets/images/default-lowongan.png'),
                        'title' => $item['title']['rendered'] ?? '',
                        'company' => $item['meta']['_company_name']  ?? 'Tidak Diketahui',
                        'content' => $item['content']['rendered'] ?? '',
                        'location' => $item['meta']['_job_location']  ?? 'Seluruh Sulawesi',
                        'yoast_head' => $item['yoast_head'] ?? '',
                        'slug' => $item['slug'] ?? '',
                        'job_types' => $jobTypes,
                        'status' => $item['status'],
                        'created_at' => $item['date'],
                        'publish_on' => Carbon::parse($item['date'])->diffForHumans(),
                    ];
                })
                ->first();

                return view('jobs.show', ['job' => $result]);
            } catch (\Exception $e) {
                $this->attempt++;
                if ($this->attempt >= $this->maxRetries) {
                    if (config('app.debug')) {
                        return $e->getMessage();
                    }

                    return abort(404);
                }
            }
        }
    }

    public function jobTypes($types = [])
    {
        $jobTypes = [
            2 => [
                "name" => 'Full Time',
                "html_name" => '<div class="badge badge-success">Full Time</div>',
                "slug" => "full-time",
            ],
            3 => [
                "name" => 'Part Time',
                "html_name" => '<div class="badge badge-info">Part Time</div>',
                "slug" => "part-time",
            ],
            4 => [
                "name" => 'Temporary',
                "html_name" => '<div class="badge badge-warning">Temporary</div>',
                "slug" => "temporary",
            ],
            5 => [
                "name" => 'Freelance',
                "html_name" => '<div class="badge badge-primary">Freelance</div>',
                "slug" => "freelance",
            ],
            6 => [
                "name" => 'Internship',
                "html_name" => '<div class="badge badge-danger">Internship</div>',
                "slug" => "internship",
            ]
        ];

        if (count($types) > 0) {
            $listType = [];
            foreach ($types as $typeId) {
                $listType[$typeId] = $jobTypes[$typeId];
            }

            return $listType;
        }

        return $jobTypes;
    }
}

// List API

// https://lokersulawesi.com/wp-json/wp/v2/job-listings - List Job
// https://lokersulawesi.com/wp-json/wp/v2/job-types - List Job Types
// https://lokersulawesi.com/wp-json/wp/v2/media/8310 - Gambar berdasarkan ID
