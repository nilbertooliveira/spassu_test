@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Subjects') }}</div>
                    <div class="card-body overflow-y-auto" style="max-height: 720px;">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-sm">
                                Cadastrar Novo Subjects
                            </a>
                        </div>

                        <table class="table table-striped table-hover table-bordered align-middle  table-sm">
                            <thead>
                            <th class="">Cod</th>
                            <th class="">Nome</th>
                            <th class="">Ações</th>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td class="">{{ $subject['id'] }}</td>
                                    <td class="">{{ $subject['description'] }}</td>
                                    <td class="">
                                        <button class="btn btn-sm btn-secondary"
                                                onclick="window.location.href='{{ route('subjects.edit', $subject['id']) }}'">
                                            Edit
                                        </button>
                                        <form action="{{ route('subjects.destroy', $subject['id']) }}" method="POST"
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
                        {{-- Controles de paginação --}}
                        <div class="d-flex justify-content-center mt-3">
                            @if ($models->hasPages())
                                <ul class="pagination pagination-sm">
                                    {{-- Números das páginas --}}
                                    @foreach ($models->getUrlRange(1, $models->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $models->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
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
