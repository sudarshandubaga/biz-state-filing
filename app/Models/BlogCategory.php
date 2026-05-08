<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $guarded = [];

    protected $casts = ['status' => 'boolean'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) $model->slug = Str::slug($model->name);
        });
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_blog_category');
    }
}
