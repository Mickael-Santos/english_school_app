@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/student_classes/delete/{{$studentClass->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-title-container">
                    <h1>Deletando: {{$studentClass->title}}</h1>
                </div>
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" name="title" class="form-control" placeholder="Título da Turma" value="{{$studentClass->title}}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" class="form-control" placeholder="Descrição da Turma" disabled>{{$studentClass->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="start_date">Data de Início:</label>
                    <input type="date" name="start_date" class="form-control" value="{{$studentClass->start_date}}" disabled>
                </div>
                <div class="form-group">
                    <label for="end_date">Data de Término:</label>
                    <input type="date" name="end_date" class="form-control" value="{{$studentClass->end_date}}" disabled>
                </div>

                <div class="form-buttons-container">
                    <input type="submit" class="btn btn-danger" value="Confirmar">
                    <a href="/student_classes" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection