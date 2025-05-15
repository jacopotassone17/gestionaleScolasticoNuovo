@extends('layouts.app')

@section('title', 'Nuovo Docente')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Aggiungi Nuovo Docente</h2>

    <form method="POST" action="{{ route('docenti.store') }}">
        @csrf

        <div class="mb-4">
            <label for="nome" class="block font-semibold mb-1">Nome</label>
            <input type="text" id="nome" name="nome" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label for="cognome" class="block font-semibold mb-1">Cognome</label>
            <input type="text" id="cognome" name="cognome" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label for="materia" class="block font-semibold mb-1">Materia</label>
            <input type="text" id="materia" name="materia" class="border p-2 w-full rounded" required>
        </div>

        <div class="mb-4">
            <label for="seconda_materia" class="block font-semibold mb-1">Seconda materia (facoltativa)</label>
            <input type="text" id="seconda_materia" name="seconda_materia" class="border p-2 w-full rounded">
        </div>

        <div class="mb-4">
            <label for="id_user" class="block font-semibold mb-1">Utente associato</label>
            <select id="id_user" name="id_user" class="border p-2 w-full rounded" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Salva
            </button>
        </div>
    </form>

    <a href="{{ route('docenti.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">← Torna alla lista docenti</a>
@endsection
