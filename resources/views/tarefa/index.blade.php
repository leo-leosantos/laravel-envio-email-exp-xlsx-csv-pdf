@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                Tarefas
                            </div>
                            <div class="col-8">
                                <div class="float-right">
                                    <a href="{{ route('tarefa.create') }}" class=" mr-3 float-right btn btn-success">Nova Tarefa</a>
                                    <a href="{{ route('tarefa.exportacao',['extensao'=>'xlsx']) }}" class=" mr-3 float-right btn btn-info">XLSX</a>
                                    <a href="{{ route('tarefa.exportacao',['extensao'=>'csv']) }}" class=" mr-3 float-right btn btn-info">CVS</a>
                                    <a href="{{ route('tarefa.exportacao',['extensao'=>'pdf']) }}" class=" mr-3 float-right btn btn-info">PDF</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data Limite Conclusao</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarefas as $tarefa)
                                    <tr>
                                        <td scope="row">{{ $tarefa->id }}</td>
                                        <td>{{ $tarefa->tarefa }}</td>
                                        <td>{{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}</td>
                                        <td> <a href="{{ route('tarefa.edit', ['tarefa' => $tarefa->id]) }}"
                                                class="btn btn-warning">Editar</a></td>
                                        <td>
                                            <form id="form_{{ $tarefa->id }}" method="post"
                                                action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <a href="#"
                                                    onclick="document.getElementById('form_{{ $tarefa->id }}').submit()"
                                                    class="btn btn-danger">Excluir</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $tarefas->previousPageUrl() }}">Voltar</a></li>
                                @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }} "><a
                                            class="page-link"
                                            href="{{ $tarefas->url($i) }}">{{ $i }}</a></li>
                                @endfor
                                <li class="page-item"><a class="page-link"
                                        href="{{ $tarefas->nextPageUrl() }}">Avançar</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
