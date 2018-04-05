<?php

namespace App\Http\Controllers;

use App\Pdv;
use Illuminate\Http\Request;
use Validator;

class PdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdvs = Pdv::all();
        return response()->json($pdvs);
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
            'data_entrega' => 'required|max:100',
            'serial' => 'required|max:100',
            'marca' => 'required|max:100',
            'modelo' => 'required|max:100',
            'taxa' => 'required|numeric',
            'tipo_pdv' => 'required',
            'usuario_id' => 'required|exists:usuario'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $pdv = new Lote();
        $pdv->fill($data);
        $pdv->save();

        return response()->json($pdv, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pdv = Lote::find($id);
        if(!$pdv){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($pdv);
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
        $ambiente = Pdv::find($id);
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
            'data_entrega' => 'required|max:100',
            'serial' => 'required|max:100',
            'marca' => 'required|max:100',
            'modelo' => 'required|max:100',
            'taxa' => 'required|numeric',
            'tipo_pdv' => 'required',
            'usuario_id' => 'required|exists:usuario'
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
        $ambiente = Pdv::find($id);

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
