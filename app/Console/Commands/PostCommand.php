<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class PostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:post {url=https://dantri.com.vn/} {--timeout=120.0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get post';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $client = new Client(['timeout' => $this->option('timeout'),]);
        $url = $this->argument('url');
        $this->PostDanTri($client, $url);
    }

    function PostDanTri($client, $url)
    {
        try {
            $client = new Client(['timeout' => 120]);
            $url = "https://dantri.com.vn";

//        get category
            $list_categories = Category::all();
            foreach ($list_categories as $category) {
                $id_category = $category->id;
                $url_category = $url . $category->slug;
//            crawl data
                $response = $client->get($url_category);
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);

                $crawler->filter('.article.list article.article-item')->each(function (Crawler $node, $i) use ($url, $id_category) {
                    $post['thumbnail'] = $node->filter('.article-thumb a img')->attr('data-src');
//                    dd($post['thumbnail']);
                    $post['title'] = $node->filter('.article-content h3.article-title a')->text();
                    $post['slug'] = ltrim($node->filter('.article-content h3.article-title a')->attr('href'), '/');
                    $post['description'] = crawlPostContent($url . $post['slug']);
                    $post['excerpt'] = $node->filter('.article-content .article-excerpt a')->text();
                    $post['category_id'] = $id_category;
                    $post['status'] = "DRAFT";
                    Post::updateOrInsert(['slug' => $post['slug']], $post);
                });
            }
        } catch (Exception $e) {
            $this->error('Unknown error: ' . $e->getMessage());
        }
    }
}

function crawlPostContent($url_post): string
{
    $client = new Client(['timeout' => 120]);
    $response = $client->get($url_post);
    $html = $response->getBody()->getContents();
    $crawler = new Crawler($html);
    try {
        return $crawler->filter('.singular-content')->html();
    } catch (Exception $e) {
        return "";
    }
}
