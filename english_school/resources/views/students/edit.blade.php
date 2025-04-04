@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/students/update/{{$student->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-title-container">
                    <h1>Editando: {{$student->name}}</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome do Estudante" value="{{$student->name}}" required>
                </div>
                <div class="form-group">
                    <label for="identification">CPF:</label>
                    <input type="text" name="identification" class="form-control" maxlength="11" placeholder="000.000.000-00" value="{{$student->identification}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email do estudante" value="{{$student->email}}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefone/Celular:</label>
                    <input type="text" name="phone" class="form-control" maxlength="11" placeholder="Telefone/Celular do estudante" value="{{$student->phone}}" required>
                </div>

                <div class="form-buttons-container">
                    <input type="submit" class="btn btn-primary" value="Editar">
                    <a href="/students" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection