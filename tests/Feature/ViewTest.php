<?php

namespace Tests\Feature;

use App\ApiBook;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

class ViewTest extends TestCase
{  
    use DatabaseMigrations, RefreshDatabase, WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */

    private $apibook;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->apibook = factory(ApiBook::class)->create();

    }
    public function test_if_it_redirects()
    {
        $response = $this->get('/');
        $response->assertRedirect('/view-books');
    }
    public function test_update_record()
    {
        $str = Str::random(6);
        $array = array('MacMillian','Marvel','Bantam Books');
        $arrayNum = array(230,400,500,600);
        $time = strtotime(now());
        $tmz = date('Y-m-d',$time);

        $data = [
            'book_name' => 'A song of fire',
            'isbn' => "ISBN-".$str,
            'authors' => $this->faker->name,
            'country' => $this->faker->country,
            'number_of_pages' => $arrayNum,
            'publisher' => $this->faker->randomElement($array),
            'release_date' => $tmz,
        ];
        
        $response = $this->patch('/edit-book/'.$this->apibook->id, $data);
        $response->assertRedirect('/view-books');

        $this->assertDatabaseHas('api_books',[
            'name'=>'A song of fire',

        ]);
    }

    public function test_delete_record(){
        $response = $this->delete('/delete-book/'.$this->apibook->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseMissing('api_books', ['deleted_at' => null, 'id' => $this->apibook->id]);
    }
}
