<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Rating;
use Auth;
use Illuminate\Http\Request;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::get();

        return view('bookList', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addBook');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'title' => 'required',
            'author' => 'required',
            'extract' => 'required',
            'published' => 'required',
            'description' => 'required',
            'cover' => ['required', 'image', 'max:1999'],
        ]);

        if($request->hasFile('cover')){
            //Get filename with extension
            $filenameWithExt = $request->file('cover')->getClientOriginalName();
            //Get just filename
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('cover')->storeAs('public/cover', $filenameToStore);
        }

        //Choose to which row you store your data
        $book = new Book();
        $book->title = request('title');
        $book->author = request('author');
        $book->extract = request('extract');
        $book->published_date = request('published');
        $book->description = request('description');
        $book->cover = $filenameToStore;
        $book->added_by = Auth::user()->id;

        //Stores data in database
        $book->save();

        return redirect('/bookList');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //Get id of the book and user that added the book
        $bookDetails = Book::find($book);
        foreach($bookDetails as $value){
            $userID = $value->added_by;
            $bookID = $value->id;
        }

        //Get the average rating of the book
        $ratingScore = Rating::where('rated_book', $bookID)->avg('rating');

        //Check if the book is rated
        if($ratingScore === null)
        {
            $isRated = false;
        }
        else
        {
            $isRated = true;
        }

        //Get the username of the person who added the book
        $bookUsername = User::where('id', $userID)->value('username');

        //Check if a user is logged
        if(Auth::user())
        {
            //Get id of user that rated the book
            $userId = Auth::user()->id;
        }
        else
        {
            $userId = null;
        }

        //Get all the ratings from the book
        $bookRaters = Rating::where('rated_book', $bookID)->where('rated_by', $userId)->value('rated_by');

        //Check if there is a record
        if($bookRaters === null)
        {
            $rated = false;
            $userRating = null;
        }
        else
        {
            $rated = true;

            //Get the rating the logged user put
            $userRating = Rating::where('rated_by', $userId)->where('rated_book', $bookID)->value('rating');
        }

        return view('show', [
            'book' => $bookDetails,
            'bookUsername' => $bookUsername,
            'rated' => $rated,
            'userRating' => $userRating,
            'averageRating' => $ratingScore,
            'isRated' => $isRated,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
