<?php

class Data_Manager {


    public static function savePlayer($id, $obj) {

        $objData = serialize($obj);
        $fp = fopen('Player_'.$id.'.txt', "w");
        fwrite($fp, $objData);
        fclose($fp);

    }

    public static function loadPlayer($id) {

        $objData = file_get_contents('Player_'.$id.'.txt');
        $obj = unserialize($objData);
        return $obj;

    }




}