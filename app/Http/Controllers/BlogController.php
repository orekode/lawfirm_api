<?php

namespace App\Http\Controllers;

use Illuminate\Http\request;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =  $this->proccessFilters($request);

        return BlogResource::collection(
            Blog::where($filters)->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $image = $request->file('image')->store('images/blog');
        $cover_image = $request->file('cover_image')->store('images/blog/cover');

        // return $request->all();
        $blog = Blog::create([
            ...$request->all(),
            'image' => $image,
            'cover_image' => $cover_image,
            'category_id' => $request->category,
        ]);

        return $blog;
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $image = $blog->image;
        $cover_image = $blog->cover_image;

        if(isset($request->image))             
            $image = $request->file('image')->store('images/blog');

        if(isset($request->cover_image)) 
            $cover_image = $request->file('cover_image')->store('images/blog/cover');

        $blog->update([
            ...$request->all(),
            'cover_image' => $cover_image,
            'image'       => $image,
            'category_id' => $request->category,
        ]);

        return $blog;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    }
}
