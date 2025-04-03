@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="primary-container">
        <h1>Informações da Turma</h1>
        <div class="info-container">
            <div class="details-container">
                <h4>Detalhes:</h4>

                <div class="details-info">
                    <div class="detail-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                          <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                          <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                        </svg>   
                        <p>Título: {{$studentClass->title}}</p>
                    </div>
                    <div class="detail-item">
                        <p>Descrição: {{$studentClass->description}}</p>
                    </div>
                    <div class="detail-item">
                        <p>Data de Início: {{date('d/m/Y', strtotime($studentClass->start_date))}}</p>
                    </div>
                    <div class="detail-item">
                        <p>Data de Término: {{date('d/m/Y', strtotime($studentClass->end_date))}}</p>
                    </div>
                    <div class="detail-item">
                        <p>Cadastrado em: {{date('d/m/Y', strtotime($studentClass->created_at))}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection