@extends('layouts.dashboard')
@section('title','products edit')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}">products</a></li>
                        <li class="breadcrumb-item active">products edit</li>
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
                            <form action="{{ route('dashboard.products.update',$product->id) }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                {{--                        @include('dashboard.products._form')--}}

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"
                                               placeholder="Enter Name" name="name"
                                               value="{{$product->name}}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label>Parent Name</label>
                                        <select name="category_id" class="custom-select">
                                            <option value=""  {{$product->category_id == null ? 'selected': ''}}
                                            >Parent product</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}"
                                                    {{$product->category_id == $category->id ? 'selected': ''}}
                                                >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description"
                                                  class="form-control"
                                                  placeholder="description">
                                                   {{$product->description}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <input type="file" class="form-control"
                                               name="image">
                                        <img src="{{ asset('images/products/'.$product->image)}}"
                                             style="width: 75px; height: 75px">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control"
                                               placeholder="Enter price" name="price"
                                               value="{{$product->price}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label>Compare Price</label>
                                        <input type="text" class="form-control"
                                               placeholder="Enter Compare Price" name="compare_price"
                                               value="{{$product->compare_price}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label>Tags</label>
                                        <input type="text" class="form-control"
                                               placeholder="Enter Tags" name="tags"
                                               value="{{implode(',',$product->tags()->pluck('name')->toArray())}}"
                                        >
                                    </div>



                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" value="active"
                                                   type="radio" name="status"
                                                   @checked($product->status == 'active')>
                                            <label class="form-check-label">active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="draft"
                                                   type="radio" name="status"
                                                @checked($product->status == 'draft')>
                                            <label class="form-check-label">draft</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="archived"
                                                   type="radio" name="status"
                                                   @checked($product->status == 'archived')>
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
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

@endpush
@push('scripts')
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

    <script>
        var inputElm = document.querySelector('[name=tags]'),
            tagify = new Tagify (inputElm);
    </script>
@endpush
