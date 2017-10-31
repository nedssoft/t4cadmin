<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Players;

class TokenizerController extends Controller
{
    
    protected static function generate(){
        
        $token = str_random(40);

        return $token;
    }

    protected static function refresh($id){
        
        $player = Players::find($id);

        if($player){
            $token = self::generate();
            $player->token = $token;
            $refresh = $player->save();

            if($refresh){

                return $token;             

            }else{
                return 'error';
            }

        }else{
            return 'user not found';
        }
    }

    protected static function getToken($id){
        $find = Players::find($id);

        if($find){
            return $find;
        }else{
            return "not found"
        }
    }

}
