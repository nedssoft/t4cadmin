<?php

namespace App\Api\v1;

use Illuminate\Http\Request;
 
use App\Category;

use Reponse;


class ApiCategory 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */


    public function index(){
        //returns all categories

        $category = Category::all();

        if($category && !empty($category)){

            return response()->json([
                'status'=>'success',
                'code'=>200,
                'message'=>'All category fetched',
                'data'=> $category
            ]);

        }else{

            return response()->json([
                'status'=>'error',
                'code'=>404,
                'message'=>'No Category Found',
                'data'=> $category
            ]);

        }

    }

    /**
     * Store a newly created resource in storage..
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->validate($request, array(
                        'name' => 'required',
                        'description' => 'required',
                        'imgUrl' => 'required'
                    )
                );

        $name = $request['name'];
        $description = $request['description'];
        $imgUrl = $request['name'];

        
        $input = Category::create([
            'name' => $name,
            'description' => $description,
            'imgUrl' => $imgUrl,
        ]);
        
        Category::create($input);

        if($input){
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' => 'Category was created',
                'data' => $input
            ]);
        }else{
            return response()->json([
                'status' => 'errir',
                'code' => 504,
                'message' => 'Something went wrong, category was not created',
                'data' => inpull
            ]);

        }
        
    }
    /*

    Show a specified category



    */

    public function show($id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' => 'Category Found',
                'data' =>$category
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        if($category){
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' =>  'Category updated',
                'data' => null
            ]);
        }else{
            return response()->json9([
                'status' =>'error',
                'code' => 500,
                'message' => 'Category not updated, Something went wrong',
                'data' => null
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
 
        if($category->delete()){
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' =>  'Category deleted',
                'data' => $category
            ]);

        }else{
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Category was not deleted, Something went wrong',
                'data' => null
            ]);
        }
    }

}
