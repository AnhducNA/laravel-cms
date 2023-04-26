<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    function index()
    {
        $list_posts = Post::select('*')->orderBy('id', 'DESC')->paginate(5);
        foreach ($list_posts as $key => $post) {
//            add image to s3 driver
            if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL) === FALSE) {
                $filePath = "leanhduc/" . $post['thumbnail'];
                $list_posts[$key]['thumbnail'] = $this->getImageFromS3($filePath);
            }
        }
        $list_categories = Category::paginate(5);
        return view('client.index', compact('list_categories', 'list_posts'));
    }

    function category($slug)
    {
        $list_categories = Category::paginate(5);
        $list_post_by_categoryID = Post::with('category')->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->simplePaginate(10);
        foreach ($list_post_by_categoryID as $key => $post) {
//            add image to s3 driver
            if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL) === FALSE) {
                $filePath = "leanhduc/" . $post['thumbnail'];
                $list_post_by_categoryID[$key]['thumbnail'] = $this->getImageFromS3($filePath);
            }
        }
        return view('client.category', compact('slug', 'list_post_by_categoryID', 'list_categories'));
    }

    function detail_post($slug)
    {
//        dd($post);
        $post = Post::with('category')->where('slug', $slug)->first();
        //            add image to s3 driver
        if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL) === FALSE) {
            $filePath = "leanhduc/" . $post['thumbnail'];
            $post['thumbnail'] = $this->getImageFromS3($filePath);
        }
//        increase viewpage
        $pageview = $post->pageview;
        $pageview++;
        Post::where('slug', $slug)->update(['pageview' => $pageview]);
        $list_post_similar = Post::where('category_id', $post->category_id)->paginate(10);
        foreach ($list_post_similar as $key => $post_item) {
//            add image to s3 driver
            if (filter_var($post_item['thumbnail'], FILTER_VALIDATE_URL) === FALSE) {
                $filePath = "leanhduc/" . $post_item['thumbnail'];
                $list_post_similar[$key]['thumbnail'] = $this->getImageFromS3($filePath);
            }
        }
        return view('client.detail-post', compact('post', 'list_post_similar'));
    }

    function search(Request $request)
    {
        $searchTerm = $request->search;
        dump($searchTerm);
//        $listPost = Post::where('title', 'LIKE', "%{$searchTerm}%")->get();
        $listPost = Post::search($searchTerm)->get();
        dd($listPost);
    }
    function getImageFromS3($filePath)
    {
        $path = Storage::cloud()->temporaryUrl(
            $filePath,
            Carbon::now()->addMinute(5)
        );
        return $path;
    }
}
