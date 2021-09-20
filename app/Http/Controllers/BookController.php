<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $param = request()->name;
        $response = Http::get('https://www.anapioficeandfire.com/api/books/?name='.$param);
        $body = $response->json();
        if(isset($body[0])){
            $book = $body[0];
            return response([
                "status_code"=> 200 ,
                "status"=> 'success',
                "data" => [
                    "name"=> $book['name'],
                    "isbn"=> $book['isbn'],
                    "authors"=> [
                        $book['authors'][0],
                    ],
                    "numberOfPages" => $book['numberOfPages'],
                    "publisher" => $book['publisher'],
                    "country" => $book['country'],
                    "released" => $book['released'],

                ]

            ]);
        }else
        return response([
            "status_code"=> 200 ,
            "status"=> 'success',
            "data" => []
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'name' => array(
                'required'
            ),
            'isbn' => 'required',
            'authors'=> 'required',
            'country'=> 'required',
            'number_of_pages'=> 'required',
            'publisher'=> 'required',
            'release_date'=> 'required|date|date_format:Y-m-d',
            
        ]);

        if($validator->fails()){
            return sendError('Validation Error.', $validator->errors());
        }

        $time = strtotime($request->release_date);
        $tmz = date('Y-m-d H:i:s',$time);

        $book = new Book();
        $book->name = $request->name;
        $book->isbn = $request->isbn;
        $book->authors = $request->authors;
        $book->country = $request->country;
        $book->number_of_pages = $request->number_of_pages;
        $book->publisher = $request->publisher;
        $book->release_date = $tmz;
        $book->save();
        
        return response()->json([
            "status_code"=> 201 ,
            "status"=> 'success',
            "data" => [
                "name"=> $book->name,
                "isbn"=> $book->isbn,
                "authors"=> [
                    $book->authors,
                ],
                "number_of_pages" => $book->number_of_pages,
                "publisher" => $book->publisher,
                "country" => $book->country,
                "release_date" => $book->release_date,

            ]

        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $books = Book::all();
        $data = $book->count() ? BookResource::collection($books) : [];
        return response([
            "status_code"=> 200 ,
            "status"=> 'success',
            "data"=> $data
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, $id)
    {
        //
        $newdata = Book::find($id);
        $newdata->update($request->all());
        return response()->json([
            "status_code"=> 200 ,
            "status"=> 'success',
            "message"=>" $newdata->name book was updated successfully",
            "data" => [
                "name"=> $newdata->name,
                "isbn"=> $newdata->isbn,
                "authors"=> [
                    $newdata->authors,
                ],
                "number_of_pages" => $newdata->number_of_pages,
                "publisher" => $newdata->publisher,
                "country" => $newdata->country,
                "release_date" => $newdata->release_date,

            ]

           
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, $id)
    {
        $newdata = Book::find($id);
        $newdata->delete();
        return response()->json([
            "status_code"=> 204 ,
            "status"=> 'success',
            "message"=>" $newdata->name book was successfully deleted",
            "data"=>[],
           
        ], 204);
    }
    public function showBook($id)
    {
        $book = Book::find($id);
        return response()->json([
            "status_code"=> 200 ,
            "status"=> 'success',
            "data" => [
                "name"=> $book->name,
                "isbn"=> $book->isbn,
                "authors"=> [
                    $book->authors,
                ],
                "number_of_pages" => $book->number_of_pages,
                "publisher" => $book->publisher,
                "country" => $book->country,
                "release_date" => $book->release_date,

            ]

        ]);
    }
}
