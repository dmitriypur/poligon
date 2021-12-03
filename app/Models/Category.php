<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'title',
        'image',
        'description'
    ];

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function uploadImage(Request $request, $image = null){
        if($request->hasFile('image')){
            if($image){
                Storage::disk('public')->delete($image);
            }
            $folder = date('Y-m-d');
            return Storage::disk('public')->put("/images/{$folder}", $request['image']);
        }
        return $image;
    }

    public function getImage(){
        return $this->image ? asset("uploads/{$this->image}") : asset('no-image.jpg');
    }
}
