<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\articles;
use Illuminate\Support\Facades\Validator;

class articlesController extends Controller
{
    public function create(Request $request)
    {

       $validator = Validator::make($request->all(),  [
        'name' => 'bail|required',
        'description' => 'bail|required',
        'auteur' => 'bail|required',
        'urlImage' => 'bail|required',
        'populaire' => 'bail|required'
       ]);

       if ($validator->fails())
            return response()->json($validator->errors() , 201) ;
       
       $data = $request->all();
       $article  = articles::create($data);

       if($article->save()){
            return response()->json($article , 200);

       return response()->json(["message"=>"Une erreur est survenue lors de la création de  cet article"] , 203);

    }
    }

    public function read()
    {
        return response()->json(articles::all() , 200) ;
    }

    public function read_one(Request $request)
    {
       $id = $request->query('id') ;

       $article = articles::find($id) ;

       if($article)
            return response()->json($article , 200) ;

        return response()->json(["message"=>"Aucun article avec cet id"] , 203);
    }

    public function drop(Request $request)
    {
        $id = $request->query('id') ;

        $article = articles::find($id) ;

        if($article && $article->delete())
            return response()->json(["message" => "Article supprimé avec succes"]) ;

        return response()->json(["message"=>"Erreur lors de la suppression"] , 203);
    }

    public function update(Request $request)
    {
        $id = $request->query('id') ;

        $validator = Validator::make($request->all(),  [
            'name' => 'bail|required',
            'description' => 'bail|required',
            'auteur' => 'bail|required',
            'urlImage' => 'bail|required',
            'populaire' => 'bail|required'
           ]);

        if ($validator->fails())
            return response()->json($validator->errors() , 201) ;

        $article = articles::find($id) ;

        if($article && $article->update($request->all()))
            return response()->json($article , 200) ;

        return response()->json(["message"=>"Erreur lors de la mise à jour"] , 203);
    }
}
