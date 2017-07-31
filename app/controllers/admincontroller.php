<?php

/**
 * Created by PhpStorm.
 * User: Tunay
 * Date: 7/29/2017
 * Time: 1:21 PM
 */
namespace app\controllers;
use app\models\user;

class admincontroller
{
    public function index(){
        $str = "<hr>Hello admincontroller";
        return $str;
    }
}