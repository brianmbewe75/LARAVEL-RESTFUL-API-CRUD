<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
 

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        if($students->count() > 0){

            return response()->json([
                    'status' => 200,
                     'students' => $students
                ], 200);
        }
        else{
            return response()->json(
          
                [
                    'status' => 404,
                'message' => 'No records found'
                ], 404);
        }
   
    }


    //Input 
public function store(Request $request)
{
    $validator =Validator::make($request->all(), [
        'name' => 'required|string|max:191',
        'course' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'phone' => 'required|digits:10',

    ]);

    if($validator->fails()){
        return response()->json(
            [
                'status' => 422,
                'errors' => $validator ->messages()
            ], 422
        );
    }
    else{
        $student = Student::create(
            [
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,

            ]
            );
            if($student){
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Student Created Successfully'
                    ],200);
            }else{
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'Something went wrong'
                    ],500);
            }
    }

}


//Getting a student with a particular ID
public function show($id){
    $student = Student::find($id);
    if($student){

        return response()->json(
            [
                'status' => 200,
                'student'  => $student
            ],200);

    }else{
        return response()->json(
            [
                'status' => 404,
                'message' => 'Student record not found'
            ],404);
    }
}

//editing a row for a specific student 
public function edit($id){
    $student = Student::find($id);
    if($student){

        return response()->json(
            [
                'status' => 200,
                'student'  => $student
            ],200);

    }else{
        return response()->json(
            [
                'status' => 404,
                'message' => 'Student record not found'
            ],404);
    }
}


public function update(Request $request, int $id)
{
    $validator =Validator::make($request->all(), [
        'name' => 'required|string|max:191',
        'course' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'phone' => 'required|digits:10',

    ]);

    if($validator->fails()){
        return response()->json(
            [
                'status' => 422,
                'errors' => $validator ->messages()
            ], 422
        );
    }
    else{
        $student = Student::find($id);
       
            if($student){
                $student = Student::create(
                    [
                        'name' => $request->name,
                        'course' => $request->course,
                        'email' => $request->email,
                        'phone' => $request->phone,
        
                    ]
                    );

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Student Updated Successfully'
                    ],200);
            }else{
                return response()->json(
                    [
                        'status' => 404,
                        'message' => 'Record not Updated'
                    ],404);
            }
    }
}




public function destroy($id)
{
     $student = Student::find($id);
     if($student){
        $student -> delete();
        return response()->json(
            [
                'status' => 200,
                'message' => 'Student Has Been Deleted'
            ],200);

     }else{
        return response()->json(
            [
                'status' => 404,
                'message' => 'Record not Deleted'
            ],404);
     }
       
        
}




}


