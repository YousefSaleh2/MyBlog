@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Empty</span>
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
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User </a>

        </div>
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
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Roles</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($users as $key => $user)
    <tr>
        <td>{{ $loop->index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->status }}</td>
        <td>
            @if(!empty($user->roles))
            @foreach($user->roles as $role)
            <label class="badge badge-success">{{ $role }}</label>
            @endforeach
            @endif
        </td>
        <td>

            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}


        </td>
    </tr>
    @endforeach
</table>


{!! $users->render() !!}

</div>
<!-- main-content closed -->
@endsection
@section('js')
@endsection
