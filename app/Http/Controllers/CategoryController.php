<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
 
use Session;
 
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //10 items/page
        $itemsPerPage = 10;
        $news = Category::orderBy('created_at', 'desc')->paginate($itemsPerPage);
        
        return view('category.index', array('category' => $news, 'title' => 'Categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('category.create', array('title' => 'Add A New category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                $this->validate($request, array(
                                'name' => 'required',
                                'description' => 'required',
                                'imgUrl' => '', //not sure of  myself here
                            )
                        );
        
        $input = $request->all();
        //dd($input); 
        
        Category::create($input);
        
        Session::flash('flash_message', 'Category added successfully!');
 
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        //nothing needed here for now
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', array('category' => $category, 'title' => 'Edit Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
 
        $this->validate($request, array(
                                'name' => 'required',
                                'description' => 'required',
                                'imgUrl' => '',
                            )
                        );
 
        $input = $request->all();
 
        $category->fill($input)->save();
 
        Session::flash('flash_message', 'Category updated successfully!');
 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = News::findOrFail($id);
 
        $category->delete();
 
        Session::flash('flash_message', 'Category has been deleted!');
 
        return redirect()->route('category.index');

    }
}
