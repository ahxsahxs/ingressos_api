<?php

namespace App\Http\Controllers;

use App\PedidoComplemento;
use Illuminate\Http\Request;
use Validator;

class PedidoComplementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidoComplementos = Lote::all();
        return response()->json($pedidoComplementos);
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
            'pedido_id' => 'required|exists:pedidos',
            'forma_pagamento' => 'required|string|size:100',
            'cartao_numero' => 'required|string|size:50',
            'cartao_vencimento' => 'required|date',
            'parcelas' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $pedidoComplemento = new Lote();
        $pedidoComplemento->fill($data);
        $pedidoComplemento->save();

        return response()->json($pedidoComplemento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pedidoComplemento = PedidoComplemento::find($id);
        if(!$pedidoComplemento){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($pedidoComplemento);
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
        $pedidoComplemento = PedidoComplemento::find($id);
        $data = $request->all();

        if(!$pedidoComplemento) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $pedidoComplemento->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to update this record'
        //     ], 401);
        // }

        // if(array_key_exists('email', $data) && $data['email'] == $pedidoComplemento->email) {
        //     unset($data['email']);
        // }

        $validator = Validator::make($data, [
            'pedido_id' => 'required|exists:pedidos',
            'forma_pagamento' => 'required|string|size:100',
            'cartao_numero' => 'required|string|size:50',
            'cartao_vencimento' => 'required|date',
            'parcelas' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $pedidoComplemento->fill($data);
        $pedidoComplemento->save();

        return response()->json($pedidoComplemento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $pedidoComplemento = PedidoComplemento::find($id);

        if(!$pedidoComplemento) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $pedidoComplemento->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to delete this record'
        //     ], 401);
        // }

        $pedidoComplemento->delete();
    }
}
