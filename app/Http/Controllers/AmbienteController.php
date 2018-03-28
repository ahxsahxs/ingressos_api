<?php

namespace App\Http\Controllers;

use App\Ambiente;
use Illuminate\Http\Request;
use Validator;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambientes = Ambiente::all();
        return response()->json($ambientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nome' => 'required|size:100',
            'evento_id' => 'required|exists:evento',
            'grupo_ambiente_id' => 'required|exists:grupo_ambiente',
            'img_topo' => 'required|size:200',
            'img_rodape' => 'required|size:200',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $ambiente = new Ambiente();
        $ambiente->fill($data);
        $ambiente->save();

        return response()->json($ambiente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $ambiente = Ambiente::find($id);
        if(!$ambiente){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($ambiente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $ambiente = Ambiente::find($id);
        $data = $request->all();

        if(!$ambiente) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $ambiente->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to update this record'
        //     ], 401);
        // }

        // if(array_key_exists('email', $data) && $data['email'] == $ambiente->email) {
        //     unset($data['email']);
        // }

        $validator = Validator::make($data, [
            'nome' => 'required|size:100',
            'evento_id' => 'required|exists:evento',
            'grupo_ambiente_id' => 'required|exists:grupo_ambiente',
            'img_topo' => 'required|size:200',
            'img_rodape' => 'required|size:200',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $ambiente->fill($data);
        $ambiente->save();

        return response()->json($ambiente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $ambiente = Ambiente::find($id);

        if(!$ambiente) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $ambiente->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to delete this record'
        //     ], 401);
        // }

        $ambiente->delete();
    }
}
