<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storermkt_clientRequest;
use App\Http\Requests\Updatermkt_clientRequest;
use App\Models\rmkt_client;

class RmktClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storermkt_clientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storermkt_clientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rmkt_client  $rmkt_client
     * @return \Illuminate\Http\Response
     */
    public function show(rmkt_client $rmkt_client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rmkt_client  $rmkt_client
     * @return \Illuminate\Http\Response
     */
    public function edit(rmkt_client $rmkt_client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatermkt_clientRequest  $request
     * @param  \App\Models\rmkt_client  $rmkt_client
     * @return \Illuminate\Http\Response
     */
    public function update(Updatermkt_clientRequest $request, rmkt_client $rmkt_client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rmkt_client  $rmkt_client
     * @return \Illuminate\Http\Response
     */
    public function destroy(rmkt_client $rmkt_client)
    {
        //
    }
}
