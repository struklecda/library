@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <h1>Library</h1>
        </div>
        <div class="py-4 text-justify row">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Veniam facilis non nemo minima quidem aperiam asperiores tempora perferendis.
                Quis perspiciatis doloremque iste mollitia eaque quia voluptas, numquam ullam est facere.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Veniam facilis non nemo minima quidem aperiam asperiores tempora perferendis.
                Quis perspiciatis doloremque iste mollitia eaque quia voluptas, numquam ullam est facere.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Veniam facilis non nemo minima quidem aperiam asperiores tempora perferendis.
                Quis perspiciatis doloremque iste mollitia eaque quia voluptas, numquam ullam est facere.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Veniam facilis non nemo minima quidem aperiam asperiores tempora perferendis.
                Quis perspiciatis doloremque iste mollitia eaque quia voluptas, numquam ullam est facere.
            </p>
        </div>


        <div class="row text-center justify-content-center py-4 ">
            <h2>Livres les mieux notés</h2>
        </div>

        @if (!$books->isEmpty())
        <div class="row py-4">
        @foreach ($books as $book)
                    <div class="col-sm-12 col-md-6 col-lg-4 py-4">
                        <div class="card" style="width: 18rem;">
                        <img src="/storage/cover/{{ $book->cover }}" class="card-img-top" alt="{{ $book->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ Str::limit($book->description, 200) }}</p>
                                <p>Note: {{ round($book->Rating, 2) }} / 5</p>
                            <a href="{{ route('book', $book->id) }}" class="btn btn-primary">Détails</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
            <div class="text-center">
               <p>There aren't any rated books.</p>
            </div>
            @endif
@endsection
