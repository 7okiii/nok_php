<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // 削除されるとデータベースでdeleted_atが付与される（完全に削除されないので後からデータを追える）
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'contents',
        'contents_of_html',
        'post_type_id',
        'is_display',
        'created_user_id',
        'updated_user_id',
        'img_path',
    ];

    /**
     * Imageモデルに対してのリレーション
     *
     * @return void
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
