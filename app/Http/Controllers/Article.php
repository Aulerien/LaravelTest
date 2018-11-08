<?php

namespace App\Http\Controllers;

use App\Pays;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class Article extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {

            if($request->isMethod('POST'))
            {

                $code = $request->get('code');
                $designation = $request->get('designation');
                $idPays = $request->get('pays');

                \App\Article::create(
                    array(
                        'code' => $code,
                        'designation' => $designation,
                        'pays_id' => $idPays
                    )
                );

                $request->session()->flash('message.ajouter', 'success');
                $request->session()->flash('message.contenu', 'Article ajouté avec Succès.');

                return \redirect()->route('accueil');

            }else
            {
                return \redirect()->route('accueil');
            }
            die();
    }


    public function update(Request $request, $idArticle)
    {
        if ($request->isMethod('POST'))
        {
            $code = $request->get('code');
            $designation = $request->get('designation');

            $Article = \App\Article::find($idArticle);
            $Article->code = $code;
            $Article->designation = $designation;
            $Article->save();

            return \redirect()->route('accueil');

        }else
        {
            return \redirect('hello/Tu-es-redirigé');
        }
    }


    public function delete(Request $request, $idArticle)
    {
        $Article = \App\Article::find($idArticle);
        $Article->delete();

        return \redirect()->route('accueil');
    }




}
