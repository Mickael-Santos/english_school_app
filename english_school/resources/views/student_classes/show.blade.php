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

            <div class="tutor-classes-container">
                <h4>Alunos participantes:</h4>

                <div class="add-student-container">
                    <form action="/student_classes/addStudent/{{$studentClass->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                           <label for="student"> Adicionar alunos:</label>      
                           <select name="student_id" id="student" required>
                                <option value="" disabled selected>Selecione um aluno</option>
                                @foreach($studentsNotInClass as $studentOption)
                                    <option value="{{$studentOption->id}}">{{$studentOption->name}}</option>
                                @endforeach
                           </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                        </button>
                    </form>
                </div>
                
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentsInClass as $student)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <a href="/students/show/{{$student->id}}">{{$student->name}}</a>
                                    </td>
                                    <td class="actions-container">
                                        <form action="/student_classes/removeStudent/{{$studentClass->id}}/{{$student->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                    
                </div>
                
            </div>
        </div>
        
    </div>
@endsection