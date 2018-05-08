<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Validator;
use Hash;

class UsuarioController extends Controller
{
    private $usuarioLogado = null;

    function __construct() {
        // Before implements API Auth
        // $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store', 'destroy', 'update']]);
        // After
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store']]);

        $this->usuarioLogado = \Auth::user();
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
            'email' => 'required|email|unique:usuario',
            'senha' => 'required|max:20|min:3',
            'cpf' => 'required|string|size:11'
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

        if(!$this->usuarioLogado || $this->usuarioLogado->id != $usuario->id) {
            return response()->json([
                'message' => 'You haven\'t permission to update this record'
            ], 401);
        }

        if(array_key_exists('email', $data) && $data['email'] == $usuario->email) {
            unset($data['email']);
        }

        $validator = Validator::make($data, [
            'nome' => 'min:3|max:100',
            'email' => 'email|unique:companies',
            'senha' => 'min:3'
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

        if(!$this->usuarioLogado || $this->usuarioLogado->id != $usuario->id) {
            $usuario->delete();
        } else {
            return response()->json([
                // 'message' => 'You haven\'t permission to delete this record'
                'message' => 'Você precisa estar logado em sua conta para removê-la'
            ], 401);
        }
    }
}
