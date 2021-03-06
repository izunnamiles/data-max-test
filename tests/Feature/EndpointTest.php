<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;
use Illuminate\Support\Str;

class EndpointTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $book;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->book = factory(Book::class)->create();

    }
    public function test_iron_and_fire_api_to_fetch_book_with_name()
    {
        $name="A Game of Thrones";
        $response = $this->json('get','/api/external-books?'.$name);
        $response->assertStatus(200);
        $response->assertJson(["status"=> 'success']);
        $response->assertJsonStructure([
            "status_code",
                "status",
                "data" => [
                ]
        ]);

    }

    public function test_for_inserting_new_book_in_db()
    {
        $str = Str::random(6);
        $array = array('MacMillian','Marvel','Bantam Books');
        $time = strtotime(now());
        $tmz = date('Y-m-d',$time);
        
        $books = [
            'name' => $this->faker->word,
            'isbn' => "ISBN-".$str,
            'authors' => $this->faker->name,
            'country' => $this->faker->country,
            'number_of_pages' => $this->faker->randomDigit,
            'publisher' => $this->faker->randomElement($array),
            'release_date' => $tmz,
        ];

        $response = $this->json('post','/api/v1/book', $books);
        $response->assertStatus(201);

    }

    public function test_for_returning_all_books_saved(){
        $response = $this->json('get','/api/v1/book');
        $response->assertStatus(200);
        $response->assertJson(["status"=> 'success']);
        $response->assertJsonStructure([
            "status_code",
            "status",
            "data" => []
        ]);
    }
    public function test_for_returning_one_books_record(){
        $response = $this->json('get','/api/v1/book/'.$this->book->id);
        $response->assertStatus(200);
        $response->assertJson(["status"=> 'success']);
        $response->assertJsonStructure([
            "status_code",
            "status",
            "data" => []
        ]);
    }
    public function test_for_updating_a_book_record_on_db()
    {
        $data = [
            'name'=>'A song of fire',
            'country'=>'England',
            'publisher'=>'MacMillian'
        ];
        $response = $this->json('patch','/api/v1/book/'.$this->book->id, $data);
        $response->assertStatus(200);
        $responseBody = $response->decodeResponseJson();
        $this->assertNotEmpty($responseBody['data']);

        $this->assertDatabaseHas('books', [
            'name'=>$data['name'],
           'country'=>$data['country'],
           'publisher'=>$data['publisher'],
        ]);
    }

    public function test_for_deleting_a_book_on_db()
    {
        $response = $this->json('delete','/api/v1/book/'.$this->book->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['deleted_at' => null, 'id' => $this->book->id]);
    }

    public function test_for_validation_failure_response()
    {
        $str = Str::random(6);
        $array = array('MacMillian','Marvel','Bantam Books');
        
        $books = [
            'name' => $this->faker->word,
            'isbn' => "ISBN-".$str,
            'authors' => $this->faker->name,
            'country' => $this->faker->country,
            'number_of_pages' => $this->faker->randomDigit,
            'publisher' => $this->faker->randomElement($array),
            'release_date' => now(), //incorrect data format
        ];

        $response = $this->json('post','/api/v1/book', $books);
        $response->assertStatus(400)->assertExactJson(["success"=> false,"message"=>"Validation Error.", "data"=>$response['data']]);
    }
}
