
@extends('../templates.frontend')
@section('content')

		<div class="header_slide">
					<div class="header_bottom_left">				
						<div class="categories">
							<h3>Categories</h3>
							<ul>
								@foreach($categories as $category)
								<li>
									<a href="{{ URL::route('category', array('id'=>$category->id)) }}">
									{{$category->name}}
									</a>
								
							    @endForeach
							</ul>
						</div>					
					</div>
					<div class="header_bottom_right">					 
						<div class="slider">					     
							<div id="slider">
								<div id="mover">
									<div id="slide-1" class="slide">			                    
										<div class="slider-img">
											<a href="preview.html"><img src="{{URL::to('/').'/assets/images/slide-1-image.png'}}" alt="learn more" /></a>									    
										</div>
										<div class="slider-text">
											<h1>Clearance<br><span>SALE</span></h1>
											<h2>UPTo 20% OFF</h2>
											<div class="features_list">
												<h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>							               
											</div>
											<a href="preview.html" class="button">Shop Now</a>
										</div>			               
										<div class="clear"></div>				
									</div>	
								<div id="slide-1" class="slide">			                    
										<div class="slider-img">
											<a href="preview.html"><img src="{{URL::to('/').'/assets/images/slide-1-image.png'}}" alt="learn more" /></a>									    
										</div>
										<div class="slider-text">
											<h1>Clearance<br><span>SALE</span></h1>
											<h2>UPTo 20% OFF</h2>
											<div class="features_list">
												<h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>							               
											</div>
											<a href="preview.html" class="button">Shop Now</a>
										</div>			               
										<div class="clear"></div>				
									</div>	<div id="slide-2" class="slide">			                    
										<div class="slider-img">
											<a href="preview.html"><img src="{{URL::to('/').'/assets/images/slide-1-image.png'}}" alt="learn more" /></a>									    
										</div>
										<div class="slider-text">
											<h1>Clearance<br><span>SALE</span></h1>
											<h2>UPTo 20% OFF</h2>
											<div class="features_list">
												<h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>							               
											</div>
											<a href="preview.html" class="button">Shop Now</a>
										</div>			               
										<div class="clear"></div>				
									</div>													
								</div>		
							</div>
							<div class="clear"></div>					       
						</div>
					</div>
					<div class="clear"></div>
				</div>
							<div class="main">
				<div class="content">
					<div class="content_top">
						<div class="heading">
							<h3>{{$pageHeading}}</h3>
						</div>
						
						<div class="clear"></div>
					</div>

              
				@for($i = 0; $i< count($products) ; $i++)
                    
                @if($i%4 == 0)
                   @if($i!=0)
                      </div>
                   @endIf
					<div class="section group">
                @endIf 

					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.html"><img src="{{URL::to('/').'/assets/products/'.$products[$i]->mainImage}}" alt="{{$products[$i]->title}}" /></a>
						<h2>{{Helper::limitText($products[$i]->title,70) }}</h2>
						<div class="price-details">
							<div class="price-number">
								<p><span class="rupees">${{$products[$i]->price}}</span></p>
							</div>
							<div class="add-cart">								
								<h4><a href="{{ URL::route('detail', $products[$i]->id) }}">Read More</a></h4>
							</div>
							<div class="clear"></div>
						</div>

					</div>
				  	
			  @endFor	
			</div>
			<div class="pagination_links"> {{ $products->links() }}</div>
<script>
// Ready function
$(document).ready(function() {
    $(".header_bottom_left .categories > ul").niceScroll({
		touchbehavior:false,
		cursorcolor:"#b81d22",
		zindex:9000,
		cursoropacitymax:1,
		cursorwidth:5,
		background:"#bababa",
		autohidemode:true,
		cursorborderradius:"20px",
		cursorborder:"0px",
		});
  });
</script>	

		
@stop			