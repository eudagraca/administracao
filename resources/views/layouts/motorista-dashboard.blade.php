@extends('layouts.admin')
@section('link')
    Painel Geral
@endsection
@section('content-main')
    <div class="row">
        <div class="col-lg-3 col-6 uk-box-shadow-hover">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ count($tarefas) }}</h3>
                    <p class="uk-text-bold">Tarefas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <a href="{{ route('tarefa.index') }}" class="small-box-footer">
                    Mais detalhes <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
    </div>

@endsection
