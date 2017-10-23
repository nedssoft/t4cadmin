<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Levels;
use App\Category;
use App\Questions;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


      $questions = Questions::all();

      foreach ($questions as $question) {

        
        $categories[] = Category::find($question->category_id);
        $levels[] =   Levels::find($question->level_id);
          
      }
        if(empty($questions) || empty($categories) || empty($levels))
        {
            return response()->json([
             'status'=>'error',
             'code'=>'404',
             'message'=>'Resource Not Found',
             'data'=>null
            ]);
        }

      return response()->json( ['status'=>'success',
         'code'=>200,
        'data'=>['questions'=>$questions, 
        'categories'=>$categories,'levels' =>$levels]]);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::all();
        $levels = Levels::all();

        return view('question.add-question', compact('categories', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'level_id'=>'required', 
            'category_id'=>'required', 
            'question'=>'required',
            'option_1'=>'required',
            'option_2'=>'required',
            'option_3'=>'required',
            'option_4'=>'required',
            'answer'=>'required'
        ]);

        $question = Questions::create($request->all());
        if ($question->save()){
            return response()->json(['status'=>'success', 'code'=>201, 
                'message'=>'question added successfully']);
        }

        else{
            return response()->json(['status'=>'failed', 'code'=>207, 'message'=>'unknown error'

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $q = Questions::findOrFail($id);
        $q->load('categories', 'levels');
        dd($q);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
