@extends('layouts.app')

@section("title") Category Manager @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Category Manager</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-layers"></i>
                        Category List
                    </h4>
                    <hr>
                    <form action="{{ route("category.store") }}" method="post" class="mb-3">
                        @csrf
                        <div class="form-inline">
                            <input type="text" name="title" placeholder="New Category" value="{{ old('title') }}" class="form-control-lg form-control mr-2 @error('title') is-invalid @enderror" required>
                            <button class="btn btn-primary btn-lg">Add Category</button>
                        </div>
                        @error("title")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @if(session('message'))
                            <p class="alert alert-success mt-3">
                                <i class="feather-check mr-2"></i>
                                {{ session('message') }}
                            </p>
                        @endif
                    </form>
                    @include("category.lists")
                </div>
            </div>
        </div>
    </div>
@endsection
