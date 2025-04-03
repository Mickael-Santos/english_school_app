
@extends('layouts.main')

@section('title', 'Registrar')

@section('content')

    <div class="primary-container">
        <div class="form-container">
            <form method="POST" action="/login/auth">
                @csrf
                <div class="form-title-container">
                    <h1>Login</h1>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Digite um email válido" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Digite uma nova senha" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Login">
            </form>
        </div>
    </div>
    

@endsection