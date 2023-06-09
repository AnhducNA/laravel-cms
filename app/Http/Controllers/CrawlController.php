<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\DomCrawler\Crawler;

class CrawlController extends Controller
{

    function test()
    {
        $client = new Client(['timeout' => 120]);
        $url = "https://dantri.com.vn/";

//        get category
        $list_categories = Category::all();
        foreach ($list_categories as $category) {
            $id_category = $category->id;
            $url_category = $url . $category->slug.".htm";
            $slug_category = $category->slug;
//            crawl data
            $response = $client->get($url_category);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);
            $crawler->filter('.article.list article.article-item')->each(function (Crawler $node, $i) use ($id_category,$slug_category, $url) {
               $trim_category = trim($node->filter('.article-content h3.article-title a')->attr('href'), '/'.$slug_category);
               $sub_tail = substr($trim_category, 0, -4);
                $post['title'] = $node->filter('.article-content h3.article-title a')->text();
                $post['slug'] = $sub_tail;
                $post['description'] = $this->crawlPostContent($url . $post['slug'].'.htm');
                $post['thumbnail'] = $node->filter('.article-thumb a img')->attr('data-src');
                $post['excerpt'] = $node->filter('.article-content .article-excerpt a')->text();
                $post['category_id'] = $id_category;
                $post['status'] = "DRAFT";
//                Post::updateOrInsert(['slug' => $post['slug']], $post);
            });
        }
    }

    function crawlPostContent($url_post)
    {
        try {
//            dd($url_post);
            $client = new Client(['timeout' => 120]);
            $response = $client->get($url_post);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);
            $content = $crawler->filter('.singular-content')->html();
            return $content;
        } catch (Exception $e) {
            return "";
        }
    }

    function category()
    {
        $client = new Client(['timeout' => 120]);
        $url = "https://dantri.com.vn/";
        $response = $client->get($url);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

        $crawler = $crawler->filter('nav.menu ol.menu-wrap li.has-child')->each(function (Crawler $node, $i) {
            $category['name'] = $node->filter('a')->text();
            $category['slug'] = substr($node->filter('a')->attr('href'), 1, -4);
            Category::updateOrInsert(['slug' => $category['slug']], $category);
            dump($i);
            echo "<pre>";
            print_r($category);
        });
    }

    function postZingNews()
    {
        $client = new Client(['timeout' => 120]);
        $url = "https://zingnews.vn/";
        $response = $client->get($url);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('#section-latest .article-list .article-item ')->each(function (Crawler $node, $i) {
//            dd($node->html());
//            dd($node->html());
            $data = ['status' => 'DRAFT'];
            $data['title'] = $node->filter('p.article-title a')->text();
            $data['slug'] = $node->filter('p.article-title a')->attr('href');
            $data['thumbnail'] = $node->filter('.article-thumbnail a img')->attr('data-src');
            $data['description'] = $node->filter('p.article-summary')->html();
//            Post::updateOrInsert(['slug'=>$data['slug']],$data);
            dd($data);
        });
    }

}
