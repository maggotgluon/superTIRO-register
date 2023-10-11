<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientInfoRequest;
use App\Http\Requests\UpdateClientInfoRequest;
use App\Models\ClientInfo;

class ClientInfoController extends Controller
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
     * @param  \App\Http\Requests\StoreClientInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientInfo  $clientInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ClientInfo $clientInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientInfo  $clientInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientInfo $clientInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientInfoRequest  $request
     * @param  \App\Models\ClientInfo  $clientInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientInfoRequest $request, ClientInfo $clientInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientInfo  $clientInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientInfo $clientInfo)
    {
        //
    }
}
