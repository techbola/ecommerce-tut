@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Edit product: {{ $product->name }}</div>

        <div class="card-body">

            <form action="{{ route('products.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" required="" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" required="" value="{{ $product->price }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Save Product
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
