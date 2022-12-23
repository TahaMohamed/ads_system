<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TagRequest;
use App\Http\Resources\Api\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::withCount('ads')->latest()->paginate();
        return $this->paginateResponse(TagResource::collection($tag),$tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();
        return $this->successResponse(data: TagResource::make($tag), message: __('dashboard.messages.success_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::with('ads:id,title')->findOrFail($id);
        return $this->successResponse(TagResource::make($tag));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();
        return $this->successResponse(data: TagResource::make($tag), message: __('dashboard.messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->successResponse(data: TagResource::make($tag), message: __('dashboard.messages.success_delete'));
    }
}
