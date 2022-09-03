<?php

namespace MultiLangPost\Traits;

use App\Models\MultiLang\MultiLangLang;
use App\Models\MultiLang\MultiLangPost;
use App\Models\MultiLang\MultiLangSeting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;
use MultiLangPost\Services\Helper;

trait MultiLangPostTrait
{

    protected $multipost;
    protected $multipost_settings;
    protected $multipost_langs;

    public function __construct()
    {
        $this->multipost =  new MultiLangPost();
        $this->multipost_settings =  new MultiLangSeting();
        $this->multipost_langs =  new MultiLangLang();

    }

    public function getLangPost($model,$lang=''){
        if (strlen($lang) > 0){
            $multi_post = $this->multipost;
             return $multi_post->where('model', get_class($this))->where('model_id', $this->id)->first();
        }else{
            return $model;
        }
    }

    /**
     * @return mixed
     * Generate Multi Post
     */
    public function generateMultiPost()
    {
       $multi_post = $this->multipost;
        $multipost_query = $multi_post->where('model', get_class($this))->where('model_id', $this->id)->first();
        if (!$multipost_query) {
            Schema::table($this->getTable(), function (Blueprint $table) use ($multi_post) {
                foreach (Schema::getColumnListing($this) as $column) {
                    $table->string($column);
                    $multi_post->$column = $this->value($column);
                }
            });
            $multi_post->save();
        } else {
            foreach (Schema::getColumnListing($this) as $column) {
                $multipost_query->$column = $this->value($column);
            }
            $multipost_query->save();
        }
    }


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->generateMultiPost();
        });
        static::updating(function ($model) {
            $model->generateMultiPost();
        });

    }


}
