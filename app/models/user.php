<?php
/**
 * Created by PhpStorm.
 * User: Tunay
 * Date: 7/29/2017
 * Time: 3:22 PM
 */
namespace app\models;
use core\Model;

class user extends Model {
    public $table = 'user';
    protected $fields=[
        'ad',
        'no',
        'soyad'
    ];
}