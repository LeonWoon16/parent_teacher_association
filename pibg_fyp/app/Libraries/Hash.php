<?php
namespace App\Libraries;

class Hash{

    public static function check($entered_password, $db_password){
        if($entered_password === $db_password){
            return true;
        }else{
            return false;
        }
    }
}

?>