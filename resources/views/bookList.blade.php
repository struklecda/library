@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <h2>Liste des livres</h2>
</div>

<div class="row justify-content-start">
    <p>Trier par
        <select id="sortedBy" onchange="sort()">
            <option value="title" selected>Titre</option>
            <option value="author">Auteur</option>
            <option value="published_date">Date de parution</option>
            <option value="created_at">Date d'ajout</option>
    </select>
</p>
</div>
<span id="test"></span>
<div class="row">
    <div class="col-3 text-center">
        Titre
    </div>
    <div class="col-3 text-center">
        Auteur
    </div>
    <div class="col-2 text-center">
        Date de parution
    </div>
    <div class="col-2 text-center">
        Date d'ajout
    </div>
</div>


@foreach ($books as $book)

    <div class="row border stylish-color-dark text-white">
        <div class="col-3 align-self-center text-center">
            {{ $book->title }}
        </div>
        <div class="col-3 align-self-center text-center">
            {{ $book->author }}
        </div>
        <div class="col-2 align-self-center text-center">
            {{ \Carbon\Carbon::parse($book->published_date)->format('d/m/Y') }} <!-- Change le format de la date -->
        </div>
        <div class="col-2 align-self-center text-center">
            {{ \Carbon\Carbon::parse($book->created_at)->format('d/m/Y') }}
        </div>
        <div class="col-2 align-self-center text-center">
            <a href="{{ route('book', $book->id) }}" class="btn btn-primary">Détails</a>
        </div>
    </div>

@endforeach

<script type="text/javascript">
    function sort()
    {
        var sort = document.getElementById("sortedBy").value;
        document.getElementById("test").innerHTML = sort;
    }
</script>


@endsection
