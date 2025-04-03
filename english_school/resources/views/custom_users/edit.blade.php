@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/custom_users/update/{{$user->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-title-container">
                    <h1>Editando: {{$user->name}}</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome do Usuário" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email do usuário" value="{{$user->email}}" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Editar">
                <a href="/custom_users" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
@endsection