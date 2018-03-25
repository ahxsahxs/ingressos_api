<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Usuario::all();
        return response()->json($users);
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
            'nome' => 'required|max:100',
            'email' => 'required|email|unique:companies',
            'senha' => 'required|min:6'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $usuario = new Usuario();
        $usuario->fill($data);
        $senha = $request->only(['senha'])['senha'];
        $usuario->senha = Hash::make($senha);
        $usuario->save();

        return response()->json($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);
        if(!$usuario){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        $data = $request->all();

        if(!$usuario) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        if(\Auth::user()->id != $usuario->id) {
            return response()->json([
                'message' => 'You haven\'t permission to update this record'
            ], 401);
        }

        if(array_key_exists('email', $data) && $data['email'] == $usuario->email) {
            unset($data['email']);
        }

        $validator = Validator::make($data, [
            'nome' => 'max:100',
            'email' => 'email|unique:companies',
            'senha' => 'min:6'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        if(array_key_exists('senha', $data)) {
            $data['senha'] = Hash::make($data['senha']);
        }

        $usuario->fill($data);
        $usuario->save();

        return response()->json($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        if(\Auth::user()->id != $usuario->id) {
            return response()->json([
                'message' => 'You haven\'t permission to delete this record'
            ], 401);
        }

        $usuario->delete();
    }
}
