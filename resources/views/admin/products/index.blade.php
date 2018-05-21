@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">All Products</div>

        <div class="card-body">

            <table class="table table-hover">
                <thead>
                <th>
                    Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
                </thead>

                <tbody>
                @foreach($products as $product)

                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-xs btn-info">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post">

                                {{ csrf_field() }}

                                {{ method_field('DELETE') }}

                                <button class="btn btn-xs btn-danger" type="submit">Delete</button>

                            </form>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>

        </div>
    </div>

@endsection
