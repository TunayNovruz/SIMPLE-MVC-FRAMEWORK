<?php
/**
 * Created by PhpStorm.
 * User: Tunay
 * Date: 7/29/2017
 * Time: 4:18 PM
 */

namespace core;


class view
{
    public static function render (array $ar =[])
    {
        if(!empty($ar) && count($ar)>1){
            $folder=$ar['controller'];
            $method=$ar['method'];
            $message=$ar['data'];;
            include ROOT."/app/views/".$folder.'/'.$method.'.php';
        }
        else{
            header('Location: \\');
        }
    }
}