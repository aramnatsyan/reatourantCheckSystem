<?php

namespace App\Http\Controllers;

use App\Models\Graphics;
use Illuminate\Http\Request;

class GraphicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graphics = Graphics::getAllGraphicsArray();
        return view('graphic.graphic', ['graphics' => $graphics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insert = false;
        if (!empty($_POST)) {

            $insert = Graphics::createGraphic($_POST['data']);
        }

        return $insert;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Graphics  $graphics
     * @return \Illuminate\Http\Response
     */
    public function show(Graphics $graphics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Graphics  $graphics
     * @return \Illuminate\Http\Response
     */
    public function edit(Graphics $graphics)
    {
        $insert = false;
        if (!empty($_POST)) {

            $insert = Graphics::editGraphic($_POST['data']);
        }

        return $insert;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Graphics  $graphics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graphics $graphics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Graphics  $graphics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graphics $graphics)
    {
        $deleted = false;
        if (!empty($_POST)) {
            $graphicId = $_POST['graphicId'];
            if ($graphicId) {
                $deleted =  Graphics::where('id',$graphicId)->delete();
            }
         }
        return $deleted;
    }
}
