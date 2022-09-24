<?php

namespace MultiLangPost\Traits;


use App\Models\MultiLang\MultiLangLang;
use App\Models\MultiLang\MultiLangPost;
use App\Models\MultiLang\MultiLangSeting;

use App\Scopes\MultiLangScope;
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
    /**
     * @return $this
     * Not Tested
     */
    public function getLangPost($lang=''){
        if (strlen($lang) > 0){
               $multi_post = $this->multipost;
           $query =  $multi_post->where('model', get_class($this))->where('model_id', $this->id)->where('lang',$lang)->first();
             if (!$query){
                 $this->generateMultiPost();
             }
             return $query;
        }else{
            return $this;
        }
    }

    /**
     * @return $this
     * Not Tested
     */
    public function getLangPosts(){
            $multi_post = $this->multipost;
            $query =  $multi_post->where('model', get_class($this))->where('model_id', $this->id)->where('lang',session('locale'))->first();
            if ($query){
                return $query;
            }else{
                Schema::table($multi_post->getTable(), function (Blueprint $table) use ($multi_post) {
                    $multi_post->model = get_class($this);
                    $multi_post->model_id = $this->id;
                    foreach (Schema::getColumnListing($this->getTable()) as $column) {
                        if ( $column != 'id'){
                            if (!Schema::hasColumn($multi_post->getTable(), $column)){
                                $table->string($column)->nullable();
                                $multi_post->$column = $this->$column;
                            }else{
                                $multi_post->$column = $this->$column;
                            }
                        }
                    }
                });
                $multi_post->save();
                return $this;
            }

    }



    public function scopeML()
    {
        $multi_post = $this->multipost;
        return $multi_post->where('model', get_class($this))->where('lang',session('locale'));
    }




    /**
     * @return mixed
     * Generate Multi Post
     */
    public function generateMultiPost()
    {
       $multi_post = $this->multipost;
       $langs = $this->multipost_langs;
       foreach ($langs as $lang){
           $multipost_query = $multi_post->where('model', get_class($this))->where('model_id', $this->id)->where('lang',$lang)->first();
           if (!$multipost_query) {
               Schema::table($multi_post->getTable(), function (Blueprint $table) use ($multi_post) {
                   $multi_post->model = get_class($this);
                   $multi_post->model_id = $this->id;
                   foreach (Schema::getColumnListing($this->getTable()) as $column) {
                       if ( $column != 'id'){
                           if (!Schema::hasColumn($multi_post->getTable(), $column)){
                               $table->string($column)->nullable();
                               $multi_post->$column = $this->$column;
                           }else{
                               $multi_post->$column = $this->$column;
                           }
                       }

                   }
               });
               $multi_post->save();
           } else {
               $multipost_query->model = get_class($this);
               $multipost_query->model_id = $this->id;
               foreach (Schema::getColumnListing($this->getTable()) as $column) {
                   $multipost_query->$column =  $this->$column;
               }
               $multipost_query->status = 1;
               $multipost_query->save();
           }
       }

    }




}
