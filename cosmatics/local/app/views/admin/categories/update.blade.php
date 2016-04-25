@extends('../../templates.admin')
@section('content')
    <div class="general">
        <span class="nonActiveGeneral">
            Update Category
        </span>
        <span class="activeGeneral">
            {{ HTML::linkRoute("categories","List Categories") }}
        </span>


    </div>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ implode('', $errors->all('<p class="text-center">:message</p>')) }}
        </div>
    @endif
    <div class="add-form col-sm-6 col-sm-offset-3">
        <div class="form-heading">
            Update Region
        </div>
        <div class="add-wrapper">

            {{ Form::open(array('route' => array('update_category',$category->id), 'class'=>'form-horizontal')) }}
            <div class="form-group">

                {{Form::label('name', 'Category', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="{{$category->name}}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary submit" name="add">Update</button>
                </div>
            </div>
            </form>


        </div>
    </div>


@stop