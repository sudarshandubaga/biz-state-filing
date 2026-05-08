<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => 'string',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) $model->slug = Str::slug($model->title);
            if (empty($model->author_id) && auth('admin')->check()) {
                $model->author_id = auth('admin')->id();
            }
        });
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_blog_category', 'blog_id', 'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_blog_tag', 'blog_id', 'blog_tag_id');
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
}
