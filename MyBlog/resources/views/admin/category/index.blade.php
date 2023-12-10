@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Category</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Index</span>
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
                            <h2>Categories</h2>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('categories.create') }}" class=" btn btn-success">Create Category</a>
                        <a href="{{ route('categories_show_deleted') }}" class=" btn btn-danger">Categories Deleted</a>
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
                <th width="280px">Action</th>

            </tr>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->content }}</td>
                <td>
                    <form action="{{ route('categories.destroy' , $category->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('categories.show' , $category->id ) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('categories.edit' , $category->id ) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
        {{ $categories->links() }}
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
