<?php

namespace App\Models\MultiLang;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultiLangPost extends Model
{
    use SoftDeletes;

    protected $table = 'multilang_posts';

}
