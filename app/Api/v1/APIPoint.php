<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\PlayerPoints;



class APIPoint 
{
    
    public function index(){        
      
        $allplayerpoints = PlayerPoints::all();

        if($allplayerpoints){
            return response()->json([
                'status'=>'success',
                'code'=>200,
                'message'=>'You are Points API Root',
                'data'=> $allplayerpoints
            ]);
        }else{
            return response()->json([
                'status'=>'success',
                'code'=>404,
                'message'=>'No Player point found',
                'data'=> null
            ]);
        }
            
       

    }

    public function point(Array $data){
        $id = $data['id'];
        $point = PlayerPoint::find($id);

        if($point){

            return response()->json([
                'status'=>'success',
                'code'=>200,
                'message'=>'Player Point Found',
                'data'=> $point
            ]);

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>404,
                'message'=>'Player Point Not Found',
                'data'=> null
            ]);

        }

    }

    public static function UpdatePlayerPoint(Array $data){
        
                $player_id = $data['player_id'];
                $points = $data['points'];
        
                $playerPoints = PlayerPoints::find($player_id);

                if($playerPoints){
                    $former = $playerPoints->points;
                    $update = $former + $points;

                    $addtoplayerpoint = $playerPoints->point = $update;

                    if($addtoplayerpoint){
                        
                            return response()->json([
                                'status'=>'success',
                                'code'=>200,
                                'message'=>'Player Point Updated',
                                'data'=> $addtoplayerpoint
                            ]);
                
                        }else{
                            return response()->json([
                                'status'=>'error',
                                'code'=>500,
                                'message'=>'Player Not Updated',
                                'data'=> null
                            ]);
                        }
                }else{
                   
                    $createPlayerPoint = PlayerPoints::create([
                        'player_id'=>$player_id,
                        'points'=>$points
                    ]);
                        
                    if($createPlayerPoint){
                        return response()->json([
                            'status'=>'success',
                            'code'=>200,
                            'message'=>'Player Point Created',
                            'data'=> $addtoplayerpoint
                        ]);
                    }else{
                        return response()->json([
                            'status'=>'error',
                            'code'=>500,
                            'message'=>'Player Not Created',
                            'data'=> null
                        ]);
                    }
                }

               
        
            }
}
