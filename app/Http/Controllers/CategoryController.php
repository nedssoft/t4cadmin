<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
 
use Session;
 
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
    public function __construct(){ 
        //$this->middleware('auth');
    }
    
    
    public function index()
    {
        //10 items/page
        $itemsPerPage = 15;
        $cat = Category::orderBy('created_at', 'desc')->paginate($itemsPerPage);
        
        return view('category.index', array('category' => $cat, 'title' => 'Categories'));
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
                                'imgUrl' => 'required'
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
     * @param  int  $cid
     * @return \Illuminate\Http\Response
     */
    
    public function show($cid)
    {
        //nothing needed here for now
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
