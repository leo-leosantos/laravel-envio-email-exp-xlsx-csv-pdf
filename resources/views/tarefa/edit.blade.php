@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Tarefa</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Tarefa</label>
                                <input type="text" class="form-control" name="tarefa" value="{{ $tarefa->tarefa }}">
                                @error('tarefa')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror



                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data Limite Conclusao</label>
                                <input type="date" class="form-control" name="data_limite_conclusao"
                                    value="{{ $tarefa->data_limite_conclusao }}">
                                @error('data_limite_conclusao')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <button type="submit" class="btn btn-danger">Atualizar</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
