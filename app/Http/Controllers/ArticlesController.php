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

    public function getArticlesAllData(){
        $datas = Articles::all();
    
        foreach ($datas as $data) {
            echo $data;
        }
    }

    public function getArticlesCursorData(){
        $datas = Articles::cursor();
    
        foreach ($datas as $data) {
            echo $data;
        }
    }

    public function getArticlesDataRam(){
        $this->getReturnRamText();
        echo '<bt/></br>';
        $this->getYieldRamText();
    }

    public function getArticles($beginId, $endId){
        $client = new \GuzzleHttp\Client();
        $url = 'https://my-json-server.typicode.com/coolgood88142/json_server/articles?_start='. $beginId . '&_end=' . $endId;
        $response = $client->request('GET', $url);
        $datas = json_decode($response->getBody(), true);

        return $datas;
    }

    public function getPrintText($data){
        var_dump($data);
        echo '<br/>';
    }

    public function getYieldRamText(){
        $datas = LazyCollection::make(function() {   
            $beginId = 1;
            $endId = 4;
            $articles = $this->getArticles($beginId-1, $endId);

            foreach ($articles as $article){
                yield $article;
            }
        });

        foreach ($datas as $data){
            $this->getPrintText($data);
        }

        echo '占用了' . memory_get_usage() . 'Bytes' . '<br/>';
    }

    public function getReturnRamText(){
        $beginId = 1;
        $endId = 4;
        $datas = $this->getArticles($beginId-1, $endId);

        foreach ($datas as $data){
            $this->getPrintText($data);
        }

        echo '占用了' . memory_get_usage() . 'Bytes' . '<br/>';
    }
}
