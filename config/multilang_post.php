<?php
return [


    /**
     * Models For Sitemaps And SEO
     */
    'models' => [

        'App\Models\News' => [
            'title_column' => 'title',
            // Column to be keywords (data in this column will be spaced and combined with (,))
            'keywords_column' => 'title',
            'desc_column' => 'content',
            'image' => true,
            'image_column' => 'image',
            'desc_lenght' => 10,
            'slug_column' => 'slug',
            'route' => 'news'
        ]


    ]
];