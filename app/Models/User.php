<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 1;
    const ROLE_READER = 0;

    public static function getRoles(){
        return [
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_READER => 'Читатель',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lastname',
        'surname',
        'photo',
        'phone',
        'address',
        'organization',
        'about',
        'dr',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function uploadImage(Request $request, $photo = null){
        if($request->hasFile('photo')){
            if($photo){
                Storage::disk('public')->delete($photo);
            }
            $folder = date('Y-m-d');
            return Storage::disk('public')->put("/avatar/{$folder}", $request['photo']);
        }
        return $photo;
    }

    public function getImage(){
        return $this->photo ? asset("uploads/{$this->photo}") : asset('no-image.jpg');
    }
}
