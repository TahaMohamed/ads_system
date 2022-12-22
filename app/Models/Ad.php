<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

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
