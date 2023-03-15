<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $studend = Student::all();
        if ($studend->count() > 0) {
            return response()->json([
                'status' => 200,
                'student' => $studend,
                200
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found',
                404
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|max:191',
            'phone' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }
        $studend = Student::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        if ($studend) {
            return response()->json([
                'status' => 201,
                'message' => 'Student Add Successfully',
            ], 201);
        }
        return response()->json([
            'status' => 500,
            'message' => 'Something Wrong!',
        ], 500);
    }

    public function show($id)
    {
        $studend = Student::find($id);
        if ($studend) {
            return response()->json([
                'status' => 200,
                'message' => $studend,
            ], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No such studnt Found!',
        ], 404);
    }

    public function edit($id)
    {
        $studend = Student::find($id);
        if ($studend) {
            return response()->json([
                'status' => 200,
                'message' => $studend,
            ], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No such student Found!',
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|max:191',
            'phone' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }
        $studend = Student::find($id);
        if ($studend) {
            $studend->update([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Student Updated Successfully',
            ], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No Such Student found!',
        ], 404);
    }

    public function distroy(Request $request, $id)
    {
        $studend = Student::find($id);
        
    }
}
