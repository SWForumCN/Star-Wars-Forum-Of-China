<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 话题模型
 * @author admiral-thrawn
 */
class Topic extends Model
{
    use HasFactory, UseUuid;

    /**
     * 可以修改的字段
     *
     * @var array
     */
    protected $fillable = [
        // 话题名称
        'name',
        // 话题介绍
        'description',
        // 发布者
        'author_id',
        /*
        话题是否被封禁
        如果被封禁只有管理员可见
        */
        'blocked',
    ];

    /**
     * 话题创建者
     *
     * @param string table_name users
     * @param string foreign_key author_id
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * 此话题下的帖子
     *
     * @param string table_name posts
     * @param string foreign_key topic_id
     *
     * @return Post
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'topic_id');
    }

    /**
     * 此话题下的文章
     *
     * @param string table_name articles
     * @param string foreign_key topic_id
     *
     * @return Article
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'topic_id');
    }

    /**
     * 关注此话题者
     *
     * @param string table_name user_follow_topic
     * @param string foreign_key topic_id
     * @param string foreign_key follower_id
     *
     * @return User
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow_topic', 'topic_id', 'follower_id');
    }
}
