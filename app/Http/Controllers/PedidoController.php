<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;
use Validator;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos);
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
            'valor_bruto' => 'required|numeric',
            'valor_final' => 'required|numeric',
            'desconto' => 'required|numeric',
            'taxa_mp' => 'required|numeric',
            'data_aprovacao' => 'required|date',
            'usuario_id' => 'required|exists:usuario',
            'pdv_id' => 'nullable|exists:pdv',
            'status' => 'required|boolean',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $pedido = new Lote();
        $pedido->fill($data);
        $pedido->save();

        return response()->json($pedido, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pedido = Pedido::find($id);
        if(!$pedido){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($pedido);
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
        $pedido = Pedido::find($id);
        $data = $request->all();

        if(!$pedido) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $pedido->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to update this record'
        //     ], 401);
        // }

        // if(array_key_exists('email', $data) && $data['email'] == $pedido->email) {
        //     unset($data['email']);
        // }

        $validator = Validator::make($data, [
            'valor_bruto' => 'required|numeric',
            'valor_final' => 'required|numeric',
            'desconto' => 'required|numeric',
            'taxa_mp' => 'required|numeric',
            'data_aprovacao' => 'required|date',
            'usuario_id' => 'required|exists:usuario',
            'pdv_id' => 'nullable|exists:pdv',
            'status' => 'required|boolean',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $pedido->fill($data);
        $pedido->save();

        return response()->json($pedido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $pedido = Pedido::find($id);

        if(!$pedido) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $pedido->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to delete this record'
        //     ], 401);
        // }

        $pedido->delete();
    }
}
