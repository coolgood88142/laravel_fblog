<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;
use Carbon\Carbon;

// require	'vendor/autoload.php';
class ArticlesController extends Controller
{
    public function getArticlesData()
    {
        $articles = Articles::all();
        $response = [
            'articles' => $articles,
            'add' => route('addArticles'),
            'update' => route('updateArticles'),
            'delete' => route('deleteArticles')
        ];

        return view('articles', ['data' => $response]);
    }

    public function checkArticlesData($id)
    {
        $isSuccess = false;
        $data = Articles::all()->contains($id);
        if ($data > 0) {
            $isSuccess = true;
        }

        return $isSuccess;
    }

    public function addArticlesData(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $slug = $request->slug;
        $status = 'success';
        $message = '新增成功!';

        try {
            $articles = new Articles();
            $articles->title = $title;
            $articles->content = $content;
            $articles->slug = $slug;
            $articles->creation_date = Carbon::now();
            $articles->save();
        } catch (Exception $e) {
            echo $e;
        }
        
        return [ 
            'status' => $status,
            'message' => $message 
        ];
    }

    public function updateArticlesData(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $content = $request->content;
        $slug = $request->slug;
        $status = 'success';
        $message = '更新成功!';

        try {
            $check = $this->checkArticlesData($id);

            if ($check) {
                $articles = Articles::find($id);
                $articles->title = $title;
                $articles->content = $content;
                $articles->slug = $slug;
                $articles->save();
            } else {
                $status = 'error';
                $message = '更新失敗!';
            }

        } catch (Exception $e) {
            echo $e;
        }
        
        return [ 
            'status' => $status,
            'message' => $message 
        ];
    }

    public function deleteArticlesData(Request $request)
    {
        $id = $request->id;
        $status = 'success';
        $message = '刪除成功!';

        try {
            $check = $this->checkArticlesData($id);

            if ($check) {
                $articles = Articles::find($id);
                $articles->delete();
            } else {
                $status = 'error';
                $message = '刪除失敗!';
            }

        } catch (Exception $e) {
            echo $e;
        }
        
        return [ 
            'status' => $status,
            'message' => $message 
        ];
    }

    public function test1(){
        $datas = Articles::all();
    
        foreach ($datas as $data) {
            echo $data;
        }
    }

    public function test2(){
        $datas = Articles::cursor();
    
        foreach ($datas as $data) {
            echo $data;
        }
    }

    public function test3(){
        $articles = LazyCollection ::make(function() {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://my-json-server.typicode.com/coolgood88142/json_server/articles');
            $datas = json_decode($response->getBody(), true);
            
            foreach ($datas as $data) {
                yield $data;
            }
        });

        foreach ($articles as $data) {
            var_dump($data);
        }
    }

}
