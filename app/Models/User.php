<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * The user model
 * @author admiral-thrawn
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Find articles which belongs to the user
     *
     * @param string table_name articles
     * @param string foreign_key author_id
     *
     * @return Article
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Find comments which belongs to the user
     *
     * @param string table_name comments
     * @param string foreign_key author_id
     *
     * @return Comment
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    /**
     * Find posts which belongs to the user
     *
     * @param string table_name posts
     * @param string foreign_key author_id
     *
     * @return Post
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    /**
     * Find topics which belongs to the user
     *
     * @param string table_name topics
     * @param string foreign_key author_id
     *
     * @return Topic
     */
    public function topics()
    {
        return $this->hasMany(Topic::class, 'author_id');
    }


    /**
     * Find the users which this user follows
     *
     * @param string table_name user_follow
     * @param string foreign_key follower_id (this user)
     * @param string foreign_key user_id
     *
     * @return User
     */
    public function follows()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follower_id', 'user_id');
    }

    /**
     * Find the users which follow this user
     *
     * @param string table_name user_follow
     * @param string foreign_key user_id
     * @param string foreign_key follower_id (this user)
     *
     * @return User
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follower_id');
    }

    /**
     * Find the topics which the user followed
     *
     * @param string table_name user_follow_topic
     * @param string foreign_id follower_id
     * @param string foreign_id topic_id
     *
     * @return Topic
     */
    public function followedTopics()
    {
        return $this->belongsToMany(Topic::class, 'user_follow_topic', 'follower_id', 'topic_id');
    }
}
