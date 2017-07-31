<?php

/**
 * Created by PhpStorm.
 * User: Tunay
 * Date: 7/29/2017
 * Time: 2:04 PM
 */
namespace core;
use app\controllers\maincontroller;

class app
{
    public static function route($url){
        $url = urldecode($url);
        $link = explode('/',$url);
        if(isset($link[1]) && $link[1]!=null){
            $controller =$link[1].'controller';
            $s= 'app\controllers\\';
            $method = isset($link[2]) ? $link[2] : '';
            $controller =$s.$controller;
            if(class_exists($controller)){
                $controller = new $controller;
                if(method_exists($controller,$method)){
                    $data = $controller->$method();
                } else{
                    $method='index';
                    $data = $controller->$method();
                }
                return ['controller'=>$link[1],'method'=>$method,'data'=>$data];
            } else{
                header('Location:/');
            }
        }
        else{
            $data =  (new maincontroller())->index();
            return ['controller'=>'main','method'=>'index','data'=>$data];
        }
    }

    public static function init(){
        ob_start();
        spl_autoload_register(function ($class){
            str_replace('/\\\/','/',$class);
            include_once ROOT.'\\'.$class.'.php';
        });
    }
}