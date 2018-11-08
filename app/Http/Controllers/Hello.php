<?php

namespace App\Http\Controllers;

use App\Pays;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Hello extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return 'hello world from controller :) ';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(Request $request)
    {


        //
        $Article = new \App\Article();
        $Pays = new Pays();

        $data = $Article->all();
        $dat = $Pays->all();

        return view('hello',array('articles' => $data, 'pays' => $dat));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
