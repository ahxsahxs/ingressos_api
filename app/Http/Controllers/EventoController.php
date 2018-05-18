<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;

class EventoController extends Controller
{
    private $usuarioLogado = null;

    public function __construct() {
        // $this->middleware('jwt.auth', ['except' => ['show']]);
        $this->middleware(\App\Http\Middleware\Cors::class);

        $this->usuarioLogado = \Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!$this->usuarioLogado) {
        //     return response()->json([
        //         'message' => 'Você precisa estar logado para ver seus eventos'
        //     ], 401);
        // }

        // $eventos = Evento::where('usuario_inclusao_id', $this->usuarioLogado->id);
        $eventos = Evento::all();
        return response()->json($eventos);
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
        $data = $request->except(['img_topo', 'img_anuncio']);
        $booleans = ['ativo', 'passaporte', 'destaque', 'exibir_valor'];

        foreach($booleans as $var) {
            if(isset($data[$var])) {
                if($data[$var] == 'true') $data[$var] = true;
                else if($data[$var] == 'false') $data[$var] = false;
            }
        }
        $validator = Validator::make($data, [
            'nome' => 'required|max:100',
            'cidade' => 'required|max:100',
            'estado' => 'required|max:25',
            'pais' => 'required|max:50',
            'usuario_responsavel_id' => 'required|exists:usuario,id',
            'usuario_inclusao_id' => 'required|exists:usuario,id',
            'passaporte' => 'required|boolean',
            'destaque' => 'required|boolean',
            'ativo' => 'required|boolean',
            'descricao' => 'required|max:1000',
            'exibir_valor' => 'required',
            'data' => 'required|date',
            'coordenadas' => 'required',
            'endereco' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        if($request->hasFile('img_topo')) {
            $path = $request->file('img_topo')->store('public/eventos');
            $path = str_replace('/public', '', $path);
            $data['img_topo'] = $path;
        }
        if($request->hasFile('img_anuncio')) {
            $path = $request->file('img_anuncio')->store('public/eventos');
            $path = str_replace('/public', '', $path);
            $data['img_anuncio'] = $path;
        }

        $evento = new Evento();
        $evento->fill($data);
        $evento->save();

        return response()->json($evento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $evento = Evento::find($id);
        if(!$evento){
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }
        return response()->json($evento);
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
        $evento = Evento::find($id);
        $data = $request->all();

        $booleans = ['ativo', 'passaporte', 'destaque'];
        foreach($booleans as $var) {
            if(isset($data[$var])) {
                if($data[$var] == 'true') $data[$var] = true;
                else if($data[$var] == 'false') $data[$var] = false;
            }
        }


        if(!$evento) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $evento->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to update this record'
        //     ], 401);
        // }

        // if(array_key_exists('email', $data) && $data['email'] == $evento->email) {
        //     unset($data['email']);
        // }

        $validator = Validator::make($data, [
            'nome' => 'required|max:100',
            'cidade' => 'required|max:100',
            'estado' => 'required|max:25',
            'pais' => 'required|max:50',
            'usuario_responsavel_id' => 'required|exists:usuario',
            'usuario_inclusao_id' => 'required|exists:usuario',
            'passaporte' => 'required|boolean',
            'destaque' => 'required|boolean',
            'ativo' => 'required|boolean',
            'img_topo' => 'required',
            'img_anuncio' => 'required',
            'img_rodape' => 'nullable',
            'descricao' => 'required|max:350',
            'exibir_valor' => 'required',
            'data' => 'required|date',
            'coordenadas' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $evento->fill($data);
        $evento->save();

        return response()->json($evento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $evento = Evento::find($id);

        if(!$evento) {
            return response()->json([
                'message' => 'Record not Found'
            ], 404);
        }

        // if(\Auth::user()->id != $evento->id) {
        //     return response()->json([
        //         'message' => 'You haven\'t permission to delete this record'
        //     ], 401);
        // }

        $evento->delete();
    }

    public function destaques(int $n) {
        $eventos = Evento::where('ativo', 1)
            ->orderBy('data')
            ->take($n)
            ->get();

        return response()->json([
            'destaques' => $eventos
        ]);
    }
}
