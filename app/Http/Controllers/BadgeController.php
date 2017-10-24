<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Badges;



class BadgeController extends Controller
{
    
    public function index(){
        return view('badges.badges');
    }

    public function create(Request $request){
        
        $data = $request->all();
        
        $name = $data['name'];
        $icon = $data['icon'];
        $points = $data['points'];

        $badget = Badges::create([
            'name'=>$name,
            'icon'=>$icon,
            'points'=>$points
        ]);

        if($badget){
            return response()->json([
                'status'=>'success',
                'code'=>201,
                'message'=>'Badge was created',
                'data'=> $badge
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'code'=>504,
                'message'=>'Something went wrong, badge was not created',
                'data'=> null
            ]);
        }

    }

    public function update(Request $request){
        
        $data = $request->all();       
        $badge = Badges::find($data['id']);

        if($badge){

            $badge->name = $data['name'];
            $badge->icon = $data['icon'];
            $badge->points = $data['points'];
            
            if($badge->save()){
                
                return response()->json([
                    'status'=>'Success',
                    'code'=>201,
                    'message'=>'Badge Updated',
                    'data'=> null
                ]);

            }else{

                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'message'=>'Badge not updated, something went wrong',
                    'data'=> null
                ]);

            }            

        }else{
            return response()->json([
                'status'=>'error',
                'code'=>504,
                'message'=>'Badge Not Found',
                'data'=> null
            ]);
        }

    }

    public function badge($id){

        $badge = Badges::find($id);

        if($badge){

            return response()->json([
                'status'=>'success',
                'code'=>200,
                'message'=>'Badge Found',
                'data'=> null
            ]);

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>500,
                'message'=>'Badge Not Found',
                'data'=> null
            ]);

        }

    }

}
