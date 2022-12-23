<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AdRequest;
use App\Http\Resources\Api\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $advertiser_id = null)
    {
        $ad = Ad::filter($request)
            ->when($advertiser_id,fn($q) => $q->where('advertiser_id',$advertiser_id))
            ->withCount('tags')
            ->with('category:id,name','advertiser:id,name')
            ->latest()
            ->paginate();
        return $this->paginateResponse(AdResource::collection($ad),$ad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request, Ad $ad)
    {
        $ad->fill($request->validated())->save();
        $ad->tags()->attach($request->tags);
        return $this->successResponse(data: AdResource::make($ad), message: __('dashboard.messages.success_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::with('tags:id,name','category:id,name','advertiser:id,name')->findOrFail($id);
        return $this->successResponse(AdResource::make($ad));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, Ad $ad)
    {
        $ad->fill($request->validated())->save();
        $ad->tags()->sync($request->tags);
        return $this->successResponse(data: AdResource::make($ad), message: __('dashboard.messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return $this->successResponse(data: AdResource::make($ad), message: __('dashboard.messages.success_delete'));
    }
}
