<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }
}
