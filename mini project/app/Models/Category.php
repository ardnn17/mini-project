<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gambar'
    ];

    public function post()
    {
        return $this->hasMany(Post::class,"category_id","id");
    }
}
