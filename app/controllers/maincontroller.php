<?php
/**
 * Created by PhpStorm.
 * User: Tunay
 * Date: 7/29/2017
 * Time: 1:22 PM
 */

namespace app\controllers;


use app\models\user;

class maincontroller
{
    public function index(){
        $user = new user();
        $data = "by Tunay Novruzov";
        /**
         * Examples of using Model Methods
         */
//        $data = $user->insert(['1','34','iki'])->run();
//        $data = $user->select(['id','ad'])->where(['id<'=>5])->limit(20)->run();
//        $data = $user->update(['ad'=>'Armut'])->where(['id='=>'1'])->run();
//        $data = $user->delete()->where(['id='=>'44'])->run();

        return $data;
    }

}