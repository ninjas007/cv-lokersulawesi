<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Job;

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
        $jobs = Job::orderBy('publish_on')->limit($this->perPage)->offset($request->offset);

        if ($request->keyword != '') {
            $jobs = $jobs->where('title', 'like', '%'.$request->keyword.'%');
        }

        $jobs = $jobs->get();

        if ($request->ajax()) {
            $viewHtml = view('jobs.list2', [
                'jobs' => $jobs,
            ])->render();

            return response()->json([
                'jobs' => $viewHtml,
                'countJobs' => count($jobs),
            ], 200);
        }

        return view('jobs.index2', [
            'jobs' => $jobs
        ]);
    }

    public function show(Request $request, $slug)
    {
        $job = Job::where('slug', $slug)->first();

        if (!$job) {
            abort(404);
        }

        return view('jobs.show', ['job' => $job]);
    }

    // public function index(Request $request)
    // {
    //     while ($this->attempt < $this->maxRetries) {
    //         try {
    //             $client = new Client();
    //             $endpoint = 'https://lokersulawesi.com/wp-json/wp/v2/job-listings?per_page='.$this->perPage;

    //             if ($request->has('offset')) {
    //                 $endpoint .= '&offset='.$request->input('offset');
    //             }

    //             if ($request->keyword != '') {
    //                 $endpoint .= '&search='.$request->input('keyword');
    //             }

    //             $response = $client->request('GET', $endpoint);
    //             $res = $response->getBody()->getContents();

    //             $result = collect(json_decode($res, true))->map(function ($item) {
    //                 $jobTypes = $this->jobTypes($item['job-types']);
    //                 return [
    //                     // 'id' => $item['id'],
    //                     'image' => $item['yoast_head_json']['og_image'][0]['url'] ?? asset('assets/images/default-lowongan.png'),
    //                     'title' => $item['title']['rendered'] ?? '',
    //                     'company' => $item['meta']['_company_name']  ?? 'Tidak diketahui',
    //                     'location' => $item['meta']['_job_location'] != '' ? $item['meta']['_job_location'] : 'Tidak diketahui',
    //                     'slug' => $item['slug'] ?? '',
    //                     'job_types' => $jobTypes,
    //                     'gaji' => $item['meta']['_job_salary'] != ''  ? 'Rp. '. $this->formatHuruf($item['meta']['_job_salary']) : '',
    //                     'status' => $item['status'],
    //                     'created_at' => $item['date'],
    //                     'publish_on' => Carbon::parse($item['date'])->diffForHumans(),
    //                 ];
    //             })
    //             ->toArray();

    //             if ($request->ajax()) {
    //                 $viewHtml = view('jobs.list', [
    //                     'jobs' => $result,
    //                 ])->render();

    //                 return response()->json([
    //                     'jobs' => $viewHtml,
    //                     'countJobs' => count($result),
    //                 ], 200);
    //             }

    //             return view('jobs.index');
    //         } catch (\Exception $e) {
    //             $this->attempt++;
    //             if ($this->attempt >= $this->maxRetries) {
    //                 if (config('app.debug')) {
    //                     return $e->getMessage();
    //                 }

    //                 return abort(500);
    //             }
    //         }
    //     }
    // }

    // public function show(Request $request, $slug)
    // {
    //     while ($this->attempt < $this->maxRetries) {
    //         try {
    //             $client = new Client();
    //             $endpoint = 'https://lokersulawesi.com/wp-json/wp/v2/job-listings?slug='.$slug;
    //             $response = $client->request('GET', $endpoint);
    //             $res = $response->getBody()->getContents();

    //             $result = collect(json_decode($res, true))->transform(function ($item) {
    //                 $jobTypes = $this->jobTypes($item['job-types']);
    //                 return [
    //                     'id' => $item['id'],
    //                     'image' => $item['yoast_head_json']['og_image'][0]['url'] ?? asset('assets/images/default-lowongan.png'),
    //                     'title' => $item['title']['rendered'] ?? '',
    //                     'company' => $item['meta']['_company_name']  ?? 'Tidak Diketahui',
    //                     'content' => $item['content']['rendered'] ?? '',
    //                     'location' => $item['meta']['_job_location']  ?? 'Seluruh Sulawesi',
    //                     'yoast_head' => $item['yoast_head'] ?? '',
    //                     'slug' => $item['slug'] ?? '',
    //                     'job_types' => $jobTypes,
    //                     'status' => $item['status'],
    //                     'created_at' => $item['date'],
    //                     'publish_on' => Carbon::parse($item['date'])->diffForHumans(),
    //                 ];
    //             })
    //             ->first();

    //             return view('jobs.show', ['job' => $result]);
    //         } catch (\Exception $e) {
    //             $this->attempt++;
    //             if ($this->attempt >= $this->maxRetries) {
    //                 if (config('app.debug')) {
    //                     return $e->getMessage();
    //                 }

    //                 return '<div class="alert alert-danger">Server Error</div>';
    //             }
    //         }
    //     }
    // }

    public function pasangLowongan(Request $request)
    {
        try {
            // $client = new Client();
            // $endpoint = 'https://lokersulawesi.com/wp-json/wp/v2/pages/7';
            // $response = $client->request('GET', $endpoint);
            // $res = $response->getBody()->getContents();


            // $content = collect(json_decode($res));
            // return view('jobs.test', [
            //     'content' => $content['content']->rendered
            // ]);
            return view('jobs.pasang-lowongan', [
                'jobTypes' => $this->jobTypes(),
                'action' => 'https://lokersulawesi.com/wp-json/wp/v2/pages/7',
            ]);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $e->getMessage();
            }

            return abort(500);
        }
    }

    public function postLoker(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
            'lokasi_pekerjaan' => 'required',
            'tipe_pekerjaan' => 'required|in:2,3,4,5,6',
            'deskripsi_pekerjaan' => 'required',
            'gaji' => 'nullable|numeric',
            'nama_perusahaan' => 'required',
            // 'logo_perusahaan' => 'sometimes|image|mimes:jpeg,png,jpg|max:512',
        ], [
            'logo_perusahaan.max' => 'Ukuran gambar melebihi batas',
            'nama_pekerjaan.required' => 'Tidak boleh kosong',
            'lokasi_pekerjaan.required' => 'Tidak boleh kosong',
            'gaji.numeric' => 'Gaji harus berupa angka',
            'tipe_pekerjaan.required' => 'Tidak boleh kosong',
            'deskripsi_pekerjaan.required' => 'Tidak boleh kosong',
            'nama_perusahaan.required' => 'Tidak boleh kosong',
            // 'logo_perusahaan.image' => 'File harus berupa gambar',
            // 'logo_perusahaan.mimes' => 'File harus berupa jpeg, png, jpg',
            'tipe_pekerjaan.in' => 'Tipe pekerjaan tidak valid',
        ]);

        $this->attempt = 0;

        $username = 'tiliztiadi@gmail.com';
        $password = 'Pa55w0rd1993!@#';
        while ($this->attempt < $this->maxRetries) {
           try {
                $client = new Client();
                $endpoint = 'https://lokersulawesi.com/wp-json/wp/v2/pages/7';
                $response = $client->request('POST', $endpoint, [
                    'password' => $password,
                    'username' => $username,
                ]);
                $res = $response->getBody()->getContents();
                // Proses $res sesuai kebutuhan
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // Penanganan kesalahan request
                echo $e->getMessage();
            } catch (\Exception $e) {
                // Penanganan kesalahan umum
                echo $e->getMessage();
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

    private function formatHuruf($gaji)
    {
        $satuan = ['', 'Ribu', 'Juta', 'Miliar'];
        $angka = floor($gaji ?? 0);

        if ($angka == 0) {
            return '0';
        }

        $hasil = '';
        $i = 0;

        while ($angka > 0) {
            $mod = $angka % 1000;
            if ($mod != 0) {
                $hasil = $mod . ' ' . $satuan[$i] . ' ' . $hasil;
            }
            $angka = floor($angka / 1000);
            $i++;
        }

        return trim($hasil);
    }
}

// List API

// https://lokersulawesi.com/wp-json/wp/v2/pages - pages
// https://lokersulawesi.com/wp-json/wp/v2/job-listings - List Job
// https://lokersulawesi.com/wp-json/wp/v2/job-types - List Job Types
// https://lokersulawesi.com/wp-json/wp/v2/media/8310 - Gambar berdasarkan ID
