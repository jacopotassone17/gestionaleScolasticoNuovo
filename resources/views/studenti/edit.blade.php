@extends('layouts.app')

@section('title', 'Modifica Studente')

@section('content')
    <h2 class="text-xl font-bold mb-4">Modifica studente</h2>

    <form method="POST" action="{{ route('studenti.update', $student->id_studente) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="block">Nome</label>
            <input type="text" name="nome" id="nome" class="border p-2 w-full" value="{{ $student->nome }}" required>
        </div>

        <div class="mb-4">
            <label for="cognome" class="block">Cognome</label>
            <input type="text" name="cognome" id="cognome" class="border p-2 w-full" value="{{ $student->cognome }}" required>
        </div>

        <div class="mb-4">
            <label for="classe" class="block">Classe</label>
            <select name="id_classe" id="id_classe" class="border p-2 w-full" required>
                <option value="">Seleziona Classe</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id_classe }}" {{ $classe->id_classe == $student->classe ? 'selected' : '' }}>
                        {{ $classe->nome }} {{ $classe->sezione }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="id_notifica" class="block">Notifica</label>
            <select name="id_notifica" id="id_notifica" class="border p-2 w-full">
                <option value="">Seleziona Notifica</option>
                @foreach ($notifications as $notifica)
                    <option value="{{ $notifica->id_notifica }}" {{ $notifica->id_notifica == $student->id_notifica ? 'selected' : '' }}>
                        {{ $notifica->contenuto }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Aggiorna</button>
    </form>
    <a href="{{ route('studenti.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">← Torna alla lista studenti</a>

@endsection
