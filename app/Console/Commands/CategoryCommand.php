<?php

namespace App\Console\Commands;

use App\Models\Category;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class CategoryCommand extends Command
{
    protected $signature = 'get:category {url=https://dantri.com.vn/} {--timeout=120.0}';
    protected $description = "get category";

    public function handle(): void
    {
        $client = new Client(['timeout' => $this->option('timeout'),]);
        $url = $this->argument('url');
        $this->categoryDanTri($client, $url);
    }

    function categoryDanTri($client, $url)
    {
        $response = $client->get($url);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('nav.menu ol.menu-wrap li.has-child')->each(function (Crawler $node, $i){
            $category['name']=$node->filter('a')->text();
            $category['slug']=$node->filter('a')->attr('href');
            Category::updateOrInsert(['slug'=>$category['slug']], $category);
        });
    }
}
