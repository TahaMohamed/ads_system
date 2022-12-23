<?php

namespace App\Models;

use App\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    protected $dates = ['start_at'];

    public function scopeFilter($q, $request)
    {
        $q->when($request->search, function ($q) use ($request) {
            $q->where(fn($q) => $q->where('title', 'LIKE', "%$request->search%")->orWhere('description', 'LIKE', "%$request->search%"));
        })->when($request->tag_id, function ($q) use ($request) {
            $q->whereHas('tags', fn($q) => $q->where('tags.id', $request->tag_id));
        })->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function advertiser()
    {
        return $this->belongsTo(User::class,'advertiser_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
