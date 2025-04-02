@extends('layouts.main')

@section('title', 'Home')

@section('content')

    <div class="primary-container">
        <h1>Turmas</h1>
        <div>
            <form action="/" method="GET">
                <div class="form-group manage-container" >
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar...">
                    
                    <button type="submit" class="btn btn-primary">Pesquisar</button>

                    <a href="" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </a>
                </div>
            </form> 
        </div>
    </div>
    <div class="secondary-container">
        <h4>Pesquisando por:</h4>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection