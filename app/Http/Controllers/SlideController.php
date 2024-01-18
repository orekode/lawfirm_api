<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Models\Slide;
use App\Http\Resources\SlideResource;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $this->proccessFilters($request);

        return SlideResource::collection(
            Slide::where($filters)->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlideRequest $request)
    {
        $image = $request->file('image')->store('images/slides');

        return Slide::create([
            ...$request->all(),
            'image' => $image,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slide $slide)
    {
        return new SlideResource( $slide );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        $image = $slide->image;

        if(isset($request->image)) 
            $image = $request->file('image')->store('images/slides');
        
        return $slide->update([
            ...$request->all(),
            'image' => $image,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
    }
}
