<?php

namespace App\Models\MultiLang;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultiLangSeting extends Model
{
    use SoftDeletes;

    protected $table = 'multilang_settings';

}
