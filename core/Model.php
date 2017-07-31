<?php
/**
 * Created by PhpStorm.
 * User: Tunay
 * Date: 7/30/2017
 * Time: 2:59 PM
 */

namespace core;
use PDO;

abstract class Model
{
    protected $table = null;
    protected $fields = null;
    public $query ;
    public $values;
    private $db=null;
    private $is_select = false;


    private function get_connection(){
        if($this->db == null){
            $host  = 'mysql:host='.DB_HOST.';dbname='.DB. ';charset=utf8';
            $db = new PDO($host,DB_USER,DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $db;
        }
        return $this->db;
    }
    public function select($fields=[]){
        $sql ="SELECT ";
        if(count($fields)>0){
            for($j=0;$j<count($fields);$j++){
                $sql.=$fields[$j].',';
            }
            $sql =rtrim($sql,',');
        }else{
            $sql.=' * ';
        }

        $sql.= " FROM {$this->table}";
        $this->query=$sql;
        $this->is_select=true;
        return $this;
    }
    public function insert($values){
        $fields = implode(',',$this->fields);
        $str=[];
        for ($i=0;$i<count($this->fields);$i++){
            $str[]='?';
        }
        $qu_mark = implode(',',$str);
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($qu_mark)";
        $this->values = $values;
        $this->query = $sql;
        return $this;
    }
    public function update($values){
        $sql = "UPDATE {$this->table} SET ";
        foreach ($values as $key=>$value){
            $sql.=$key.'= ? ';
            $this->values[]=$value;
        }
        $this->query = $sql;
        return $this;
    }
    public function delete(){
        $sql = "DELETE FROM {$this->table}";
        $this->query =$sql;
        return $this;
    }
    public function where($fileds = [],$if=[]){
        $k=0;
        $i=0;
        if (count($fileds)>0){
            $sql = ' WHERE ';
            foreach ($fileds as $key=>$value){
                if($k==0){
                    $sql.=" $key ? ";
                    $k++;
                }
                else{
                    $sql.= !empty($if[$i]) ? $if[$i]:' AND ';
                    $sql.= " $key ? ";
                    $i++;
                }
                $this->values[] = $value;
            }
            $this->query.=$sql;
        }
        return $this;
    }
    public function limit($limit=0){
        if($limit>0){
            $this->query.= ' LIMIT ? ';
            $this->values[]=$limit;
        }
        return $this;
    }
    public function run(){
        //var_dump($this->query);
        //var_dump($this->values);
        /*exit;*/
        $conn = $this->get_connection();
        $conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        $stmt =$conn->prepare($this->query);
        $result=$stmt->execute($this->values);
        if($this->is_select) {
            $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}