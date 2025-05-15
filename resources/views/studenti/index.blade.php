@extends('layouts.app')

@section('title', 'Elenco Studenti')

@section('content')
    <div class="container">
        <h2 class="text-2xl font-bold mb-4">Elenco Studenti</h2>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('studenti.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">Nuovo Studente</a>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Nome</th>
                        <th class="border border-gray-300 px-4 py-2">Cognome</th>
                        <th class="border border-gray-300 px-4 py-2">Classe</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $student->nome }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $student->cognome }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $student->id_classe }}</td> <!-- Mostra la classe -->
                        <td class="border border-gray-300 px-4 py-2">{{ $student->user->email ?? 'N/A' }}</td> <!-- Email se esiste -->
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('studenti.show', $student->id_studente) }}" class="text-green-600 hover:underline mr-2">Visualizza</a>
                            <a href="{{ route('studenti.edit', $student->id_studente) }}" class="text-blue-600 hover:underline mr-2">Modifica</a>
                            <form method="POST" action="{{ route('studenti.destroy', $student->id_studente) }}" class="inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo studente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
