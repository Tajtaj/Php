@extends('../../templates.admin')
@section('content')
    <div class="general">
        <span class="nonActiveGeneral">
            Categories  List
        </span>
        <span class="activeGeneral">
            {{ HTML::linkRoute("add_category","Add New Category") }}
        </span>

    </div>
    @if(Session::has('msgs'))
        <div class="{{Session::get('msgs')['type']}}" role="alert">

            <p class="text-center">{{Session::get('msgs')['msg']}}</p>
        </div>
    @endif



    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title">Categories</h3>

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
                <th>Options</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>  {{  $category->name }} </td>
                    <td>{{ HTML::linkRoute("update_category","" ,array("id"=> $category->id ),array("class"=>"glyphicon glyphicon-pencil","aria-hidden"=>"true","style"=>"padding:0 5px 0 5px;"))}}{{ HTML::linkRoute("category_delete","" ,array("id"=> $category->id ),array("class"=>"glyphicon glyphicon-trash","aria-hidden"=>"true"))}}</td>

                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="pagination_links"> <?php echo $categories->links(); ?></div>
    </div>


@stop

