@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Books') }}</div>
                    <div class="card-body">
                        <form action="{{ route('books.update', $books['id']  ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('books.form')
                            <button type="submit" class="btn btn-primary m-3">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
