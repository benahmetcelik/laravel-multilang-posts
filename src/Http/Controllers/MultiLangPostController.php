<?php

namespace MultiLangPost\Http\Controllers;

use Closure;


use Illuminate\Container\Container;
use Illuminate\Http\Response;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Illuminate\Routing\RouteSignatureParameters;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Mockery\Generator\Parameter;
use Symfony\Component\HttpFoundation\ParameterBag;

class MultiLangPostController
{
    public function index($model = null)
    {
       print_r($model);
    }

    public function content(Request $request,$lang,$slug){
        print_r($slug);
        echo '<br>';
        print_r($lang);

        echo '<br>';
        $session = \session()->get('data');
        print_r($session);
      //  print_r(cookie('ml_view'));
     //   return new \Illuminate\Http\Response(view($view,$data));
    }
    public function query($route,$view,$slug){
        foreach(Route::getRoutes() as $value){
            if ( $value->getName() == $route){
                $controller =  $value->getActionName();
                $params = $value->parameterNames();
            }

        }
        $controller = explode('@',$controller);

        $fooController = app()->make($controller[0]);
    //   $news = $fooController->callAction($controller[1], $params);
    //  print_r($fooController->callAction($controller[1], $params));



        $response = new \App\Http\Controllers\Controller();
        $response->callAction($controller[1], $params);














       die();
        $clasure = new Response();
        $teste = $clasure->send($fooController->callAction($controller[1], $params));
         die();

     //   $fooController = app()->make($controller[0]);
            $fooController =$controller[0];
       $deneme = App::make($fooController,['slug'=>'kurumsal-web-sitemiz-yayinda']);
             print_r($deneme);
die();



        $app = new Container();
        $app_a = $app->make($controller[1],$params);
        $app_a = $app->bindMethod($controller[1]);
        print_r($fooController->callAction($controller[1], $params));
        die();


        $clasure = new Response();
       $teste = $clasure->send($fooController->callAction($controller[1], $params));






        die();
        $test = \response($fooController->callAction($controller[1], $params)) ;
        print_r($test);
        die();
      $response =  Response::create(\route($route,$slug));

        print_r($response);


        $aa =\response($response->original)->getOriginalContent();
        print_r($aa);

        die();

        //(Request::create(\route($route,$slug)));
        $view = $response->original; // View object

        print_r($view->getData());
     //   $data = $view->getData(); //view data
        die();

   echo   \App::call($controller,['slug'=>'kurumsal-web-sitemiz-yayinda']);
//print_r($controller);

/*
        $response = response($request);
        $view = $response->original; // View object
        $data = $view->getData(); //view data
*/

        //$response = $next($request);
       // print_r($response->original);
        $lang = 'en';
        $model = app($this->searchModel($route))::where(config('multilang_post.models')[$this->searchModel($route)]['slug_column'], $slug)->first();
        if ( $model->getLangPost($lang)){
            $data['news'] = $model->getLangPost($lang);

        }


    }

    private function searchModel($route)
    {
        $models = config('multilang_post.models');
        foreach ($models as $key => $value) {
            if ($value['route'] == $route) {
                return $key;
            }
        }
        return redirect()->back();
    }

}