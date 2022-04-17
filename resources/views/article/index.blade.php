@extends('layouts.app')

@section("title") Articles List @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Articles List</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">
                        <i class="feather-list"></i>
                        Articles List
                    </h4>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <a href="{{ route("article.create") }}" class="btn btn-outline-primary btn-lg mr-2">
                                <i class="feather-plus"></i>
                                Create Article
                            </a>
                            @isset(request()->search)
                                <a href="{{ route("article.index") }}" class="btn btn-outline-dark btn-lg mr-2">
                                    <i class="feather-list"></i>
                                    All Articles
                                </a>
                                <span class="h5">Search By : <b>" {{ request()->search }} "</b></span>
                            @endisset
                        </div>
                        <form action="{{ route("article.index") }}" method="get" class="mb-3">
                            <div class="form-inline">
                                <input type="text" name="search" placeholder="Search Article" value="{{ request()->search }}" class="form-control-lg form-control mr-2" required>
                                <button class="btn btn-primary btn-lg">
                                    <i class="feather-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    @if(session('message'))
                        <p class="alert alert-success mt-3">
                            <i class="feather-check mr-2"></i>
                            {{ session('message') }}
                        </p>
                    @endif
                    <table class="table table-hover border-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Articles</th>
                            <th>Tag</th>
                            <th>Owner</th>
                            <th>Control</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>
                                    <span class="font-weight-bolder">
                                        {{ Str::words($article->title,5) }}
                                    </span>
                                    <br>
                                    <small class="text-black-50">
                                        {{ Str::words($article->description,10) }}
                                    </small>
                                </td>
                                <td class="text-nowrap">
                                    {{ $article->category->title }}
                                </td>
                                <td class="text-nowrap">
                                    {{ $article->user->name }}
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route("article.show",[$article->id,'page' => request()->page]) }}" title="Detail" class="text-decoration-none">
                                        <i class="fas fa-eye text-info fa-fw mr-2"></i>
                                    </a>
                                    <a href="{{ route("article.edit",$article->id) }}" title="Edit" class="text-decoration-none">
                                        <i class="fas fa-pen text-warning fa-fw mr-2"></i>
                                    </a>
                                    <form action="{{ route("article.destroy",[$article->id,'page' => request()->page]) }}" class="d-inline-block text-decoration-none" method="post">
                                        @csrf
                                        @method("delete")
                                        <button style="padding: 0;background: none;border: none;outline: none;" title="Delete" onclick="return confirm('Are you sure? You want to delete \'{{ $article->title }}\'')">
                                            <i class="fas fa-trash text-danger fa-fw"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $article->created_at->format("d M, Y") }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There's no article with our records</td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        {{ $articles->appends(request()->all())->links() }}
                        <p class="mb-0 font-weight-bolder h5">Total Articles : {{ $articles->total() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
