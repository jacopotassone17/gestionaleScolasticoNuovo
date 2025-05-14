@extends('layouts.app')

@section('title', 'Modifica Classe')

@section('content')
    <h2 class="text-xl font-bold mb-4">Modifica classe</h2>

    <form method="POST" action="{{ route('classi.update', $classe->id_classe) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="id_classe" class="block font-semibold mb-1">ID Classe</label>
            <input type="text" id="id_classe" name="id_classe" value="{{ $classe->id_classe }}" class="border p-2 w-full" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Aggiorna</button>
    </form>
@endsection
