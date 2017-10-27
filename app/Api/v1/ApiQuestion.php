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


      $data = array();
      /**

      *this part is to be used for returnig json response only 
      */
      $questions = Questions::where('status', 2)->get();

      foreach ($questions as $question) {

         
         $data['questions'][] =  $question;
         $data['category'][]   =  $question->category;
         $data['level'][]     =  $question->level;
       
         
      }

        if(empty($data) )
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
        'data'=>$data, 
        // 'categories'=>$categories,'levels'=>$levels,
        ]);
       

 
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
       */
        if ($question->save()){
            return response()->json([
                'status'=>'success',
                 'code'=>201, 
                'message'=>'question added successfully'
            ]);
        }

        else{
            return response()->json([
                'status'=>'error',
                 'code'=>207, 
                 'message'=>'Question not created, Something went wrong'

            ]);
        }
       

        /**
        *this part is to be used if the response is to be rendered to the view
               
                if ($question->save())
        {
           $message = 'Question created successfully';
            return view('question.index-question', compact('message'));
        }
        */
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
        
       if (is_null($q) || ( (int)$q->status !==2 )){

        return response()->json([
            'status'=>'Failed', 
             'code'=>404,
             'data'=>null, 
             'message'=>'Resource Not Found']);
       }
       return response()->json([
        'status'=>'success', 
        'code'=>200,
        'data'=>$q, 
    ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         
       $q = Questions::find($id);
       $categories = Category::all();
       $levels = Levels::all();

       return view('question.edit-question', compact('q', 'categories', 'levels'));


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

        if($question = Questions::find($id)->update($request->all())){
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message', => 'Category updated successfully',
                'data' => $question
            ])
        }else{
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Question not found',
                'data' => null
            ])
        }
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if ($delete = Questions::find($id)->delete()){
        return response()->json([
        'status'=>'success', 
        'code'=>203, 
        'data'=>'Question deleted'
        ]);
        
        }else{
            return response()->json([
                'status' => 'error',
                'code' => 4004,
                'message' => 'Something went wrong, the question was not deleted',
            ])
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
            // return redirect()->back()->with([
            //     'status'=>'Question already approved by two admins'
            // ]);
            return response()->json([
                'status'=>'success',
                'code'=>203,
                'message'=>'Question has been  approved by two admins!'
       
            ]);
        }
        
        $updated = $q->update(['status'=>$status]);

        if($updated){

            // return redirect()->back()->with([
            //     'status'=>'Question approved'
            // ]);

            return response()->json([
                'status'=>'success',
                'code'=>203,
                'message'=>'Question approved',

            ]);
        }

    }
}
