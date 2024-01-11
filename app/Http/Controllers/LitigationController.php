<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLitigationRequest;
use App\Http\Requests\UpdateLitigationRequest;
use App\Models\Litigation;

class LitigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLitigationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Litigation $litigation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Litigation $litigation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLitigationRequest $request, Litigation $litigation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Litigation $litigation)
    {
        //
    }
}
