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


      
      /**

      *this part is to be used for returnig json response only 
      $questions = Questions::where('status', 2)->get();
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
       */

        /**
        * this part is to used if the response is to be rendered in the view

        */
        $questions = Questions::all();
        
        $categories = Category::all();
        $levels =    Levels::all();

        return view('question.index-question', 
            compact('questions','categories', 'levels' ));
  
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
        $this->validate($request, rules());

        $question = Questions::create($request->all());
        /**
        *this part is to be used if only json reponsee is required

        if ($question->save()){
            return response()->json(['status'=>'success', 'code'=>201, 
                'message'=>'question added successfully']);
        }

        else{
            return response()->json(['status'=>'failed', 'code'=>207, 'message'=>'unknown error'

            ]);
        }
        */

        /**
        *this part is to be used if the response is to be rendered to the view
        */
        if ($question->save())
        {
           $message = 'Question created successfully';
            return view('question.index-question', compact('message'));
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
        $q = Questions::find($id);
        
       if (is_null($q)){

        return response()->json(['status'=>'Failed', 'data'=>null], 404);
       }
       return response()->json($q, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        //  
       $q = Questions::find($id);
       $categories = Category::all();
       $levels = Levels::all();

       return view('question.edit-question', compact('q', 'categories', 'levels'));

=======
        //       $category = Category::findOrFail($cid);
        $quest = Questions::findOrFail($id)
        return view('question.edit-question', array('quest' => $quest, 
            'title' => 'Edit Question' 

        ));
>>>>>>> 46dd852c751e3fd5f6e23228cccab692f35b89b7
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
       
        $this->validate($request, $this->rules());

        $question = Questions::find($id)->update($request->all());

        /**
        *  This is o be used if the response is to be returned to the view
        */
        return redirect()->back()->with(['data'=>'Question updated!']);



         /**
        *  This is o be used if the response is to be returned as json
        
           if ($question)
           {
                return response()->json(['status'=>$question, 'code'=>'204');
           }
               
          
           else{
              return response()->json(['status'=>'error', 'code'=>206, 'message'=>'unkown error']);
           }

           */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         Questions::find($id)->delete();

         return redirect()->back()->with(['message'=>'Question deleted successfully']);
        /**
        *this part is used when the response is to be returned in json
        return response()->json(['status'=>'success', 'code'=>203, 'data'=>'Question deleted']);
        */
    }

    public function rules()
    {
        return  [
            'level_id'=>'required', 
            'category_id'=>'required', 
            'question'=>'required',
            'option_1'=>'required',
            'option_2'=>'required',
            'option_3'=>'required',
            'option_4'=>'required',
            'answer'=>'required'
        ];
    }

    public function approveQuestion($id)
    {
        $q = Questions::find($id);

        $status = (int) $q->status;

        if ($status < 2){

            $status += 1;
        }
        else{
            return redirect()->back()->with(['status'=>'Question already approved by two admins']);
        }
        
        $updated = $q->update(['status'=>$status]);

        if($updated){

            return redirect()->back()->with(['status'=>'Question approved']);
        }

    }
}
