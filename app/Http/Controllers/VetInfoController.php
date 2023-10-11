<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVetInfoRequest;
use App\Http\Requests\UpdateVetInfoRequest;
use App\Models\VetInfo;

class VetInfoController extends Controller
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
     * @param  \App\Http\Requests\StoreVetInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVetInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VetInfo  $vetInfo
     * @return \Illuminate\Http\Response
     */
    public function show(VetInfo $vetInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VetInfo  $vetInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(VetInfo $vetInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVetInfoRequest  $request
     * @param  \App\Models\VetInfo  $vetInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVetInfoRequest $request, VetInfo $vetInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VetInfo  $vetInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(VetInfo $vetInfo)
    {
        //
    }
}
