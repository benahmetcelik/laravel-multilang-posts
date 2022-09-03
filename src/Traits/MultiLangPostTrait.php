<?php

namespace MultiLangPost\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;
use MultiLangPost\Services\Helper;

trait MultiLangPostTrait
{



    public function getSeoTitles()
    {
        if ($this->seo_title == null && array_key_exists(get_class($this), config('seo.models'))) {
                $this->generateSeoTitle();
        }
        return '<title>' . $this->seo_title . '</title>
<meta property="og:title" content="' . $this->seo_title . '" />

<meta name="twitter:title" content="' . $this->seo_title . '"/>

';
    }




    public function generateSeoKeywords()
    {
        if (!Schema::hasColumn($this->getTable(), 'seo_keywords')) {
            Schema::table($this->getTable(), function (Blueprint $table) {
                $table->string('seo_keywords');
            });
        }
        $this->seo_keywords = Helper::generate_keyword($this->value(config('seo.models')[get_class($this)]['keywords_column']));
        $this->save();
        return $this->seo_keywords;
    }

    public function generateSeoDesc()
    {
        if (!Schema::hasColumn($this->getTable(), 'seo_desc')) {
            Schema::table($this->getTable(), function (Blueprint $table) {
                $table->string('seo_desc');
            });
        }
        $this->seo_desc = Helper::shorten($this->value(config('seo.models')[get_class($this)]['desc_column']), config('seo.models')[get_class($this)]['desc_lenght']);
        $this->save();
        return $this->seo_desc;
    }


    /**
     * @return mixed
     * Generate Seo Title
     */
    public function generateSeoTitle()
    {
        if (!Schema::hasColumn($this->getTable(), 'seo_title')) {
            Schema::table($this->getTable(), function (Blueprint $table) {
                $table->string('seo_title');
            });
        }
        $this->seo_title = $this->value(config('seo.models')[get_class($this)]['title_column']);
        $this->save();
        return $this->seo_title;
    }


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->seo_title = $model->generateSeoTitle();
            $model->seo_desc = $model->generateSeoDesc();
        });
        static::updating(function ($model) {
            if ($model->seo_title == null) {
                $model->seo_title = $model->generateSeoTitle();
            }
            if ($model->seo_desc == null) {
                $model->seo_desc = $model->generateSeoDesc();
            }
        });

    }


}
