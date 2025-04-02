@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/tutors/update/{{$tutor->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-title-container">
                    <h1>Editando: {{$tutor->name}}</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome do Tutor" value="{{$tutor->name}}" required>
                </div>
                <div class="form-group">
                    <label for="identification">CPF:</label>
                    <input type="text" name="identification" class="form-control" maxlength="11" placeholder="000.000.000-00" value="{{$tutor->identification}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email do tutor" value="{{$tutor->email}}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefone/Celular:</label>
                    <input type="text" name="phone" class="form-control" maxlength="11" placeholder="Telefone/Celular do tutor" value="{{$tutor->phone}}" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Editar">
                <a href="/tutors" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
@endsection