<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    protected $guarded = [];
    protected $withCount = ['likes'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
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

    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->created_at)->translatedFormat('F d, Y');
    }

    public function ipUser(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;

        return $ip;
    }

    public function likes(){
        return $this->hasMany(Like::class, 'post_id', 'id');
    }
}
