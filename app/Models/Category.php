<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->format('d/m/Y H:i');
    }
}
