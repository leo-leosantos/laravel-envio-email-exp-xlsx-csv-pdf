<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
//use Mail;
use App\Mail\NovaTarefaMail;

class TarefaController extends Controller
{

    // public function __construct()
    // {
    //$this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;

        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);

        return view('tarefa.index', ['tarefas' => $tarefas]);

        //  if (Auth::Check()) {
        //     $id = auth()->user()->id;
        //     $nome = Auth::user()->name;
        //     $email = Auth::user()->email;

        //      return " Id $id | Nome: $nome | Email: $email";
        //   } else {
        //      return 'Voce nao esta logado';
        //   }
        /*
        if (auth()->check()) {
            $id = auth()->user()->id;
            $nome = auth()->user()->name;
            $email = auth()->user()->email;

            return " Id $id | Nome: $nome | Email: $email";
        } else {
            return 'Voce nao esta logado';
        }
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'tarefa' => 'required|max:200',
            'data_limite_conclusao' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'tarefa.max' => 'O campo deve ser preenchido com no maximo 200 caracteres'
        ];

        $dados  = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = auth()->user()->id;

        $request->validate($regras, $feedback);

        $tarefa =  Tarefa::create($dados);
        $destinatario = auth::user()->email;

        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa', $tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id  = auth()->user()->id;
        $tarefa->user_id;
        if ($tarefa->user_id == $user_id) {
            return view('tarefa.edit', ['tarefa' => $tarefa]);
        }

        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $regras = [
            'tarefa' => 'required|max:200',
            'data_limite_conclusao' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'tarefa.max' => 'O campo deve ser preenchido com no maximo 200 caracteres'
        ];

        $dados  = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = auth()->user()->id;

        $request->validate($regras, $feedback);

        $user_id  = auth()->user()->id;
        $tarefa->user_id;
        if (!$tarefa->user_id == $user_id) {
            return view('acesso-negado');
        }
        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        dd($tarefa);
    }
}
