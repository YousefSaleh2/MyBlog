@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Post</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Deleted</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-lg-12">
                        <div class="pull-left">
                            <h2>Post Deleted</h2>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('posts.index') }}" class=" btn btn-primary">Back</a>
                    </div>
                </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Small Desc</th>
                <th>Tag</th>
                <th>Category</th>
                <th>Writer</th>
                <th>Image</th>
                <th width="280px">Action</th>

            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->smallDesc }}</td>
                <td>{{ $post->tag }}</td>
                <td>{{ $post->category->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->image }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('posts_restore',$post->id) }}">Restore</a>
                    <a class="btn btn-danger" href="{{ route('posts_force_deleted',$post->id) }}">Force Delete</a>
                </td>
            </tr>
            @endforeach
            </table>
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
