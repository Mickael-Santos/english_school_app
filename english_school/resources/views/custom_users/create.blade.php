@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/custom_users/store" method="POST">
                @csrf
                <div class="form-title-container">
                    <h1>Cadastro de Usuários</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome do Usuário" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email do usuário" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" class="form-control" placeholder="Senha do usuário" required>
                </div>

                <div class="form-buttons-container">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                    <a href="/custom_users" class="btn btn-secondary">Voltar</a>
                </div>
                
            </form>
        </div>
    </div>
@endsection