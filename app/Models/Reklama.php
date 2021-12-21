<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reklama extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getImage(){
        return $this->image ? asset("uploads/{$this->image}") : asset('no-image.jpeg');
    }
}
