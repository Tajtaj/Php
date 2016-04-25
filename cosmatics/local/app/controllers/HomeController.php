<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	    private $_api_context;

    public function __construct()
    {
        
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

	public function index()
	{
		$categories = Category::get();
		$products = Product::paginate(16);
		
		return View::make('frontend.index')->with('categories', $categories)->with('products', $products)->with("pageHeading", "New Products");
	}

	public function detail($id){
		$categories = Category::get();
		$product = Product::findOrFail($id);
		$productImages = ProductImage::where('product_id','=',$id)->get();

		return View::make('frontend.detail')->with('product', $product)->with('productImages', $productImages)->with('categories', $categories);
	}

	public function addToCart(){

		$quantity = Input::get('quantity');
		$price = Input::get('price');
		$id = Input::get('product_id');
		$title = Input::get('product_title');

		Cart::add(
			array(
				'id' => round(microtime(true) * 1000),
				'name'=>$title,
				'qty'=>$quantity,
				'price'=>$price
				)
			);
		return Redirect::route('home');
	}
	public function removeItem(){
		$rowid = Input::get('rowid');
		Cart::remove($rowid);
		$items = Cart::count(false);
		$price = Cart::total();

		$result = array(
			'count'=>$items,
			'price'=>$price
			);
		echo json_encode($result);

	}
	public function category($id){
		$categories = Category::get();
		$products = Product::where('category_id',"=",$id)->paginate(1);
		
		return View::make('frontend.index')->with('categories', $categories)->with('products', $products)->with("pageHeading", "Category Name");
	}  
	public function payment(){
		if(Cart::count(false) == 0)
			return Redirect::route('home');

		$items = Cart::content();
		$itemsArray =  array();
		$item_list = new ItemList();	
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');	
		$total = 0;
		foreach ($items as $item) {
			$paypalItem = new Item();
            $paypalItem->setName($item->name) // item name
            ->setCurrency('USD')
            ->setQuantity($item->qty)
                       ->setPrice($item->price ); // unit price
                       $itemsArray[] = $paypalItem;     
             $total+=$item->price * $item->qty;                
                   }
                    $item_list->setItems($itemsArray);
                   $amount = new Amount();
                   $amount->setCurrency('USD')
                   ->setTotal($total);	

                   $transaction = new Transaction();
                   $transaction->setAmount($amount)
                   ->setItemList($item_list)
                   ->setDescription('Your transaction description');

                   $redirect_urls = new RedirectUrls();
                   $redirect_urls->setReturnUrl(URL::route('payment.status'))
                   ->setCancelUrl(URL::route('payment.status'));

                   $payment = new Payment();
                   $payment->setIntent('Sale')
                   ->setPayer($payer)
                   ->setRedirectUrls($redirect_urls)
                   ->setTransactions(array($transaction));

                   try {
                   	$payment->create($this->_api_context);
                   } catch (\PayPal\Exception\PPConnectionException $ex) {
                   	 echo '<pre>';print_r(json_decode($ex->getData()));
                   	if (\Config::get('app.debug')) {
                   		echo "Exception: " . $ex->getMessage() . PHP_EOL;
                   		$err_data = json_decode($ex->getData(), true);
                   		
                   	} else {
                   		die('Some error occur, sorry for inconvenient');
                   	}
                   }

                   foreach($payment->getLinks() as $link) {
                   	if($link->getRel() == 'approval_url') {
                   		$redirect_url = $link->getHref();
                   		break;
                   	}
                   }

    // add payment ID to session
                   Session::put('paypal_payment_id', $payment->getId());

                   if(isset($redirect_url)) {
        // redirect to paypal
                   	return Redirect::away($redirect_url);
                   }

                   return Redirect::route('home')
                   ->with('error', 'Unknown error occurred');
               }
               public function paymentStatus()
               {
    // Get the payment ID before session clear
               	$payment_id = Session::get('paypal_payment_id');

    // clear the session payment ID
               	Session::forget('paypal_payment_id');

               	if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
               		return Redirect::route('home')
               		->with('error', 'Payment failed');
               	}

               	$payment = Payment::get($payment_id, $this->_api_context);

    // PaymentExecution object includes information necessary 
    // to execute a PayPal account payment. 
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
               	$execution = new PaymentExecution();
               	$execution->setPayerId(Input::get('PayerID'));

    //Execute the payment
               	$result = $payment->execute($execution, $this->_api_context);

    echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

    if ($result->getState() == 'approved') { // payment made
    	return Redirect::route('home')
    	->with('success', 'Payment success');
    }
    return Redirect::route('home')
    ->with('error', 'Payment failed');
}
}
