@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/student_classes/store" method="POST">
                @csrf
                <div class="form-title-container">
                    <h1>Cadastro de Turmas</h1>
                </div>
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" name="title" class="form-control" placeholder="Título da Turma" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" class="form-control" placeholder="Descrição da Turma" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tutor_id">Tutor:</label>
                    <select name="tutor_id" class="form-control" required>
                        <option value="" disabled selected>Selecione o Tutor</option>
                        @foreach($tutors as $tutor)
                            <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_date">Data de Início:</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Data de Término:</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Cadastrar">
                <a href="/student_classes" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
@endsection