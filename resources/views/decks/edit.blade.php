@extends('layouts.app')
@section('title', 'Modifier ' . $deck->name)

@section('content')

<div class="max-w-lg mx-auto">

    <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('decks.index') }}" class="hover:text-yellow-400 transition-colors">Mes Decks</a>
        <span>›</span>
        <a href="{{ route('decks.show', $deck) }}" class="hover:text-yellow-400 transition-colors">{{ $deck->name }}</a>
        <span>›</span>
        <span class="text-gray-500">Modifier</span>
    </nav>

    <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8">
        <h1 class="text-2xl font-display font-black text-white mb-6">Modifier le deck</h1>

        <form method="POST" action="{{ route('decks.update', $deck) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider mb-2">
                    Nom du deck *
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $deck->name) }}"
                       class="w-full bg-gray-800 border text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-400 transition-colors {{ $errors->has('name') ? 'border-red-600' : 'border-gray-700' }}">
                @error('name')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider mb-2">
                    Description
                </label>
                <textarea name="description"
                          rows="3"
                          class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-400 transition-colors resize-none">{{ old('description', $deck->description) }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-yellow-400 hover:bg-yellow-300 text-gray-900 py-3 rounded-xl font-black transition-all">
                    Sauvegarder
                </button>
                <a href="{{ route('decks.show', $deck) }}"
                   class="px-6 py-3 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-300 rounded-xl font-semibold text-sm flex items-center transition-all">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
