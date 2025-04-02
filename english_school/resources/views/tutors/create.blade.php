@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <div class="form-container">

            <form action="/tutors/store" method="POST">
                @csrf
                <div class="form-title-container">
                    <h1>Cadastro de Tutores</h1>
                </div>
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome do Tutor" required>
                </div>
                <div class="form-group">
                    <label for="identification">CPF:</label>
                    <input type="text" name="identification" class="form-control" maxlength="11" placeholder="000.000.000-00" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email do tutor" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefone/Celular:</label>
                    <input type="text" name="phone" class="form-control" maxlength="11" placeholder="Telefone/Celular do tutor" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Cadastrar">
                <a href="/tutors" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
@endsection