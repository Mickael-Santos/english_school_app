@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/custom_users/delete/{{$user->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-title-container">
                    <h1>Deletando: {{$user->name}}</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome do Usuário" value="{{$user->name}}" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email do usuário" value="{{$user->email}}" disabled>
                </div>
                <div class="form-buttons-container">
                    <input type="submit" class="btn btn-danger" value="Confirmar">
                    <a href="/custom_users" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection