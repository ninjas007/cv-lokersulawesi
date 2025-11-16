<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $jobs = Job::orderBy('publish_on_date', 'desc')->limit($this->perPage)->offset($request->offset);

        if ($request->keyword != '') {
            $jobs = $jobs->where('title', 'like', '%' . $request->keyword . '%');
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

    public function getUserInfoLinkedin()
    {
        $settings = DB::table('settings')->get()->keyBy('key');
        $linkedinAccessToken = $settings['LINKEDIN_ACCESS_TOKEN']->value;
        $client = new Client();
        $response = $client->request('GET', 'https://api.linkedin.com/v2/userinfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $linkedinAccessToken,
            ],
        ]);

        return $response->getBody()->getContents();
    }

    public function getTokenLinkedin()
    {
        $client = new Client();
        $response = $client->request('POST', 'https://www.linkedin.com/oauth/v2/accessToken', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('LINKEDIN_CLIENT_ID'),
                'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
            ],
        ]);

        return $response->getBody();
    }

    public function updatePostLinkedin($id)
    {
        $job = Job::find($id);
        $job->post_linkedin = 1;
        $job->save();
    }

    public function postToFacebook($job)
    {
        try
        {
            $client = new Client();
            $settings = DB::table('settings')->get()->keyBy('key');
            $facebookAccessTokenLongtime = $settings['FACEBOOK_ACCESS_TOKEN_LONGTIME']->value;
            $response = $client->request('POST', 'https://graph.facebook.com/v22.0/116352099737875/photos', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'access_token' => $facebookAccessTokenLongtime,
                    'url' => $job->image,
                    'caption' => $job->company_name . ' Sedang Membutuhkan: ' . $job->title . '\n' . 'Selengkapnya https://lokersulawesi.com/lowongan/' . $job->slug . '\n'
                ],
            ]);

            return $response->getBody();
        } catch (\Exception $e) {
            Log::error("message post facebook", $e->getMessage());
        }
    }

    public function postToLinkedinWithoutDescription($job)
    {
        try
        {
            $settings = DB::table('settings')->get()->keyBy('key');
            $linkedinAccessToken = $settings['LINKEDIN_ACCESS_TOKEN']->value;
            $client = new Client();
            $response = $client->request('POST', 'https://api.linkedin.com/v2/shares', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $linkedinAccessToken,
                    'X-Restli-Protocol-Version' => '2.0.0',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'owner' => 'urn:li:person:sAQ_4I23Xp', // Sesuaikan dengan LinkedIn ID
                    'subject' => $job->company_name . ' - ' . $job->title,
                    'text' => [
                        'text' => $job->company_name . ' Sedang Membutuhkan: ' . $job->title
                    ],
                    'content' => [
                        'contentEntities' => [
                            [
                                'entityLocation' => 'https://lokersulawesi.com/lowongan/' . $job->slug,
                                'thumbnails' => [
                                    [
                                        'resolvedUrl' =>  $job->image
                                    ]
                                ]
                            ]
                        ],
                        'title' => $job->company_name . ' - ' . $job->title
                    ]
                ],
            ]);

            return $response->getBody();
        }
        catch (\Exception $e) {
            Log::error("message post linkedin without description", $e->getMessage());
        }
    }

    public function postToLinkedin($job)
    {
        try
        {
            $textDescription = $this->formatText($job->company_name, $job->description, $job->title);
            $settings = DB::table('settings')->get()->keyBy('key');
            $linkedinAccessToken = $settings['LINKEDIN_ACCESS_TOKEN']->value;
            $maxLength = 500;
            if (strlen($textDescription) > $maxLength) {
                $textDescription = substr($textDescription, 0, $maxLength) . ".... Lihat selengkapnya https://lokersulawesi.com/lowongan/" . $job->slug;
            }

            $client = new Client();
            $response = $client->request('POST', 'https://api.linkedin.com/v2/shares', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $linkedinAccessToken,
                    'X-Restli-Protocol-Version' => '2.0.0',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'owner' => 'urn:li:person:sAQ_4I23Xp', // Sesuaikan dengan LinkedIn ID
                    'subject' => $job->company_name . ' - ' . $job->title,
                    'text' => [
                        // 'text' => 'Perusahaan ' . $job->company_name . ' sedang membutuhkan ' . $job->title
                        'text' => $textDescription
                    ],
                    'content' => [
                        'contentEntities' => [
                            [
                                'entityLocation' => 'https://lokersulawesi.com/lowongan/' . $job->slug,
                                'thumbnails' => [
                                    [
                                        'resolvedUrl' =>  $job->image
                                    ]
                                ]
                            ]
                        ],
                        'title' => $job->company_name . ' - ' . $job->title
                    ]
                ],
            ]);

            return $response->getBody();
        }
        catch (\Exception $e)
        {
            Log::error("message post linkedin", $e->getMessage());
        }
    }

    private function formatText($company, $decription, $title)
    {
        // company name
        $text1 = $company . "\n\n";

        // title
        $text1 .= "Sedang Membutuhkan: " . $title . "\n\n";

        // Convert <strong> tags to bold with **
        $text = preg_replace('/<strong>(.*?)<\/strong>/', "$1", $decription);

        // Replace <li> tags with "- " and a newline
        $text = preg_replace('/<li>(.*?)<\/li>/', "- $1\n", $text);

        // Replace <ol>, <ul>, and </ol>, </ul> with a newline
        $text = preg_replace('/<\/?(ol|ul)>/', '', $text);

        // Replace <p> tags with a newline
        $text = preg_replace('/<p>(.*?)<\/p>/', "$1\n", $text);

        // Replace &nbsp; with a newline
        $text = preg_replace('/&nbsp;/', "\n\n", $text);

        // Remove any remaining HTML tags
        $text = strip_tags($text);

        // Replace multiple newlines with a single newline
        $text = preg_replace('/\n+/', "\n", $text);

        // Trim leading and trailing whitespace
        $text = trim($text);

        return $text1 . $text;
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
