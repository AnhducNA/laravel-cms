<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\FullTextSearch;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class FullTextSearchController extends Controller
{
    public function index(Request $request)
    {
        return view('client.search');
    }
    Public function search(Request $request)
    {
//        if($request->ajax())
//        {
//            $data = Post::search($request->get('full_text_search_query'))->get();
////            dd($data);
//            return response()->json($data);
//        }
        $key_search = $request->get('full_text_search');
        $list_post_by_search = Post::search($request->get('full_text_search'))->simplePaginate(10);
//        dd($list_post_by_search);
        return view('client.search', compact('list_post_by_search', 'key_search'));
    }
}
