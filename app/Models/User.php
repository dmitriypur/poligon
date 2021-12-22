<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 1;
    const ROLE_READER = 0;

    public static function getRoles()
    {
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

    public static function uploadAvatar(Request $request, $photo = null)
    {
        if ($request->hasFile('photo')) {
            if ($photo) {
                Storage::disk('public')->delete($photo);
            }
            $folder = date('Y-m-d');
            return Storage::disk('public')->put("/avatar/{$folder}", $request['photo']);
        }
        return $photo;
    }

    public function getImage()
    {
        return $this->photo ? asset("uploads/{$this->photo}") : asset('no-image.jpeg');
    }

    public function bookmarkPosts()
    {
        return $this->belongsToMany(Post::class, 'post_user_bookmarks');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
            ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
            ->withTimestamps();
    }

    public function follow($userId)
    {
        $this->follows()->attach($userId);
        return $this;
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }

    public function isFollowing($userId)
    {
        return (boolean) $this->follows()->where('follows_id', $userId)->first(['user_id']);
    }

    public function sendPasswordResetNotification($token)
    {
        // Добавляем свой класс.
        $this->notify(new ResetPasswordNotification($token));
    }

    public function subscriptionCategories()
    {
        return $this->belongsToMany(Category::class, 'subscription_category', 'user_id', 'category_id')
            ->withTimestamps();
    }

    public function subscriptionCat($catId)
    {
        $this->subscriptionCategories()->attach($catId);
        return $this;
    }

    public function unsubscribeCat($catId)
    {
        $this->subscriptionCategories()->detach($catId);
        return $this;
    }
    public function isSubscriptionCat($catId)
    {
        return (boolean) $this->subscriptionCategories()->where('category_id', $catId)->first(['user_id']);
    }
}
