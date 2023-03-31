@extends('layouts.dashboard')
@section('title','categories show')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$category->name}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">categories</a></li>
                            <li class="breadcrumb-item active">{{$category->name}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Store</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $products = $category->products()->with('store')->latest()->paginate(5);
                    @endphp
                    @forelse($products as $product)
                        <tr>
                            <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->store->name }}</td>
                            <td>{{ $product->status }}</td>
                            <td>{{ $product->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No products defined.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
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
