<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLitigationRequest;
use App\Http\Requests\UpdateLitigationRequest;
use App\Models\Litigation;

use App\Http\Resources\LitigationResource;

class LitigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filters =  $this->proccessFilters($request);

        return LitigationResource::collection(
            Litigation::where($filters)->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLitigationRequest $request)
    {
        $image = $request->file('image')->store('images/litigation');
        $cover_image = $request->file('cover_image')->store('images/litigation/cover');

        // return $request->all();
        $litigation = Litigation::create([
            ...$request->all(),
            'image' => $image,
            'cover_image' => $cover_image,
        ]);

        return $litigation;
    }

    /**
     * Display the specified resource.
     */
    public function show(Litigation $litigation)
    {
        return new LitigationResource($litigation);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLitigationRequest $request, Litigation $litigation)
    {
        $image = $litigation->image;
        $cover_image = $litigation->cover_image;

        if(isset($request->image))             
            $image = $request->file('image')->store('images/litigation');

        if(isset($request->cover_image)) 
            $cover_image = $request->file('cover_image')->store('images/litigation/cover');

        $litigation->update([
            'title'       => $request->title,
            'description' => $request->description,
            'description' => $request->description,
            'cover_image' => $cover_image,
            'image'       => $image,
        ]);

        return $litigation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Litigation $litigation)
    {
        return $litigation->delete();
    }
}
