# Laravel Multilang Posts #


[See Demo](https://github.com/benahmetcelik/laravel-multilang-posts)

### Installation ###
Add composer.json file :
```php
   "benahmetcelik/laravel-multilang-posts": "dev-main",
```
Run The Your Terminal :
```php
  php artisan vendor:publish
```
And 0 press

### Easy to use ###
Only Install and usage :)

### Change Colors ###
Config/multilang_post.php

```php
   'models'=>[
       
    
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
```


Simple Usage in blade file :
```php
 {!!  $your_model->getLangPost('en','column') !!}
```



This is simple. Isn't it?

