<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'     => 'Harry Potter',
            'author'    => 'J.K. Rowling'
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }


    /** @test */
    public function a_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'  =>  '',
            'author' =>  'Fahad'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {

        $response = $this->post('/books', [
            'title'  =>  'Harrt Potter',
            'author' =>  ''
        ]);

        $response->assertSessionHasErrors('author');
    }
}
