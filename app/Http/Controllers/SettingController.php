<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $this->proccessFilters($request);

        return SettingResource::collection(
            Setting::where($filters)->orderBy('created_at', 'desc')->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        $image = $request->file('image')->store('/images/settings');
        $cover_image = $request->file('digital_address')->store('/images/settings');

        return Setting::create([
            ...$request->all(),
            "digital_address" => $cover_image,
            "logo" => $image,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return new SettingResource ($setting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $image = $setting->logo;
        $cover_image = $setting->digital_address;

        if(isset($request->image)) $image = $request->file('image')->store('/images/settings');
        if(isset($request->digital_address)) $cover_image = $request->file('digital_address')->store('/images/settings');

        return $setting->update([
            ...$request->all(),
            "digital_address" => $cover_image,
            "logo" => $image,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
    }
}
