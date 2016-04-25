@extends('../templates.admin')
@section('content')
<div class="dashboard col-sm-12">
    <div class="home_items_wrapper col-sm-2">
        <div class='home_items '>
            <div class="item_logo">
                <span class="glyphicon glyphicon-globe" style="font-size:50px"></span>
            </div>
            <div class="item_url">
                {{HTML::linkRoute("categories","Categories" )}}

            </div>
        </div>
    </div>
     <div class="home_items_wrapper col-sm-2">
        <div class='home_items '>
            <div class="item_logo">
                <span class="glyphicon glyphicon-globe" style="font-size:50px"></span>
            </div>
            <div class="item_url">
                {{HTML::linkRoute("products","Products" )}}

            </div>
        </div>
    </div>

</div>


@stop