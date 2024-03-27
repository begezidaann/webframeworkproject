@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header">{{ __('Table Product') }}</div>
  
                <div class="card-body">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-dark">
                        Add Product
                    </a>
                    <table class="table" id="products">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Selling Price</th>
                                <th scope="col">Product Type Name</th>
                                <th scope="col">Product Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($products as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->qty}}</td>
                                <td>{{$row->selling_price}}</td>
                                <td>{{$row->product_typeid->product_nametype}}</td>
                                <td>{{$row->product_stat}}</td>
                                <td>                
                                    <a href="" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="" method="POST"
                                    style="display: inline" onsubmit="return confirm('Do you really want to delete ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="text-muted">
                                        Delete
                                    </span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#products');
</script>
@endsection