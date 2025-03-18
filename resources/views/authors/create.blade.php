@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Authors') }}</div>
                    <div class="card-body">
                        <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('authors.form')
                            <button type="submit" class="btn btn-primary m-3">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
