@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">POST</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Show</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Category</h2>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('categories.index') }}" class=" btn btn-primary">Back</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $category->title }}
                <br>
                <strong>Content:</strong>
                {{ $category->content }}
                <br>
                <hr>
                @foreach ($posts as $post)
                    {{ $post->title }}
                    <br>

                    {{ $post->content }}
                    <br>

                    {{ $post->smallDesc }}
                    <br>

                    {{ $post->tag }}
                    <br>

                    {{ $post->image }}
                    <br>

                    <strong>Writer:</strong>
                    {{ $post->user->name }}
                    <br>
                    <hr>
                @endforeach

            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
