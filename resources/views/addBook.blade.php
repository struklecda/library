@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div>
            <h2>Ajouter un livre</h2>
        </div>
    </div>

    <form action="/addBook" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="title">Titre</label>
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" name="title" id="title" placeholder="Titre">
                @error('title')
                    <p class="invalid-feedback">Non-valide</p>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label for="author">Auteur</label>
                <input type="text" class="form-control {{ $errors->has('author') ? 'is-invalid' : ''}}" name="author" id="author" placeholder="Nom et prénom de l'auteur">
                @error('author')
                    <p class="invalid-feedback">Non-valide</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="extrarct">Extrait</label>
                <input type="text" class="form-control {{ $errors->has('extract') ? 'is-invalid' : ''}}" name="extract" id="extract" placeholder="Extrait">
                @error('extract')
                    <p class="invalid-feedback">Non-valide</p>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label for="published">Date de publication</label>
                <input type="date" class="form-control {{ $errors->has('published') ? 'is-invalid' : ''}}" name="published" id="published" placeholder="Date de publication">
                @error('published')
                    <p class="invalid-feedback">Non-valide</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="description">Description</label>
                <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}" name="description" id="description" placeholder="Description">
                @error('description')
                    <p class="invalid-feedback">Non-valide</p>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label for="cover">Image de couverture</label>
                <input type="file" class="form-control-file {{ $errors->has('cover') ? 'is-invalid' : ''}}" name="cover" id="cover">
                @error('cover')
                    <p class="invalid-feedback">Non-valide</p>
                @enderror
            </div>
        </div>
        <div class="row justify-content-end">
            <button type="submit" class="btn btn-elegant">Ajouter</button>
        </div>
    </form>

@endsection
