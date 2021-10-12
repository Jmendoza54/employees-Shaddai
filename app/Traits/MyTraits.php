<?php

namespace App\Traits;

trait MyTraits{
    public function generateCode($length){
        $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($pattern);
        $random_string = '';
        for($i = 0; $i < $length; $i++) {
            $random_character = $pattern[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
    }

    public function getUrlImg($target, $code){
        return route('download.'.$target,['code' => $code]);
    }
}