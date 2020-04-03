@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <h2>Liste des livres</h2>
</div>

<div class="row justify-content-start">
    <p>Trier par
        <select id="sortedBy" onchange="sortBy()">
            <option value=0 selected>Titre</option>
            <option value=1>Auteur</option>
            <option value=2>Date de parution</option>
            <option value=3>Date d'ajout</option>
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

<div id="bookList">
</div>

<script type="text/javascript">

    //Sorting books
    function sorting(a, b)
    {
        var selectId = document.getElementById("sortedBy");
        var sortValue = selectId.options[selectId.selectedIndex].value;
        var index = parseInt(sortValue);

        if (a[index] === b[index]) {
            return 0;
        }
        else {
            return (a[index] < b[index]) ? -1 : 1;
        }
    }

    //Get all the books
    var books = [
    @foreach ($books as $book)
    [   "{{ $book->title }}",
        "{{ $book->author }}",
        "{{ \Carbon\Carbon::parse($book->published_date)->format('Y/m/d') }}",
        "{{ \Carbon\Carbon::parse($book->created_at)->format('Y/m/d') }}",
        "{{ route('book', $book->id) }}" ],
    @endforeach
    ];



    var sorted = books.sort(sorting);

    console.log(typeof sorted[0][2]);


    for(i = 0; i < sorted.length; i++)
    {
        var divRow = document.createElement("div");
        divRow.className = "row border stylish-color-dark text-white"
        divRow.id = i;
        document.getElementById("bookList").appendChild(divRow);

        for(j = 0; j < sorted[i].length; j++)
        {
            if(j < 2)
            {
                var divCol = document.createElement("div");
                divCol.className = "col-3 align-self-center text-center"
                divCol.id = j;
                document.getElementById(i).appendChild(divCol);
                divCol.innerHTML = sorted[i][j];
            }
            else if(j < 4)
            {
                var divCol = document.createElement("div");
                divCol.className = "col-2 align-self-center text-center"
                divCol.id = j;
                document.getElementById(i).appendChild(divCol);
                divCol.innerHTML = sorted[i][j];
            }
            else
            {
                var divCol = document.createElement("div");
                divCol.className = "col-2 align-self-center text-center"
                divCol.id = j;
                divCol.id = sorted[i][j];
                document.getElementById(i).appendChild(divCol);

                var btnLink = document.createElement("a");
                btnLink.href = sorted[i][j];
                btnLink.id = j;
                btnLink.className = "btn btn-primary";
                document.getElementById(sorted[i][j]).appendChild(btnLink);
                btnLink.innerHTML = "Détails";
            }
        }
    }


    function sortBy()
    {
        //Get all the books
        var books = [
        @foreach ($books as $book)
        [   "{{ $book->title }}",
            "{{ $book->author }}",
            "{{ \Carbon\Carbon::parse($book->published_date)->format('Y/m/d') }}",
            "{{ \Carbon\Carbon::parse($book->created_at)->format('Y/m/d') }}",
            "{{ route('book', $book->id) }}" ],
        @endforeach
        ];


        var sortedBooks = books.sort(sorting);


        for(i = 0; i < sortedBooks.length; i++)
        {
            //Continue sort
            document.getElementById(i);
            for(j = 0; j < sortedBooks[i].length; j++)
            {
                document.getElementById(i).innerHTML = sortedBooks[i][j];


                    var divCol = document.createElement("div");
                    divCol.className = "col-3 align-self-center text-center"
                    document.getElementById(i).appendChild(divCol);
                    divCol.innerHTML = sorted[i][j];

                    var divCol = document.createElement("div");
                    divCol.className = "col-2 align-self-center text-center"
                    document.getElementById(i).appendChild(divCol);
                    divCol.innerHTML = sorted[i][j];

                    var divCol = document.createElement("div");
                    divCol.className = "col-2 align-self-center text-center"
                    divCol.id = sorted[i][j];
                    document.getElementById(i).appendChild(divCol);

                    var btnLink = document.createElement("a");
                    btnLink.href = sorted[i][j];
                    btnLink.className = "btn btn-primary";
                    document.getElementById(sorted[i][j]).appendChild(btnLink);
                    btnLink.innerHTML = "Détails";

            }
        }

        console.log(values);


    }


</script>


@endsection
