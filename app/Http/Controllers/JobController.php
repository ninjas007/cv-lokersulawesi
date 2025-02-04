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

    public function getUserInfo()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.linkedin.com/v2/userinfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('LINKEDIN_ACCESS_TOKEN'),
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
        $client = new Client();
        $response = $client->request('POST', 'https://graph.facebook.com/v22.0/116352099737875/photos', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'access_token' => env('FACEBOOK_ACCESS_TOKEN_LONGTIME'),
                'url' => $job->image,
                'caption' => $job->company_name . ' Sedang Membutuhkan: ' . $job->title . '\n' . 'Selengkapnya https://lokersulawesi.com/lowongan/' . $job->slug . '\n'
            ],
        ]);

        return $response->getBody();
    }

    public function postToLinkedinWithoutDescription($job)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://api.linkedin.com/v2/shares', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('LINKEDIN_ACCESS_TOKEN'),
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

    public function postToLinkedin($job)
    {
        $textDescription = $this->formatText($job->company_name, $job->description, $job->title);
        $maxLength = 500;
        if (strlen($textDescription) > $maxLength) {
            $textDescription = substr($textDescription, 0, $maxLength) . ".... Lihat selengkapnya https://lokersulawesi.com/lowongan/" . $job->slug;
        }

        $client = new Client();
        $response = $client->request('POST', 'https://api.linkedin.com/v2/shares', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('LINKEDIN_ACCESS_TOKEN'),
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

        // $response = $client->request('POST', 'https://api.linkedin.com/v2/ugcPosts', [
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . env('LINKEDIN_ACCESS_TOKEN'),
        //         'X-Restli-Protocol-Version' => '2.0.0',
        //         'Content-Type' => 'application/json',
        //     ],
        //     'json' => [
        //         'author' => 'urn:li:person:sAQ_4I23Xp',
        //         'lifecycleState' => 'PUBLISHED',
        //         'specificContent' => [
        //             'com.linkedin.ugc.ShareContent' => [
        //                 'shareCommentary' => [
        //                     'text' => $textDescription,
        //                 ],
        //                 'shareMediaCategory' => 'ARTICLE',
        //                 'media' => [
        //                     [
        //                         'status' => 'READY',
        //                         'description' => [
        //                             'text' => $job->company_name . ' - ' . $job->title,
        //                         ],
        //                         'originalUrl' => 'https://lokersulawesi.com/lowongan/' . $job->slug,
        //                         'title' => [
        //                             'text' => $job->company_name . ' - ' . $job->title,
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         'visibility' => [
        //             'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
        //         ],
        //     ],
        // ]);

        return $response->getBody();
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

// {
//     "author": "urn:li:person:sAQ_4I23Xp",
//     "lifecycleState": "PUBLISHED",
//     "specificContent": {
//         "com.linkedin.ugc.ShareContent": {
//             "shareCommentary": {
//                 "text": "Requirements:\n- Bachelor’s Degree in a food – related discipline, such as Food Science/Nutritional backgrounds, Microbiology, Chemistry, or Food Industry Management.\n- Junior Manager: Minimum 5 years working experience in the related field and Supervisor or Managerial Level. Willing to be placed HO Malang, Jawa Timur.\n- Supervisor: Minimum 3 years working experience in the related field and Supervisor or Managerial Level. Willing to be placed in Area Makassar, Sulawesi.\n- Have a good knowledge and experienced of Food Hygiene & Food Safety Standard, HACCP, and Halal\n- Good analytical thinking, good team player with interpersonal communication skills.\n\nJob Responsibilities:\n\nJunior Manager:\n- To responsible to lead QA Ops Supervisor (regional/national)\n- To create and improve new procedures, standards, and specifications aimed at meeting a company’s food quality goals in restaurant or operational scopes\n- To responsible to document food safety management & halal assurance system.\n- To develop and review quality and safety policies and manage audits by third-party inspectors.\n- Prepare reports on food safety & quality status to relay to CI & Food Safety Group Head and may keep records of all tests and inspections that have been conducted.\n- To evaluate the food safety complaints and ensuring appropriate corrective & preventive actions.\n- Implements training and awareness programs to ensure employees are up-to-date with food quality & safety systems and requirements (HACCP, Halal).\n\nSupervisor:\n- To supervise and lead QA Resto (west/east area)\n- To control and document the food safety management & halal assurance system in store\n- To inspect food products to ensure they are safe and of a high quality in store\n- To verify and evaluate food safety complaints and ensuring appropriate corrective & preventive actions in store\n- Implements training and awareness programs to ensure employees are up-to-date with food quality & safety systems and requirements (HACCP, Halal, etc)."
//             },
//             "shareMediaCategory": "ARTICLE",
//             "media": [
//                 {
//                     "status": "READY",
//                     "description": {
//                         "text": "QA OPERATION & FOOD SAFETY SYSTEM"
//                     },
//                     "originalUrl": "https://lokersulawesi.com/lowongan/qa-operation-food-safety-system",
//                     "title": {
//                         "text": "QA OPERATION & FOOD SAFETY SYSTEM"
//                     }
//                 }
//             ]
//         }
//     },
//     "visibility": {
//         "com.linkedin.ugc.MemberNetworkVisibility": "PUBLIC"
//     }
// }


// List API
