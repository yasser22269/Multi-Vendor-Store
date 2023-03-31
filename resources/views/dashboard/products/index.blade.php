@extends('layouts.dashboard')
@section('title','products index')

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
                        <li class="breadcrumb-item active">products index</li>
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
            <div class="mb-5">
{{--                @if(Auth::user()->can('products.create'))--}}
{{--                @endif--}}
{{--                <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a>--}}
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('dashboard.products.create') }}"
                                   class="btn btn-sm btn-outline-primary mr-2">Create</a>
                                <a href="{{ route('dashboard.products.trash') }}"
                                   class="btn btn-sm btn-outline-dark mr-2">Trash</a>
                            </h3>

                            <div class="card-tools">
                                <form action="{{\Illuminate\Support\Facades\URL::current()}}"
                                      method="get">
                                    <div class="input-group input-group-sm" style="width: 400px;">
                                        <input type="text" name="name"
                                               class="form-control float-right"
                                               placeholder="Search"
                                               value="{{request('name')}}"
                                        >
                                        <select type="text" name="status"
                                               class="form-control float-right">
                                            <option value="">All</option>
                                            <option value="active"
                                                @selected(request('status') == 'active')>active</option>
                                            <option value="archived"
                                                @selected(request('status') == 'archived')>archived</option>
                                            <option value="draft"
                                                @selected(request('status') == 'draft')>draft</option>

                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Store</th>
                                    <th>Category</th>
                                    <th>status</th>
                                    <th ></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>
{{--                                        <img src="{{ asset('images/products/'.$product->image)}}"--}}
{{--                                             style="width: 75px; height: 75px">--}}
                                        <img src="{{ $product->image}}"
                                         style="width: 75px; height: 75px">
                                    </td>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->store->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->status}}</td>
                                    <td class="d-flex ">
                                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                           class="btn  btn-outline-success mr-2">Edit</a>
                                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            <!-- Form Method Spoofing -->
                                            <input type="hidden" name="_method" value="delete">
                                            @method('delete')
                                            <button type="submit" class="btn  btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No products defined.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{$products->withQueryString()->links()}}
                    <!-- /.card -->
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
