@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Setting</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update setting</h2>
        </div>
    </div>
    <!-- row closed -->
    </div>

    <!-- Container closed -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settingUpdate' , $setting->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Logo:</strong>
                    <div class="input-group mb-3">
                        <input type="file" name="logo" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                </div>
                <div class="form-group">
                    <strong>Fvicon:</strong>
                    <div class="input-group mb-3">
                        <input type="file" name="fvicon" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                </div>
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $setting->title }}" class="form-control"
                        placeholder="title">
                </div>

                <div class="form-group">
                    <strong>Content:</strong>
                    <input type="text" name="content" value="{{ $setting->content }}" class="form-control"
                        placeholder="content">
                </div>
                <div class="form-group">
                    <strong>Address:</strong>
                    <input type="text" name="address" value="{{ $setting->address }}" class="form-control"
                        placeholder="address">
                </div>
                <div class="form-group">
                    <strong>Phone:</strong>
                    <input type="text" name="phone" value="{{ $setting->phone }}" class="form-control"
                        placeholder="+**********">
                </div>
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $setting->email }}" class="form-control"
                        placeholder="email">
                </div>

                <div class="form-group">
                    <strong>Facebook:</strong>
                    <input type="text" name="facebook" value="{{ $setting->facebook }}" class="form-control"
                        placeholder="facebook">
                </div>

                <div class="form-group">
                    <strong>Instagram:</strong>
                    <input type="text" name="instagram" value="{{ $setting->instagram }}" class="form-control"
                        placeholder="instagram">
                </div>



            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
    </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
