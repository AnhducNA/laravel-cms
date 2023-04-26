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
//        get category
            $list_categories = Category::all();
            foreach ($list_categories as $category) {
                for ($i = 1; $i <= 2; $i++) {
                    $url_category = $url . $category->slug . '/' . 'trang-' . $i . '.htm';
                    $slug_category = $category->slug;
                    $id_category = $category->id;
//            crawl data
                    $response = $client->get($url_category);
                    $html = $response->getBody()->getContents();
                    $crawler = new Crawler($html);
                    $crawler->filter('.article.list article.article-item')->each(function (Crawler $node, $i) use ($id_category, $slug_category, $url) {
                        $trim_category = trim($node->filter('.article-content h3.article-title a')->attr('href'), '/' . $slug_category);
                        $sub_tail = substr($trim_category, 0, -4);
                        $post['title'] = $node->filter('.article-content h3.article-title a')->text();
                        $post['slug'] = $sub_tail;
                        $post['description'] = $this->crawlPostContent($url . $slug_category . '/' . $post['slug'] . '.htm');
                        $post['thumbnail'] = $node->filter('.article-thumb a img')->attr('data-src');
                        $post['excerpt'] = $node->filter('.article-content .article-excerpt a')->text();
                        $post['category_id'] = $id_category;
                        $post['status'] = "DRAFT";
                        $this->info($url . $slug_category . '/' . $post['slug'] . '.htm');
                        $new_post = Post::updateOrCreate(['slug' => $post['slug']], $post);
//                        dd($new_post->id);
//                        $new_data = Post::select('id')->where('slug', $post['slug'])->first();
                        $this->crawlPostTag($url . $slug_category . '/' . $post['slug'] . '.htm', $new_post->id);
                    });
                }
            }
        } catch (Exception $e) {
            $this->error('Unknown error: ' . $e->getMessage());
        }
    }

    function crawlPostContent($url_post): string
    {
        try {
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

    function crawlPostTag($url_post, $idPost): string
    {
        try {
            $client = new Client(['timeout' => 120]);
            $response = $client->get($url_post);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);
            $list_tag = [];
            $crawler->filter('ul.tags-wrap li')->each(function (Crawler $node, $i) {
                $list_tag[$i] = $node->filter('a')->text();
                dd($list_tag);
            });

            return "";
        } catch (Exception $e) {
            return "";
        }
    }

    function crawl_userPost($url_post): string
    {
        try {
//    dd($url_post);
            $client = new Client(['timeout' => 120]);
            $response = $client->get($url_post);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);
            dd($crawler->filter(''));
            return $crawler->filter('.singular-content')->html();
        } catch (Exception $e) {
            return "";
        }
    }

}

