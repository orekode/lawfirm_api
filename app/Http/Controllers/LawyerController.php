<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLawyerRequest;
use App\Http\Requests\UpdateLawyerRequest;
use App\Models\Lawyer;

use App\Http\Resources\LawyerResource;

use Illuminate\Http\Request;

class LawyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $this->proccessFilters($request);

        return LawyerResource::collection(
            Lawyer::where($filters)->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLawyerRequest $request)
    {
        $image = $request->file('image')->store('images/lawyers');

        $lawyer = Lawyer::create([
            ...$request->all(),
            'image' => $image
        ]);

        return new LawyerResource( $lawyer );

    }

    /**
     * Display the specified resource.
     */
    public function show(Lawyer $lawyer)
    {
        return new LawyerResource( $lawyer );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLawyerRequest $request, Lawyer $lawyer)
    {
        $image = $lawyer->image;
        
        if(isset($request->image)) $image = $request->file('image')->store('images/lawyer');

        $lawyer->update([
            ...$request->all(),
            'image' => $image,
        ]);

        return new LawyerResource( $lawyer );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lawyer $lawyer)
    {
        return $lawyer->delete();
    }
}
