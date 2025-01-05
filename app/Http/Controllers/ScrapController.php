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
        //     $companyLogo = $node->filter('.snwpn00[data-automation="company-logo-container"]')->filter('img')->extract(['src']);
        //     $jobTitle = $node->filter('.snwpn00[data-automation="jobTitle"]')->text();
        //     $companyName = $node->filter('.snwpn00[data-automation="jobCompany"]')->text();
        //     $location = $node->filter('.snwpn00[data-automation="jobLocation"]')->each(function ($node) {
        //         return $node->text();
        //     });
        //     $dateText = $node->filter('.snwpn00[data-automation="jobListingDate"]')->text();

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

    public function jobstreet()
    {
        // Membuat instance browser
        $browser = new HttpBrowser(HttpClient::create());

        // Mengunduh dan mem-parsing HTML dari halaman target
        $crawler = $browser->request('GET', 'https://id.jobstreet.com/id/jobs/in-Sulawesi-Selatan?daterange=7');

        $jobs = [];

        // $html = $crawler->html();
        $crawler->filter('[data-card-type="JobCard"]')->each(function ($node) use (&$jobs, $browser) {

            // Mengambil data setiap elemen pekerjaan
            $companyLogo = $node->filter('.snwpn00[data-automation="company-logo-container"]');
            if (count($companyLogo->extract(['src'])) > 0) {
                $companyLogo = $companyLogo->filter('img')->extract(['src']);
            } else {
                $companyLogo = '';
            }

            $jobTitle = $node->filter('.snwpn00[data-automation="jobTitle"]')->text();
            $companyName = $node->filter('.snwpn00[data-automation="jobCompany"]')->extract(['title']);

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

            $companyName = $node->filter('.snwpn00[data-automation="jobCompany"]')->text();
            $location = $node->filter('.snwpn00[data-automation="jobLocation"]')->each(function ($node) {
                return $node->text();
            });
            $dateText = $node->filter('.snwpn00[data-automation="jobListingDate"]')->text();

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
            ];

            // $slug = Str::slug($jobTitle);
            // Job::where('slug', $slug)->where('title', $jobTitle)->firstOrCreate([
            //     'slug' => $slug,
            //     'title' => $jobTitle,
            //     'company_name' => $companyName,
            //     'location' => json_encode($location),
            //     'image' => $companyLogo != '' ? $companyLogo[0] : null,
            //     'job_types' => json_encode(['Full Time']),
            //     'salary' => '',
            //     'status' => '',
            //     'publish_on' => $dateText,
            //     'description' => $deskripsiJob
            // ]);
        });

        DB::table('jobs')->insert($jobs);

        return $jobs;
    }


    // CATATAN

//     tidak adakah library php yang seperti puppetter untuk membuka browser dan mencapture networknya?

// ChatGPT said:
// ChatGPT
// Sayangnya, di PHP tidak ada library yang langsung setara dengan Puppeteer yang digunakan di Node.js untuk mengontrol browser secara langsung dan menangkap jaringan (network requests) dengan cara yang sama. Namun, ada beberapa alternatif yang bisa Anda coba untuk mengontrol browser dan menangani automasi web menggunakan PHP. Berikut adalah beberapa opsi yang bisa Anda pertimbangkan:

// 1. PHP WebDriver (Selenium WebDriver)
// Salah satu cara terbaik untuk mengontrol browser dan menangkap interaksi atau respons di PHP adalah dengan menggunakan Selenium WebDriver. Selenium mendukung berbagai bahasa pemrograman, termasuk PHP, dan memungkinkan Anda untuk berinteraksi dengan browser secara langsung (menggunakan browser seperti Chrome, Firefox, Safari, dll).

// Anda perlu menginstal Selenium Server dan menjalankan browser dalam mode otomatis (headless atau tidak).
// PHP WebDriver adalah binding PHP untuk Selenium, yang memungkinkan Anda mengontrol browser dan menangkap interaksi.
// Langkah-langkah untuk menggunakan PHP WebDriver dengan Selenium:

// Instal Selenium di server Anda. Anda bisa mengunduhnya dari situs resmi Selenium.

// Instal library PHP WebDriver melalui Composer:

// bash
// Copy code
// composer require facebook/webdriver
// Gunakan kode berikut untuk mengontrol browser:

// php
// Copy code
// <?php

// require_once('vendor/autoload.php');

// use Facebook\WebDriver\Chrome\ChromeOptions;
// use Facebook\WebDriver\Remote\RemoteWebDriver;
// use Facebook\WebDriver\Remote\DesiredCapabilities;

// // Menyiapkan WebDriver untuk mengontrol browser
// $options = new ChromeOptions();
// $options->addArguments(["--headless", "--disable-gpu", "--no-sandbox"]);

// $capabilities = DesiredCapabilities::chrome();
// $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

// // URL Selenium Server (misalnya, localhost:4444)
// $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);

// // Arahkan ke halaman yang diinginkan
// $driver->get('https://www.example.com');

