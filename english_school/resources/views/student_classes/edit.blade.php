@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/student_classes/update/{{$studentClass->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-title-container">
                    <h1>Editando: {{$studentClass->title}}</h1>
                </div>
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" name="title" class="form-control" placeholder="Título da Turma" value="{{$studentClass->title}}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" class="form-control" placeholder="Descrição da Turma" required>{{$studentClass->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="tutor_id">Tutor:</label>
                    <select name="tutor_id" class="form-control" required>
                        <option value="" disabled>Selecione o Tutor</option>
                        @foreach($tutors as $tutor)
                            <option value="{{ $tutor->id }}" {{ $selectedTutor && $selectedTutor->id == $tutor->id ? 'selected' : '' }}>
                                {{ $tutor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_date">Data de Início:</label>
                    <input type="date" name="start_date" class="form-control" value="{{$studentClass->start_date}}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Data de Término:</label>
                    <input type="date" name="end_date" class="form-control" value="{{$studentClass->end_date}}" required>
                </div>

                <div class="form-buttons-container">
                    <input type="submit" class="btn btn-primary" value="Editar">
                    <a href="/student_classes" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection