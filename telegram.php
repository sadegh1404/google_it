<?php 


class Telegram{


    
    public static $data ;


    public static function send($method,$data = []){
        if(!self::getApiToken()){
            echo "set Api Token first";
            return false;
        }
        $API_TOKEN = self::getApiToken();
        $url = 'https://api.telegram.org/bot'. $API_TOKEN .'/' . $method;
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($ch);
        if(curl_error($ch)){
            var_dump(curl_error($ch));
        }else{
            return $result; 
        }
        curl_close($ch);
    }


    public static function checkApi(){
        if(file_exists('token.db')){
            if(empty(file_get_contents('token.db'))){
                return false;
            }else{  
                return true;
            }
        }else{

            return false;
        }

    }

    public static function getApiToken(){

        if(self::checkApi()){
            $content = file_get_contents('token.db');
            return $content;
        }
        return false;
    }
    public static function setApiToken($token){
        $file = fopen('token.db','w+');
        fwrite($file,$token);
        fclose($file);
    }

    public static function setData($array){
        foreach($array as $key => $value){

            self::$data[$key] = $value;

        }
    }




}


?>