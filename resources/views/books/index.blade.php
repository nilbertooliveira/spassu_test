@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Books') }}</div>
                    <div class="card-body overflow-y-auto" style="max-height: 720px;">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">
                                Cadastrar Novo Livro
                            </a>
                        </div>

                        <table class="table table-striped table-hover table-bordered align-middle table-sm">
                            <thead>
                            <th class="">Cod</th>
                            <th class="">Titulo</th>
                            <th class="">Editora</th>
                            <th class="">Edição</th>
                            <th class="">Ano Publicação</th>
                            <th class="">Valor</th>
                            <th class="">Ações</th>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td class="">{{ $book['id'] }}</td>
                                    <td class="">{{ $book['title'] }}</td>
                                    <td class="">{{ $book['publisher'] }}</td>
                                    <td class="">{{ $book['edition'] }}</td>
                                    <td class="">{{ $book['yearPublication'] }}</td>
                                    <td class="">{{ $book['price'] }}</td>
                                    <td class="">
                                        <button class="btn btn-sm btn-primary me-1"
                                                onclick="handleModalDetails(this)"
                                                data-subjects="{{ json_encode($book['subjects']) }}"
                                                data-authors="{{ json_encode($book['authors']) }}">
                                            View
                                        </button>
                                        <button class="btn btn-sm btn-secondary"
                                                onclick="window.location.href='{{ route('books.edit', $book['id']) }}'">
                                            Edit
                                        </button>
                                        <form action="{{ route('books.destroy', $book['id']) }}" method="POST"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete(this)">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('books.modal-details')


@section('scripts')
    <script type="module">
        $(function () {
            window.handleModalDetails = function handleModalDetails(data) {
                const subjects = JSON.parse(data.getAttribute('data-subjects'));
                const authors = JSON.parse(data.getAttribute('data-authors'));

                const subjectsTable = $('#subjectsTable');
                const authorsTable = $('#authorsTable');

                subjectsTable.find('tbody').empty();
                authorsTable.find('tbody').empty();

                subjects.forEach((subject) => {
                    subjectsTable.find('tbody').append(`
                    <tr>
                        <td>${subject['id']}</td>
                        <td>${subject['description']}</td>
                    </tr>
                `);
                });

                authors.forEach((author) => {
                    authorsTable.find('tbody').append(`
                    <tr>
                        <td>${author['id']}</td>
                        <td>${author['name']}</td>
                    </tr>
                `);
                });
                $('#simpleModal').modal('show');
            };
        });
        window.confirmDelete = async function confirmDelete(button) {
            await Swal.fire({
                title: 'Você tem certeza?',
                text: "Essa ação não poderá ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar o formulário do botão clicado
                    button.closest('form').submit();
                }
            });
        }
    </script>
@endsection

