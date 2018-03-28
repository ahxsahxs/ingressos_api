<?php

namespace App\Http\Controllers;

use App\Lote;
use Illuminate\Http\Request;
use Validator;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotes = Lote::all();
        return response()->json($lotes);
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
            'quantidade' => 'required|numeric',
            'ordem' => 'required|numeric',
            'status' => 'required|boolean',
            'valor' => 'required|numeric',
            'ambiente_id' => 'required|exists:ambientes',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $lote = new Lote();
        $lote->fill($data);
        $lote->save();

        return response()->json($lote, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $lote = Lote::find($id);
        if(!$lote){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($lote);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        
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
        $lote = Lote::find($id);
        $data = $request->all();

        if(!$lote) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $lote->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to update this record'
        //     ], 401);
        // }

        // if(array_key_exists('email', $data) && $data['email'] == $lote->email) {
        //     unset($data['email']);
        // }

        $validator = Validator::make($data, [
            'nome' => 'required|size:100',
            'quantidade' => 'required|numeric',
            'ordem' => 'required|numeric',
            'status' => 'required|boolean',
            'valor' => 'required|numeric',
            'ambiente_id' => 'required|exists:ambientes',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $lote->fill($data);
        $lote->save();

        return response()->json($lote);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $lote = Lote::find($id);

        if(!$lote) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $lote->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to delete this record'
        //     ], 401);
        // }

        $lote->delete();
    }
}
