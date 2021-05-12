<?php

namespace App\Http\Controllers;

use App\Models\Routings;
use Illuminate\Http\Request;

class RoutingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routings = Routings::all();
        return view('modules.manufacturing.routing', ['routings' => $routings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function show(Routings $routings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function edit(Routings $routings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Routings $routings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Routings  $routings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Routings $routings)
    {
        //
    }
}
