<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class JobsController extends Controller
{
    function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }

    function index()
    {
        $jobs = Job::with('company')->get();
        return response()->json($jobs);
    }

    function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|size:255',
            'description' => 'required',
            'local' => 'required',
            'remote' => 'in:yes,no',
            'type' => 'integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $job = new Job();
        $job->fill($data);
        $job->company_id = \Auth::user()->id;
        $job->save();

        return response()->json($job, 201);
    }

    function show($id)
    {
        $job = Job::find($id);
        
        if(!$job) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($job);
    }

    function update(Request $request, $id)
    {
        $data = $request->all();
    
        $validator = Validator::make($data, [
            'title' => 'size:255',
            'remote' => 'in:yes,no',
            'type' => 'integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }
        
        $job = Job::find($id);
        
        if(!$job) {
            return response()->json([
                'message' => 'Record not found'
            ], 404);
        }

        if(\Auth::user()->id != $job->company_id) {
            return response()->json([
                'message' => 'You haven\'t permission to update this record'
            ], 401);
        }

        $job->fill($data);
        $job->save();

        return response()->json($job);
    }

    function destroy($id)
    {
        $job = Job::find($id);

        if(!$job) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        if(\Auth::user()->id != $job->company_id) {
            return response()->json([
                'message' => 'You haven\'t permission to delete this record'
            ], 401);
        }

        $job->delete();
    }
}
