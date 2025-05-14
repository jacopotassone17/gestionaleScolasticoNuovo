@extends('layouts.app')

@section('title', 'Dettaglio Studente')

@section('content')
    <h2 class="text-xl font-bold mb-4">Dati Studente</h2>

    <p><strong>Nome:</strong> {{ $student->nome }}</p>
    <p><strong>Cognome:</strong> {{ $student->cognome }}</p>
    <p><strong>Email:</strong> {{ $student->user->email }}</p>
    <p><strong>Classe:</strong> {{ $student->classe }}</p>

    <h3 class="text-lg font-semibold mt-6">Voti</h3>
    <ul>
        @foreach ($student->grades as $grade)
            <li>{{ $grade->materia}}: {{ $grade->peso }}</li>
        @endforeach
    </ul>
    <a href="{{ route('studenti.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">← Torna alla lista studenti</a>

@endsection
