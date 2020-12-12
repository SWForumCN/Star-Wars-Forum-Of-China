<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * 用户模型
 * @author admiral-thrawn
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, UseUuid;

    /**
     * 允许修改的字段
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * 隐藏的字段
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
     * 用户发布的文章
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
     * 用户发布的评论
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
     * 用户发布的帖子
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
     * 用户发布的话题
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
     * 用户关注
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
     * 关注此用户者
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
     * 用户关注的主题
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
