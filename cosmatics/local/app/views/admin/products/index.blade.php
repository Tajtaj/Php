@extends('../../templates.admin')
@section('content')
    <div class="general">
        <span class="nonActiveGeneral">
            Products  List
        </span>
        <span class="activeGeneral">
            {{ HTML::linkRoute("add_product","Add New Product") }}
        </span>

    </div>
    @if(Session::has('msgs'))
        <div class="{{Session::get('msgs')['type']}}" role="alert">

            <p class="text-center">{{Session::get('msgs')['msg']}}</p>
        </div>
    @endif



    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title">Products</h3>

            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>
                    Filter
                </button>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr class="filters">
                <th><input type="text" class="form-control" placeholder="Id" disabled></th>
                <th><input type="text" class="form-control" placeholder="Category" disabled></th>
                <th><input type="text" class="form-control" placeholder="Title" disabled></th>
                <th><input type="text" class="form-control" placeholder="Price" disabled></th>
                <th>Options</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>  {{  $product->category->name }} </td>
                    <td>  {{  $product->title }} </td>
                    <td>  {{  $product->price }} </td>
                    <td>{{ HTML::linkRoute("update_product","" ,array("id"=> $product->id ),array("class"=>"glyphicon glyphicon-pencil","aria-hidden"=>"true","style"=>"padding:0 5px 0 5px;"))}}{{ HTML::linkRoute("product_delete","" ,array("id"=> $product->id ),array("class"=>"glyphicon glyphicon-trash","aria-hidden"=>"true"))}}</td>

                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="pagination_links"> <?php echo $products->links(); ?></div>
    </div>


@stop

