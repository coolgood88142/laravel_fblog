<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function getArticlesData()
    {
        $articles = Articles::all();
        $response = [
            'articles' => $articles, 'add' => route('addArticles'), 'update' => route('updateArticles'),
            'delete' => route('deleteArticles')
        ];

        return view('articles', $response);
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
        $title = $request->title;
        $content = $request->content;
        $slug = $request->slug;
        $status = 'success';
        $message = '更新成功!';

        try {
            $check = $this->checkAticlesData($id);

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
            $check = $this->checkAticlesData($id);

            if ($check) {
                $articles = Aticles::find($id);
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

}
