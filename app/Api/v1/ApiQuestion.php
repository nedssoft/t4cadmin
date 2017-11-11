<?php

namespace App\Api\v1;

use Illuminate\Http\Request;
use App\Levels;
use App\Category;
use App\Questions;

//Todo Cache API Requests for calls made by specific users
class ApiQuestion 
{
    /**
     * Get all questions
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = $this->questions()->get();

        if ($questions) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Questions retrieved successfully',
                'data' => $questions
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'code' => 500,
            'message' => 'Something went wrong, questions could not be retrieved',
            'data' => null
        ], 500);
    }

    /**
     * Get questions
     *
     * @return Collection
     */
    public function questions()
    {
        return Questions::with([
            'options', 
            'category',
            'level',
            'point'
        ]);       
    }

    /**
     * Get questions randomly
     *
     * @return \Illuminate\Http\Response
     */
    public function randomQuestions(Request $request)
    {
        $limit = $request->has('limit') ? intval($request->limit) : 'all';
        $questions = null;

        if ($limit === 'all' || $limit === 0) {
            $questions = $this->questions()->inRandomOrder()->get();
        } else {
            if ($limit !== 0) {
                $questions = $this->questions()->inRandomOrder()->take($limit)->get();
            }
        }

        if ($questions) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Questions retrieved successfully',
                'data' => $questions
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'code' => 500,
            'message' => 'Something went wrong, questions could not be retrieved',
            'data' => null
        ], 500);   
    }
}

