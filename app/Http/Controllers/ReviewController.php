<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;

use App\Http\Resources\ReviewResource;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =  $this->proccessFilters($request);

        return ReviewResource::collection(
            Review::where($filters)->orderBy('created_at', 'desc')->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $image = $request->file('image')->store('images/reviews');

        $review = Review::create([
            ...$request->all(),
            "image" => $image,
        ]);

        return new ReviewResource($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {

        $image = $review->image;

        if(isset($request->image)) $image = $request->file('image')->store('images/reviews');

        $review->update([
            ...$request->all(),
            "image" => $image
        ]);

        return new ReviewResource($review);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        return $review->delete();
    }
}
