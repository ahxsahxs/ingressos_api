<?php

namespace App\Http\Controllers;

use App\Ingresso;
use Illuminate\Http\Request;
use Validator;

class IngressoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingressos = Ingresso::all();
        return response()->json($ingressos);
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
            'sexo' => 'required|string|size:1',
            'pedido_id' => 'required|exists:pedidos',
            'lote_id' => 'required|exists:lotes',
            'codigo_leitura' => 'required|string|size:350',
            'leitor_id' => 'required|exists:usuario',
            'status' => 'required|string|size:1',
            'valor' => 'required|numeric',
            'data_leitura' => 'required|date'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $ingresso = new Lote();
        $ingresso->fill($data);
        $ingresso->save();

        return response()->json($ingresso, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $ingresso = Ingresso::find($id);
        if(!$ingresso){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($ingresso);
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
        $ingresso = Ingresso::find($id);
        $data = $request->all();

        if(!$ingresso) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $ingresso->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to update this record'
        //     ], 401);
        // }

        // if(array_key_exists('email', $data) && $data['email'] == $ingresso->email) {
        //     unset($data['email']);
        // }

        $validator = Validator::make($data, [
            'sexo' => 'required|string|size:1',
            'pedido_id' => 'required|exists:pedidos',
            'lote_id' => 'required|exists:lotes',
            'codigo_leitura' => 'required|string|size:350',
            'leitor_id' => 'required|exists:usuario',
            'status' => 'required|string|size:1',
            'valor' => 'required|numeric',
            'data_leitura' => 'required|date'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $ingresso->fill($data);
        $ingresso->save();

        return response()->json($ingresso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $ingresso = Ingresso::find($id);

        if(!$ingresso) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $ingresso->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to delete this record'
        //     ], 401);
        // }

        $ingresso->delete();
    }
}
