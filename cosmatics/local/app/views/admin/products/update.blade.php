@extends('../../templates.admin')
@section('content')
<div class="general">
	<span class="nonActiveGeneral">
		Update Product
	</span>
	<span class="activeGeneral">
		{{ HTML::linkRoute("products","List Products") }}
	</span>


</div>
@if ($errors->any())
<div class="alert alert-danger" role="alert">
	{{ implode('', $errors->all('<p class="text-center">:message</p>')) }}
</div>
@endif
<div class="add-form col-sm-6 col-sm-offset-3">
	<div class="form-heading">
		Update Product
	</div>
	<div class="add-wrapper">

		{{ Form::open(array('update_product',$product->id,'class'=>'form-horizontal' ,'files'=>true)) }}
		<div class="form-group">

			{{Form::label('name', 'Title', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}

			<div class="col-sm-10">
				<input type="text" class="form-control" name="title" value="{{$product->title}}">
			</div>
		</div>
		<div class="form-group">
			{{Form::label('categories', 'Categories', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}
			<div class="col-sm-10">
				{{ Form::select('category_id', $categories,$product->category_id,array("class"=>"form-control")) }}
			</div>
		</div>
		<div class="form-group">

			{{Form::label('description', 'Description', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}

			<div class="col-sm-10">
				<textarea  name="description" cols="60" rows="10">
					{{$product->description}}
				</textarea>
			</div>
		</div>
		<div class="form-group">

			{{Form::label('price', 'Price', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}

			<div class="col-sm-10">
				<input type="number" class="form-control" name="price" value="{{$product->price}}">
			</div>
		</div>
		<div class="form-group">

			{{Form::label('mainImage', 'MainImage', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}

			<div class="col-sm-10">

					{{ Form::file('mainImage') }}
			</div>
		</div>
		<div class="form-group">

			{{Form::label('image', 'Image', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}
            
			<div class="col-sm-10">

				{{ Form::file('images[]', array('multiple'=>true)) }}
			</div>
		</div>
		<div class="form-group">

			{{Form::label('specification', 'Specification', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}

			<div class="col-sm-10">
				<textarea  name="specification" cols="60" rows="10">
					{{$product->specification}}
				</textarea>
			</div>
		</div>
		<div class="form-group">

			{{Form::label('usage', 'Usage', array('class' => 'col-sm-2 control-label ','for'=>'inputEmail3'))}}

			<div class="col-sm-10">
				<textarea  name="usage" cols="60" rows="10">
					{{$product->usage}}
				</textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary submit" name="add">Add</button>
			</div>
		</div>
	</form>


</div>
</div>


@stop