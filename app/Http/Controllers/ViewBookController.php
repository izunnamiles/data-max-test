<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ApiBook;
use Illuminate\Cache\RedisTaggedCache;

class ViewBookController extends Controller
{
    public function displayBooks()
    {
        $books = ApiBook::all();
        return view('book.index', compact('books'));  
    }

    public function home()
    {
        $apibooks = ApiBook::count();
        if($apibooks < 1){
           try{
                $response = Http::get('https://www.anapioficeandfire.com/api/books?page=1&pageSize=10');
                $body = json_decode($response,true);
                $arr = [
                    'iron_and_fire' => $body
                ];
                
                foreach($arr['iron_and_fire'] as $data){      
                    ApiBook::FirstOrCreate([
                        'name' => $data['name'],
                        'isbn'=> $data['isbn'],
                        'authors'=> $data['authors'][0],
                        'country'=> $data['country'],
                        'number_of_pages'=> $data['numberOfPages'],
                        'publisher' => $data['publisher'],
                        'release_date' => $data['released'],
                    ]);
                }
                return  redirect()->route('books-view');
            }catch(\Exception $e){
                redirect()->route('books-view')->with('error', $e->getMessage());
            }
        }else{
            return  redirect()->route('books-view');
        }
    }
    public function editBook($id)
    {
        $book = ApiBook::find($id);
        return view('book.edit', compact('book'));  
    }

    public function updateBook(Request $request ,$id){
        //dd($request->all());
        try{
            $this->validate( $request,[
                'book_name' => array(
                    'required',
                    
                ),
                'isbn' => 'required',
                'authors'=> 'required',
                'country'=> 'required',
                'number_of_pages'=> 'required',
                'publisher'=> 'required',
                'release_date'=> 'required',
            ]);
        }catch(\Exception $e){
            return redirect()->back('error',$e->getMessage())->withInput();
        }
        

        $time = strtotime($request->release_date);
        $tmz = date('Y-m-d H:i:s',$time);

        $newrecord = [
            'name' => $request->book_name,
            'isbn' => $request->isbn,
            'authors' => $request->authors,
            'country' => $request->country,
            'number_of_pages' => $request->number_of_pages,
            'publisher' => $request->publisher,
            'release_date' => $tmz,
        ];
        
        $book = ApiBook::find($id);
        $book->update($newrecord);

        return redirect()->route('books-view')->with('success','Record was updated successfully');
    }

    public function destroy($id)
    {
        $book = ApiBook::find($id);
        $book->delete();

        return redirect()->route('books-view')->with('success','Record was successfully deleted');
    }
}
