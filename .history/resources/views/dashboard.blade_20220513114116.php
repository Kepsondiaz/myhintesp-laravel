<x-app-layout>
    <x-slot name="header">
    </x-slot>
    @foreach ($fichiers as $fichier)
        <a target="blank" href="{{ \Storage::url($fichier->url_fichier)}}">{{$fichier->nom_fichier}}</a>
        <i>Uploader le {{$fichier->created_at}}</i> <br>
    @endforeach
</x-app-layout>