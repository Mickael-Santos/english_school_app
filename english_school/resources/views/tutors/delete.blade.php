@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/tutors/delete/{{$tutor->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-title-container">
                    <h1>Deletando: {{$tutor->name}}</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome do Tutor" value="{{$tutor->name}}" disabled>
                </div>
                <div class="form-group">
                    <label for="identification">CPF:</label>
                    <input type="text" name="identification" class="form-control" maxlength="11" placeholder="000.000.000-00" value="{{$tutor->identification}}" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email do tutor" value="{{$tutor->email}}" disabled>
                </div>
                <div class="form-group">
                    <label for="phone">Telefone/Celular:</label>
                    <input type="text" name="phone" class="form-control" maxlength="11" placeholder="Telefone/Celular do tutor" value="{{$tutor->phone}}" disabled>
                </div>
                
                <div class="form-buttons-container">
                    <input type="submit" class="btn btn-danger" value="Confirmar">
                    <a href="/tutors" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection