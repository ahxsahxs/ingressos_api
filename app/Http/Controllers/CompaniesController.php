<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Validator;
use Hash;

class CompaniesController extends Controller
{
    function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store']]);
    }

    function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|size:100',
            'email' => 'required|email|unique:companies',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $company = new Company();
        $company->fill($data);
        $password = $request->only(['password'])['password'];
        $company->password = Hash::make($password);
        $company->save();

        return response()->json($company, 201);
    }

    function show($id)
    {
        $company = Company::find($id);
        if(!$company){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($company);
    }

    function update(Request $request, $id)
    {
        $company = Company::find($id);
        $data = $request->all();

        if(!$company) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        if(\Auth::user()->id != $company->id) {
            return response()->json([
                'message' => 'You haven\'t permission to update this record'
            ], 401);
        }

        if(array_key_exists('email', $data) && $data['email'] == $company->email) {
            unset($data['email']);
        }

        $validator = Validator::make($data, [
            'name' => 'size:100',
            'email' => 'email|unique:companies',
            'password' => 'min:6'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        if(array_key_exists('password', $data)) {
            $data['password'] = Hash::make($data['password']);
        }

        $company->fill($data);
        $company->save();

        return response()->json($company);
    }

    function destroy($id)
    {
        $company = Company::find($id);

        if(!$company) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        if(\Auth::user()->id != $company->id) {
            return response()->json([
                'message' => 'You haven\'t permission to delete this record'
            ], 401);
        }

        $company->delete();
    }
}
