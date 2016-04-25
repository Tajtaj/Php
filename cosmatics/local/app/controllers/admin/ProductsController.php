<?php

/**
 * Created by PhpStorm.
 * User: hp
 * Date: 5/11/2015
 * Time: 11:57 AM
 */
class ProductsController extends \BaseController
{
	public function index()
	{
		$products = Product::orderBy('id', 'DESC')->paginate(15);
		$breadcrumbs = array(
			array(
				"type" => "active",
				"value" => "Control Panel",
				"url" => "login-form"
				),
			array(
				"type" => "inactive",
				"value" => "Products List"
				),
			);

		return View::make('admin.products.index')->with("breadcrumbs", $breadcrumbs)->with("products", $products);
	}

	public function delete($id)
	{

		$product = Product::findOrFail($id);
		$this->removeImages('assets/products', $id);
		$this->removeImage('assets/products/'.$product->mainImage);
		$product->delete();
		$msgs = array("type" => "alert alert-danger",
			"msg" => "The Record Have Been Deleted Successfully!");
		return Redirect::route('products')->with("msgs", $msgs);


	}


	public function add()
	{
		$categories = ['0' => 'Please Select Category'] + Category::lists('name', 'id');
		if (Request::isMethod('post')) {
			$images = Input::file("images");



			$rules = array(

				'category_id'=>'Required|not_in:0',
				'mainImage'=>'required|mimes:jpeg,png',
				'title'=>'Required',
				'price'=>'Required',
				'description'=>'Required',

				);


			if (Input::hasFile('images') && is_array(Input::file("images"))) {
				foreach($images as $key => $val){
					
					$rules['images.'.$key] = "required|mimes:jpeg,png";
				}
			}else{
				$rules['images'] = "required|mimes:jpeg,png";
			}

			
			
			
			$validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {//
            /*
            $mainImage = Input::file('mainImage');
        	$mainImageName = time() . "_" . $mainImage->getClientOriginalName();
		    $mainImage->move('assets/products/', $mainImageName);
		    Image::make('assets/products/', $mainImageName)->resize(223, 250)->save('assets/products/', $mainImageName);
			*/
		    if (Input::hasFile('mainImage') ) {


		    	$mainImage = Input::file('mainImage');
		    	$mainImageName = time() . "_" . $mainImage->getClientOriginalName();
		    	$mainImage->move('assets/products/', $mainImageName);

		    	Image::make('assets/products/'. $mainImageName)->resize(223, 250)->save('assets/products/'. $mainImageName);


		    }
		    $product =new Product;
		    $product->category_id = Input::get('category_id');
		    $product->title = Input::get('title');
		    $product->description = Input::get('description');
		    $product->price = Input::get('price');
		    $product->specification = Input::get('specification');
		    $product->usage = Input::get('usage');
		    $product->mainImage = $mainImageName;
		    $product->save();


		    $this->addImages('assets/products', $product->id, $images);

		    $msgs = array("type" => "alert alert-success",
		    	"msg" => "The Record Have Been  Successfully Added!");
		    return Redirect::route('products')->with("msgs", $msgs);


        } else {//
        	return Redirect::back()->withErrors($validator->errors());
        }
    } else {
    	$breadcrumbs = array(
    		array(
    			"type" => "active",
    			"value" => "Control Panel",
    			"url" => "login-form"
    			),
    		array(
    			"type" => "active",
    			"value" => "Products List",
    			"url" => "products"
    			),
    		array(
    			"type" => "inactive",
    			"value" => "Add Product"
    			),
    		);

    	return View::make('admin.products.add')->with("breadcrumbs", $breadcrumbs)->with('categories', $categories);
    }
}

public function addImages($path, $productId, $images){

	$detailImagesPath = $path.'/detail_images/';
	$thumbnailpath = $path.'/thumbnail/';

	foreach($images as $image){
		$imagename = time() . "_" . $image->getClientOriginalName();

		$detailImage = $image->move($detailImagesPath, $imagename);
		
		if ($detailImage) {
			Image::make($detailImagesPath . $imagename)->resize(350, 274)->save($detailImagesPath . $imagename);
		}
		if (\File::copy($detailImagesPath.$imagename , $thumbnailpath.$imagename)) {
			Image::make($thumbnailpath . $imagename)->resize(55, 41)->save($thumbnailpath . $imagename);
		}
		
		$productImage = new ProductImage;
		$productImage->product_id =$productId;
		$productImage->image = $imagename;
		$productImage->save();



	}
}
public function removeImages($path, $productId){
	$images= ProductImage::where('product_id','=',$productId)->get();
	foreach($images as $image){
		$this->removeImage($path."/detail_images/".$image->image);
		$this->removeImage($path."/thumbnail/".$image->image);

	}
	
}
public function removeImage($image){
	if (file_exists($image)) {
		File::delete( $image );
	}
}
public function update($id)
{
	$product = Product::findOrFail($id);
	$categories = ['0' => 'Please Select Category'] + Category::lists('name', 'id');
        if (Request::isMethod('post')) {///Means form have been submitted
        	$images = Input::file("images");

        	$rules = array(
        		'category_id'=>'Required|not_in:0',
        		'title'=>'Required',
        		'price'=>'Required',
        		
        		'description'=>'Required',

        		);


        	if (Input::hasFile('images') && is_array(Input::file("images"))) {

        		foreach($images as $key => $val){

        			$rules['images.'.$key] = "required|mimes:jpeg,png";
        		}
        	}

        	if (Input::hasFile('mainImage')) {

        		$rules['mainImage'] = "required|mimes:jpeg,png";
        	}
        	$validator = Validator::make(Input::all(), $rules);
        	if ($validator->passes()) {
        		if (Input::hasFile('mainImage') ) {

        			$this->removeImage('assets/products/'. $product->mainImage);
        			$mainImage = Input::file('mainImage');
        			$mainImageName = time() . "_" . $mainImage->getClientOriginalName();
        			$mainImage->move('assets/products/', $mainImageName);
        			Image::make('assets/products/'. $mainImageName)->resize(223, 250)->save('assets/products/'. $mainImageName);
        			$product->mainImage = $mainImageName;
        			
        		}
        		if (Input::hasFile('images') ) {

        			$this->removeImages('assets/products', $product->id);
        			//$this->removeImages('assets/products', $product->id);
        			$this->addImages('assets/products', $product->id, $images);
        		}
        		$product->category_id = Input::get('category_id');
        		$product->title = Input::get('title');
        		$product->description = Input::get('description');
        		$product->price = Input::get('price');
        		$product->specification = Input::get('specification');
        		$product->usage = Input::get('usage');
        		$product->save();

        		
        		$msgs = array("type" => "alert alert-success",
        			"msg" => "The Record Have Been  Successfully Changed!");
        		return Redirect::route('products')->with("msgs", $msgs);

        	} else {
        		return Redirect::back()->withErrors($validator->errors());
        	}
        } else {
        	$breadcrumbs = array(
        		array(
        			"type" => "active",
        			"value" => "Control Panel",
        			"url" => "login-form"
        			),
        		array(
        			"type" => "active",
        			"value" => "Products List",
        			"url" => "products"
        			),
        		array(
        			"type" => "active",
        			"value" => "Add Product",
        			"url" => "add_product"
        			),
        		array(
        			"type" => "inactive",
        			"value" => "Update Product"
        			)
        		);

        	return View::make('admin.products.update')->with('categories',$categories)->with("breadcrumbs", $breadcrumbs)->with("product", $product);
        }
    }
}