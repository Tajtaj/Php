@extends('../templates.frontend')
@section('content')
<script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
		</script>		
<div class="section group">
	<div class="cont-desc span_1_of_2">
		<div class="product-details">				
			<div class="grid images_3_of_2">
				<div id="container">
					<div id="products_example">
						<div id="products">
							<div class="slides_container">

								@foreach($productImages as $productImage)
								
									<a href="#" target="_blank"><img src="{{'../assets/products/detail_images/'.$productImage->image}}" alt=" " /></a>
								@endForeach
								
								
							</div>
							<ul class="pagination">
								@foreach($productImages as $productImage)
								<li><a href="#"><img src="{{'../assets/products/thumbnail/'.$productImage->image}}" alt=" " /></a></li>
								@endForeach
								
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="desc span_3_of_2">
				{{ Form::open(array('route' => 'addToCart')) }}
				<h2> {{$product->title }} </h2>
				<p>{{$product->description}}</p>					
				<div class="price">
					<p>Price: <span>${{$product->price}}</span></p>
					<input type='hidden' name='price' value="{{$product->price}}">
					<input type='hidden' name='product_id' value="{{$product->id}}">
					<input type='hidden' name='product_title' value="{{$product->title}}">
				</div>
				<div class="available">
						<p>Available Options :</p>
					<ul >
				
						<li>Quantity:<select name="quantity">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select></li>
					</ul>
					</div>
					<div class="share-desc">
						
						<div class="button submit_button" type="submit">
							<input type="submit" value="Add To Cart">					
						<div class="clear"></div>
					</div>
				</form>
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="product_desc">	
				<div id="horizontalTab">
					<ul class="resp-tabs-list">
						<li>Product Specification</li>
						<li>product Usage</li>
						
						<div class="clear"></div>
					</ul>
					<div class="resp-tabs-container">
						<div class="product-desc">
							<p>{{$product->specification}}</p>
						</div>	

							<div class="product-tags">
								<p>{{$product->usage}}</p>
							</div>	

							
						</div>
					</div>
				</div>
				<script type="text/javascript">
				$(document).ready(function () {
					$('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
				});
				</script>		
				
		
			</div>
		</div>
        <div class="rightsidebar span_3_of_1">
			<h2>CATEGORIES</h2>
			<ul>
				@foreach( $categories as $category )
					<li><a href="#">{{$category->name}}</a></li>
				@endForeach
				
				
			</ul>
				
		
		</div>

		@stop			