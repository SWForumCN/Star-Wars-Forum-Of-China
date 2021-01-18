<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\HasParentAndSub;
use App\Traits\HasTags;
use App\Traits\HasTopic;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelLike\Traits\Likeable;

/**
 * 帖子模型
 *
 * @author admiral-thrawn
 */
class Post extends Model
{
    use HasFactory,
        Uuids,
        SoftDeletes,
        HasAuthor,
        HasTopic,
        HasTags,
        HasParentAndSub,
        Likeable,
        Favoriteable,
        Searchable;

    public $incrementing = false;

    /**
     * 可以修改的字段
     *
     * @var array
     */
    protected $fillable = [
        // 帖子标题
        'title',
        // 内容
        'content',
        'content_raw',
        // 回复的帖子
        'parent_id',
        // 话题
        'topic_id',
    ];

    /**
     * 去除HTML标签
     */
    public function cleanContent()
    {
        return strip_tags($this->content);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'cleanContent' => $this->cleanContent()
        ];
    }
}
