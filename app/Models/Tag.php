<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * The tag model
 *
 * @author admiral-thrawn
 */
class Tag extends Model
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
        // The name of the tag
        'name',
        /*
        Whether the tag is blocked
        if it is blocked, it can only be seen by the admins
        */
        'blocked',
    ];

    /**
     * Find the articles which have the tag
     *
     * @param string relationship article_tag
     * @param string foreign_key tag_id
     * @param string foreign_key article_id
     *
     * @return Article
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag', 'tag_id', 'article_id');
    }

    /**
     * Find the posts which have the tag
     *
     * @param string relationship post_tag
     * @param string foreign_key tag_id
     * @param string foreign_key post_id
     *
     * @return Article
     */
    public function posts()
    {
        return $this->belongsToMany(Article::class, 'post_tag', 'tag_id', 'post_id');
    }
}
