<?php

namespace App\Http\Controllers;

use App\GrupoAmbiente;
use Illuminate\Http\Request;
use Validator;

class GrupoAmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = GrupoAmbiente::all();
        return response()->json($grupos);
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
        
        $data = $request->all();
        $validator = Validator::make($data, [
            'nome' => 'required|size:100',
            'max_quant' => 'required|numeric',
            'usuario_id' => 'required|exists:usuario'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $ga = new GrupoAmbiente();
        $ga->fill($data);
        $ga->save();

        return response()->json($ga, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $ga = GrupoAmbiente::find($id);
        if(!$ga){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($ga);
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
        $ga = GrupoAmbiente::find($id);
        $data = $request->all();

        if(!$ga) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $ga->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to update this record'
        //     ], 401);
        // }

        // if(array_key_exists('email', $data) && $data['email'] == $ga->email) {
        //     unset($data['email']);
        // }

        $validator = Validator::make($data, [
            'nome' => 'required|size:100',
            'max_quant' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $ga->fill($data);
        $ga->save();

        return response()->json($ga);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $ga = GrupoAmbiente::find($id);

        if(!$ga) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $ga->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to delete this record'
        //     ], 401);
        // }

        $ga->delete();
    }
}
