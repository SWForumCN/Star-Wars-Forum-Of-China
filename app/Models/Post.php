<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * The Post model
 *
 * @author admiral-thrawn
 */
class Post extends Model
{
    use HasFactory;

    /**
     * Disable primary key auto-increment
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The fillable columns
     *
     * @var array
     */
    protected $fillable = [
        // The title of the post
        'title',
        // The content (written in Markdown)
        'content',
        // The author of post
        'author_id',
        // The Post which this post replies to
        'parent_id',
        /*
        Whether the post is blocked
        if it is blocked, it can only be seen by the admins
        */
        'blocked',
    ];

    /**
     * Find the author of the post
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
     * Find the tags of the post
     *
     * @param string table_name tags
     *
     * @param string relationship post_tag
     * @param string foreign_key post_id
     * @param string foreign_key tag_id
     *
     * @return Tag
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    /**
     * Find the parent-post of the post
     */
    public function parentPost()
    {
        // TODO
    }

    /**
     * Find the sub-posts of the post
     */
    public function subPosts()
    {
        // TODO
    }
}
