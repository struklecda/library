@extends('layouts.app')

@section('content')

<div class="row py-4">
@foreach ($book as $value)

        <div class="col-6 text-center">
            <img style="width: 300px" src="/storage/cover/{{ $value->cover }}" class="card-img-top" alt="{{ $value->title }}">
            @if ($isRated)
                <p class="py-4"><strong>Note:</strong> {{ round($averageRating, 2) }} / 5</p>
            @else
                <p class="py-4">Livre pas encore noté</p>
            @endif

            @if (Auth::user())
                @if ($rated)
                    <strong>Votre note: {{ $userRating }}</strong> / 5
                @else
                    <form action="/book/{{ $value->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <strong>Votre note: </strong><input size="1" type="text" name="rating" id="rating" onkeypress="return isNumber(event)" maxlength="1"> / 5
                        <button type="submit" class="btn btn-elegant">Noter</button>
                    </form>
                @endif

            @else
                <p>Vous devez être connecté pour pouvoir noter le livre.</p>
            @endif


        </div>
        <div class="col-6">
            <p><strong>Titre:</strong> {{ $value->title }}</p>
            <p><strong>Auteur:</strong> {{ $value->author }}</p>
            <p><strong>Date de publication:</strong> {{ $value->published_date }}</p>
            <p><strong>Extrait:</strong> {{ $value->extract }}</p>
            <p><strong>Descritpion:</strong> {{ $value->description }}</p>
            <p><strong>Book added by:</strong> {{ $bookUsername }}</p>
        </div>

@endforeach
</div>

<script type="text/javascript">
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 49 || charCode > 53)) {
        return false;
    }
    return true;
}
</script>
@endsection

