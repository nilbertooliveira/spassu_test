<?php

namespace Tests\Unit;

use App\Modules\Books\Application\DTOs\BookDto;
use App\Modules\Books\Application\UseCases\CreateBookUseCase;
use App\Modules\Books\Application\UseCases\DeleteBookUseCase;
use App\Modules\Books\Application\UseCases\ListBooksUseCase;
use App\Modules\Books\Application\UseCases\UpdateBookUseCase;
use Mockery;
use Tests\TestCase;

class BookUseCaseTest extends TestCase
{
    /**
     * Verifica se o caso de uso CreateBookUseCase é executado corretamente.
     *
     * @test
     */
    public function it_can_create_a_book()
    {
        $createBookUseCaseMock = Mockery::mock(CreateBookUseCase::class);

        $this->instance(CreateBookUseCase::class, $createBookUseCaseMock);

        $mockedBookDto = new BookDto(
            title: 'O Senhor dos Anéis',
            publisher: 'HarperCollins',
            edition: 1,
            yearPublication: 1954,
            price: 150.00,
            authors: [1, 2],
            subjects: [1, 3]
        );

        $createBookUseCaseMock->shouldReceive('execute')
            ->once()
            ->with(Mockery::on(function ($bookDto) use ($mockedBookDto) {
                return $bookDto == $mockedBookDto;
            }));

        $createBookUseCaseMock->execute($mockedBookDto);

        $this->assertTrue(true);
    }

    /**
     * Verifica se o caso de uso UpdateBookUseCase é executado corretamente.
     *
     * @test
     */
    public function it_can_update_a_book()
    {
        $updateBookUseCaseMock = Mockery::mock(UpdateBookUseCase::class);

        $this->instance(UpdateBookUseCase::class, $updateBookUseCaseMock);

        $mockedBookDto = new BookDto(
            title: 'Livro Atualizado',
            publisher: 'Editora Nova',
            edition: 2,
            yearPublication: 2000,
            price: 99.90,
            authors: [3],
            subjects: [4, 5],
            id: 1
        );

        $updateBookUseCaseMock->shouldReceive('execute')
            ->once()
            ->with(Mockery::on(function ($bookDto) use ($mockedBookDto) {
                return $bookDto == $mockedBookDto;
            }));

        $updateBookUseCaseMock->execute($mockedBookDto);

        $this->assertTrue(true);
    }

    /**
     * Verifica se o caso de uso DeleteBookUseCase é executado corretamente.
     *
     * @test
     */
    public function it_can_delete_a_book()
    {
        $deleteBookUseCaseMock = Mockery::mock(DeleteBookUseCase::class);

        $this->instance(DeleteBookUseCase::class, $deleteBookUseCaseMock);

        $bookId = 1;

        $deleteBookUseCaseMock->shouldReceive('execute')
            ->once()
            ->with($bookId);

        $deleteBookUseCaseMock->execute($bookId);

        $this->assertTrue(true);
    }

    /**
     * Verifica se o caso de uso ListBooksUseCase é executado corretamente.
     *
     * @test
     */
    public function it_can_list_books()
    {
        $listBooksUseCaseMock = Mockery::mock(ListBooksUseCase::class);

        $this->instance(ListBooksUseCase::class, $listBooksUseCaseMock);

        $mockedBooks = [
            new BookDto(
                title: 'Livro 1',
                publisher: 'Editora X',
                edition: 1,
                yearPublication: 2020,
                price: 50.00,
                authors: [1],
                subjects: [2]
            ),
            new BookDto(
                title: 'Livro 2',
                publisher: 'Editora Y',
                edition: 2,
                yearPublication: 2021,
                price: 75.00,
                authors: [3],
                subjects: [4]
            )
        ];

        $listBooksUseCaseMock->shouldReceive('execute')
            ->once()
            ->andReturn($mockedBooks);

        $books = $listBooksUseCaseMock->execute();

        $this->assertEquals($mockedBooks, $books);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
