<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'slug', 'cover_img', 'status', 'type_id'];
    protected $appends = ['cover_img_url'];

    protected function coverImgUrl(): Attribute
    {
        return new Attribute(
            get: fn() => env('APP_FRONTEND_IMG_URL', 'http//localhost') . $this->cover_img
        );
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
