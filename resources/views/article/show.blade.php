@extends('layouts.app')

@section("title") {{ $article->title }} @endsection

@section('head')

    <style>
        .description{
            white-space: pre-line;
        }
    </style>

    @stop

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route("article.index") }}">Articles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Article's Detail</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        {{ $article->title }}
                    </h4>
                    <div class="mt-2">
                        <small class="mr-2 font-weight-bolder">
                            <i class="fas fa-user text-primary"></i>
                            {{ $article->user->name }}
                        </small>
                        <small class="mr-2 font-weight-bolder">
                            <i class="feather-layers text-secondary"></i>
                            {{ $article->category->title }}
                        </small>
                        <small class="font-weight-bolder">
                            <i class="fas fa-calendar text-success"></i>
                            {{ $article->created_at->format("d M, Y") }}
                        </small>
                    </div>
                    <p class="text-black-50 description">
                        {{ $article->description }}
                    </p>
                    <hr>
                    <a href="{{ route("article.edit",$article->id) }}" title="Edit" class="text-decoration-none btn btn-outline-warning">
                        <i class="fas fa-pen fa-fw mr-2"></i>
                        Edit
                    </a>
                    <form action="{{ route("article.destroy",[$article->id,'page' => request()->page]) }}" class="d-inline-block text-decoration-none" method="post">
                        @csrf
                        @method("delete")
                        <button class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure? You want to delete \'{{ $article->title }}\'')">
                            <i class="fas fa-trash fa-fw"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
