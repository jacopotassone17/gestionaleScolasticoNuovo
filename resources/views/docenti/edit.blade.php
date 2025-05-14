@extends('layouts.app')

@section('title', 'Modifica Docente')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Modifica Docente</h2>

    <form method="POST" action="{{ route('docenti.update', $docente) }}" class="space-y-4 max-w-xl">
        @csrf
        @method('PUT')

        <div>
            <label for="nome" class="block font-semibold mb-1">Nome</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $docente->nome) }}" class="border border-gray-300 p-2 w-full rounded" required>
        </div>

        <div>
            <label for="cognome" class="block font-semibold mb-1">Cognome</label>
            <input type="text" id="cognome" name="cognome" value="{{ old('cognome', $docente->cognome) }}" class="border border-gray-300 p-2 w-full rounded" required>
        </div>

        <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $docente->email) }}" class="border border-gray-300 p-2 w-full rounded" required>
        </div>

        <div>
            <label for="materia" class="block font-semibold mb-1">Materia</label>
            <input type="text" id="materia" name="materia" value="{{ old('materia', $docente->materia) }}" class="border border-gray-300 p-2 w-full rounded" required>
        </div>

        <div>
            <label for="seconda_materia" class="block font-semibold mb-1">Seconda Materia (opzionale)</label>
            <input type="text" id="seconda_materia" name="seconda_materia" value="{{ old('seconda_materia', $docente->seconda_materia) }}" class="border border-gray-300 p-2 w-full rounded">
        </div>

        <div>
            <label for="password" class="block font-semibold mb-1">Nuova Password (opzionale)</label>
            <input type="password" id="password" name="password" class="border border-gray-300 p-2 w-full rounded">
            <p class="text-sm text-gray-500 mt-1">Lascia vuoto se non vuoi cambiarla</p>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Salva Modifiche
            </button>
            <a href="{{ route('docenti.index') }}" class="text-gray-600 hover:underline self-center">Annulla</a>
        </div>
    </form>
    <a href="{{ route('docenti.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">← Torna alla lista docenti</a>
@endsection