// // Ambil HTML halaman atau data lainnya
// echo $driver->getPageSource();

// // Tutup driver setelah selesai
// $driver->quit();
// Keterbatasan: Meskipun Anda bisa mengontrol browser dengan cara ini, Selenium WebDriver tidak secara langsung menangkap request jaringan (network requests). Untuk menangkap request jaringan, Anda mungkin perlu menggunakan fitur tambahan seperti BrowserMob Proxy atau alat lain yang bisa diintegrasikan dengan Selenium.

// 2. BrowserMob Proxy
// BrowserMob Proxy adalah proxy yang dapat digunakan bersama dengan Selenium atau PHP untuk menangkap lalu lintas HTTP/HTTPS dari browser. Anda dapat menggunakannya untuk menganalisis dan menangkap data dari request atau respons jaringan.

// Langkah-langkah menggunakan BrowserMob Proxy dengan PHP:

// Anda perlu menginstal BrowserMob Proxy di sistem Anda. Anda dapat mengunduhnya dari situs BrowserMob.
// Anda juga perlu menjalankan Selenium WebDriver dan mengonfigurasi BrowserMob Proxy untuk menangkap request.
// Contoh kode dengan BrowserMob Proxy dan PHP WebDriver:

// php
// Copy code
// require_once('vendor/autoload.php');

// use Facebook\WebDriver\Chrome\ChromeOptions;
// use Facebook\WebDriver\Remote\RemoteWebDriver;
// use Facebook\WebDriver\Remote\DesiredCapabilities;
// use BrowserMobProxy\Client as BrowserMobProxy;

// // Setup BrowserMob Proxy
// $proxy = new BrowserMobProxy('http://localhost:8080');
// $proxy->newHar();  // Mulai perekaman request

// // Setup WebDriver untuk menggunakan proxy
// $options = new ChromeOptions();
// $options->addArguments(["--headless", "--proxy-server=http://localhost:8080"]);

// $capabilities = DesiredCapabilities::chrome();
// $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

// $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);

// // Mengunjungi halaman
// $driver->get('https://www.example.com');

// // Dapatkan request dan response dari proxy
// $har = $proxy->getHar();
// echo json_encode($har->log->entries);

// // Tutup driver
// $driver->quit();
// Dengan ini, Anda bisa menangkap request dan response HTTP dari browser dan menganalisisnya.

// 3. Puppeteer-Style PHP Alternatives:
// Saat ini, tidak ada library PHP yang sebanding dengan Puppeteer dalam hal menangani browser dan interaksi dengan request jaringan.
// Playwright adalah alternatif lain yang lebih modern dan lebih mirip dengan Puppeteer, namun tidak secara langsung didukung di PHP.
// Kesimpulan:
// Jika Anda ingin menggunakan PHP untuk menangkap request jaringan secara langsung, opsi terbaik adalah menggabungkan Selenium WebDriver dengan BrowserMob Proxy. Anda akan dapat mengontrol browser dan menangkap request jaringan yang terjadi selama proses rendering halaman.

// Namun, jika tujuan Anda adalah meniru pengalaman Puppeteer secara langsung di PHP, Anda harus mempertimbangkan untuk menggabungkan beberapa alat atau bahkan menggunakan solusi yang berbasis Node.js seperti Puppeteer, jika memungkinkan.

// Jika Anda membutuhkan penjelasan lebih lanjut tentang salah satu opsi ini, beri tahu saya!



    // public function index()
    // {
    //     $browser = new HttpBrowser(HttpClient::create());

    //     // download and parse the HTML of the target page
    //     $crawler = $browser->request('GET', 'https://quotes.toscrape.com/');

    //     // where to store the scraped data
    //     $quotes = [];

    //     // select all quote HTML elements on the page
    //     $quote_html_elements = $crawler->filter('.quote');

    //     // iterate over each quote HTML element and apply

    //     // the scraping logic

    //     foreach ($quote_html_elements as $quote_html_element) {

    //         // create a new quote crawler

    //         $quote_crawler = new Crawler($quote_html_element);

    //         // perform the data extraction logic

    //         $text_html_element = $quote_crawler->filter('.text');

    //         $raw_text = $text_html_element->text();

    //         // remove special characters from the raw text information

    //         $text = str_replace(["\u{201c}", "\u{201d}"], '', $raw_text);

    //         $author_html_element = $quote_crawler->filter('.author');

    //         $author = $author_html_element->text();

    //         $tag_html_elements = $quote_crawler->filter('.tag');

    //         $tags = [];

    //         foreach ($tag_html_elements as $tag_html_element) {

    //             $tag = $tag_html_element->textContent;

    //             $tags[] = $tag;
    //         }

    //         // create a new quote object

    //         // with the scraped data

    //         $quote = [

    //             'text' => $text,

    //             'author' => $author,

    //             'tags' => $tags

    //         ];

    //         // add the quote object to the quotes array

    //         $quotes[] = $quote;
    //     }

    //     // var_dump($quotes);

    //     return response()->json(['quotes' => $quotes]);
    // }
}
