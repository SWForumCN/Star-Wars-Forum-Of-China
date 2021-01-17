<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 标签模型
 *
 * @author admiral-thrawn
 */
class Tag extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    public $incrementing = false;

    /**
     * 可以修改的字段
     *
     * @var array
     */
    protected $fillable = [
        // 标签名称
        'name',
    ];

    /**
     * 有此标签的文章
     *
     * @param string relationship taggable
     * @param string foreign_key tag_id
     * @param string foreign_key article_id
     *
     * @return Article
     */
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    /**
     * 有此标签的帖子
     *
     * @param string relationship taggables
     * @param string foreign_key tag_id
     * @param string foreign_key post_id
     *
     * @return Article
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggables');
    }
}
