@extends('layouts.dashboard')
@section('title','categories create')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">categories</a></li>
                        <li class="breadcrumb-item active">categories create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <x-alert></x-alert>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{--                        @include('dashboard.categories._form')--}}

                                <div class="card-body">
                                    <div class="form-group">
                                        <label >Name</label>
                                        <input type="text" class="form-control"
                                               placeholder="Enter name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>Parent Name</label>
                                        <select name="parent_id" class="custom-select">
                                            <option value="" checked>Parent Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description"
                                                  class="form-control"
                                                  placeholder="description">
                                </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <input type="file" class="form-control"
                                               name="image">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" value="active" type="radio" name="status">
                                            <label class="form-check-label">active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="archived" type="radio" name="status">
                                            <label class="form-check-label">archived</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@push('styles')
<!-- styles -->
@endpush
@push('scripts')
    <!-- scripts -->
@endpush
