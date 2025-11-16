<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ScrapController extends Controller
{
    public function index()
    {
        $jobStreet = $this->jobstreet();
        $jobs = array_merge($jobStreet);
        // $jobs = $this->glints();

        return response()->json($jobs);
    }

    private function glints()
    {
        // pakai puppeteer-scraper

        // Membuat instance browser
        // $browser = new HttpBrowser(HttpClient::create());

        // Mengunduh dan mem-parsing HTML dari halaman target
        // $crawler = $browser->request('GET', 'https://glints.com/id/opportunities/jobs/explore?country=ID&locationId=db48cb40-c794-45d2-aee1-db458166de9e&locationName=Sulawesi+Selatan&lowestLocationLevel=2&lastUpdated=PAST_WEEK');

        // $jobs = [];

        // $html = $crawler->html();


        // $crawler->filter('#app')->each(function ($node) use (&$jobs, $browser) {
        //     // $jobTitle = $node->filter('[class*="ompactOpportunityCardsc__JobTitle-sc"] > a')->text();

        //     dd($node);


        // });

        // $crawler->filter('[data-card-type="JobCard"]')->each(function ($node) use (&$jobs, $browser) {

        //     // Mengambil data setiap elemen pekerjaan
        //     $companyLogo = $node->filter(''.$prefix.'[data-automation="company-logo-container"]')->filter('img')->extract(['src']);
        //     $jobTitle = $node->filter(''.$prefix.'[data-automation="jobTitle"]')->text();
        //     $companyName = $node->filter(''.$prefix.'[data-automation="jobCompany"]')->text();
        //     $location = $node->filter(''.$prefix.'[data-automation="jobLocation"]')->each(function ($node) {
        //         return $node->text();
        //     });
        //     $dateText = $node->filter(''.$prefix.'[data-automation="jobListingDate"]')->text();

        //     // Mengambil link detail pekerjaan
        //     $detailJob = $node->filter('a[data-automation="job-list-item-link-overlay"]')->attr('href');

        //     $deskripsiJob = 'Deskripsi tidak ditemukan';

        //     if ($detailJob) {
        //         // Request ke halaman detail pekerjaan
        //         $detailPage = $browser->request('GET', 'https://id.jobstreet.com' . $detailJob);

        //         // Mengambil deskripsi pekerjaan
        //         $deskripsiJob = $detailPage->filter('[data-automation="jobAdDetails"]')->html();
        //     }

        //     $jobs[] = [
        //         'companyLogo' => $companyLogo ?? '',
        //         'jobTitle' => $jobTitle,
        //         'companyName' => $companyName,
        //         'location' => $location,
        //         'dateText' => $dateText,
        //         'deskripsiJob' => $deskripsiJob,
        //     ];
        // });

        // return $jobs;

    }

    public function jobstreet($url = 'https://id.jobstreet.com/id/jobs/in-Sulawesi-Selatan?daterange=7')
    {
        // Membuat instance browser
        $browser = new HttpBrowser(HttpClient::create());

        // Mengunduh dan mem-parsing HTML dari halaman target
        $crawler = $browser->request('GET', $url);
        $settings = DB::table('settings')->get()->keyBy('key');
        $prefix = $settings['JOBSTREET_PREFIX']->value;

        $jobs = [];

        // $html = $crawler->html();
        $crawler->filter('[data-card-type="JobCard"]')->each(function ($node) use (&$jobs, $browser, $prefix) {

            // Mengambil data setiap elemen pekerjaan
            $companyLogo = $node->filter(''.$prefix.'[data-automation="company-logo-container"]');
            if (count($companyLogo->extract(['src'])) > 0) {
                $companyLogo = $companyLogo->filter('img')->extract(['src']);
            } else {
                $companyLogo = '';
            }

            $jobTitle = $node->filter(''.$prefix.'[data-automation="jobTitle"]')->text();
            $companyName = $node->filter(''.$prefix.'[data-automation="jobCompany"]')->extract(['title']);

            // skip jika tidak punya company
            if (count($companyName) <= 0) {
                // skip
                return;
            }

            $slug = Str::slug($jobTitle);

            // skip jika sudah ada di db
            if (Job::where('slug', $slug)->where('title', $jobTitle)->count() > 0) {
                return;
            }

            $companyName = $node->filter(''.$prefix.'[data-automation="jobCompany"]')->text();
            $location = $node->filter(''.$prefix.'[data-automation="jobLocation"]')->each(function ($node) {
                return $node->text();
            });
            $dateText = $node->filter(''.$prefix.'[data-automation="jobListingDate"]')->text();

            // Mengambil link detail pekerjaan
            $detailJob = $node->filter('a[data-automation="job-list-item-link-overlay"]')->attr('href');

            $deskripsiJob = 'Deskripsi tidak ditemukan';

            if ($detailJob) {
                // Request ke halaman detail pekerjaan
                $linkUrl = 'https://id.jobstreet.com' . $detailJob;
                $detailPage = $browser->request('GET', $linkUrl);

                // Mengambil deskripsi pekerjaan
                $deskripsiJob = $detailPage->filter('[data-automation="jobAdDetails"]')->html();
            }
            // skip jika tidak ada detail job
            else {
                return;
            }

            $jobs[] = [
                'slug' => $slug,
                'title' => $jobTitle ?? '',
                'company_name' => $companyName ?? '',
                'location' => json_encode($location),
                'image' => $companyLogo != '' ? $companyLogo[0] : '/assets/images/default-lowongan.png',
                'job_types' => json_encode(['Full Time']),
                'salary' => '',
                'status' => '',
                'publish_on' => $dateText ?? '',
                'created_at' => now(),
                'description' => $deskripsiJob ?? '',
                'link_url' => $linkUrl ?? '',
                'publish_on_date' => $this->dateConvert($dateText)
            ];
        });

        DB::table('jobs')->insert($jobs);

        return $jobs;
    }


    public function dateConvert($dateText)
    {
        $dateConvert = explode(' ', $dateText);
        $numberTime = $dateConvert[0];
        if ($dateConvert[1] == 'hari') {
            $date = date('Y-m-d H:i:s', strtotime('-' . $numberTime . ' days'));
        } else if ($dateConvert[1] == 'jam') {
            $date = date('Y-m-d H:i:s', strtotime('-' . $numberTime . ' hours'));
        } else {
            $date = date('Y-m-d H:i:s');
        }

        return Carbon::parse($date);
    }
}
