@extends('layouts.main')

@section('title', 'Registrar')

@section('content')

    <div class="primary-container">
        <div class="form-container">
            <form method="POST" action="/schools/register/store/{{$user->id}}">
                @csrf
                <div class="form-title-container">
                    <h1>Criar Escola</h1>
                </div>

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome da escola" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Digite um email válido" required>
                </div>
            
                <div class="form-group">
                    <label for="identification">CNPJ:</label>
                    <input type="text" id="identification" name="identification" maxlength="14" class="form-control" placeholder="00.000.000/0000-00" required>
                </div>
               
                <input type="submit" class="btn btn-primary" value="Confirmar">
            </form>
        </div>
    </div>
    

@endsection