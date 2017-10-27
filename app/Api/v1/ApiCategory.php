<?php

namespace App\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
 
use App\Category;

use App\User;

class CategoryController extends Controller
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

        if($category){

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    
    public function show($cid)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function edit($cid)
    {
        $category = Category::findOrFail($cid);
        return view('category.edit', array('category' => $category, 'title' => 'Edit Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cid)
    {
        $category = Category::findOrFail($cid);
 
        $this->validate($request, array(
                                'name' => 'required',
                                'description' => 'required',
                                'imgUrl' => 'required',
                            )
                        );
 
        $input = $request->all();
 
        $category->fill($input)->save();
 
        Session::flash('flash_message', 'Category updated successfully!');
 
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    public function destroy($cid)
    {
        $category = Category::findOrFail($cid);
 
        $category->delete();
 
        Session::flash('flash_message', 'Category has been deleted!');
 
        return redirect()->route('category.index');

    }
}
