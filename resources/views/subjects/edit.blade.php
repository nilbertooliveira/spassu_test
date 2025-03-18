@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Authors') }}</div>
                    <div class="card-body">
                        <form action="{{ route('subjects.update', $subject['id']  ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('subjects.form')
                            <button type="submit" class="btn btn-primary m-3">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
