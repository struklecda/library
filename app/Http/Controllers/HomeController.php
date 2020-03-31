<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rating;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //Get all the info of the books and the average rating
        $top6Books = Book::join('ratings', 'rated_book', '=', 'books.id')
                            ->select(DB::raw('avg(rating) as Rating'), 'books.*')
                            ->groupBy('books.id')
                            ->orderBy('rating', 'desc')
                            ->get();

        return view('home', ['books' => $top6Books]);
    }

}


