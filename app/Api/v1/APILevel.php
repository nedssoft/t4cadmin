<?php

namespace App\Api\v1;

use Illuminate\Http\Request;

Use App\Levels;

class APILevel
{
    public function index(){
        
        $all = Levels::all();

        if($all){

            return response()->json([
                'status'=>'success',
                'code'=>201,
                'message'=>'All Levels',
                'data'=> $all
            ]);

        }else{
            return response()->json([
                'status'=>'error',
                'code'=>404,
                'message'=>'No levels',
                'data'=> null
            ]);
        }
        

    }

    public static function create(Array $data){       
       
        
        $name = $data['name'];
        $icon = $data['icon'];
        $description = $data['description'];

        $level = Levels::create([
            'name'=>$name,
            'icon'=>$icon,
            'description'=>$description
        ]);

        if($level){

            return response()->json([
                'status'=>'success',
                'code'=>201,
                'message'=>'Level was created',
                'data'=> $levels
            ]);

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>504,
                'message'=>'Something went wrong, level was not created',
                'data'=> null
            ]);

        }

    }

    public static function update(Array $data){        
         
        $level = Levels::find($data['id']);

        if($level){

            $level->name = $data['name'];
            $level->icon = $data['icon'];
            $level->points = $data['description'];
            
            if($level->save()){
                
                return response()->json([
                    'status'=>'Success',
                    'code'=>201,
                    'message'=>'Level Updated',
                    'data'=> null
                ]);

            }else{

                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'message'=>'Level not updated, something went wrong',
                    'data'=> null
                ]);

            }            

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>504,
                'message'=>'Level Not Found',
                'data'=> null
            ]);

        }

    }

    public static function level(Array $data){

        $level = Levels::find($data['id']);

        if($level){

            return response()->json([
                'status'=>'success',
                'code'=>200,
                'message'=>'Level Found',
                'data'=> null
            ]);

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>404,
                'message'=>'Level Not Found',
                'data'=> null
            ]);

        }

    }

    public static function delete(Array $data){

        $level = Levels::find($data['id']);

        if($level){

            if($level->delete()){

                return response()->json([
                    'status'=>'success',
                    'code'=>200,
                    'message'=>'Level Deleted',
                    'data'=> $level
                ]);

            }else{

                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'message'=>'Something went wrong, level was not deleted',
                    'data'=> $level
                ]);

            }

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>404,
                'message'=>'Level Not Found',
                'data'=> null
            ]);

        }
    }

}
