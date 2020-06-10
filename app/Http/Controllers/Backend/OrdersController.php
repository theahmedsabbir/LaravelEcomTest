<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;

use PDF;

class OrdersController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

	public function index(){
		$orders = Order::orderBy( 'id', 'desc' )->get();
		return view('Backend.pages.order.index', compact('orders'));
	}

	public function show( $id ){
		$order = Order::find( $id );

		$order->is_seen_by_admin = 1;
		$order->save();
		
		return view('Backend.pages.order.show', compact('order'));
	}

	public function chargeUpdate(Request $request, $order_id ){

		$order = Order::find( $order_id );

		$order->shipping_charge = $request->shipping_charge;
		$order->custom_discount = $request->custom_discount;

		$order->save();


		session()->flash('success', 'Order Charge and discount changed' );
		return back();
	}

	public function generateInvoice( $id ){
		$order = Order::find($id);

		// return view('Backend.pages.order.invoice', compact('order'));
		$pdf = PDF::loadView('Backend.pages.order.invoice', compact('order') );
		$pdf->stream('invoice.pdf');
		return $pdf->download('invoice.pdf');
	}


	public function order_completed( $order_id ){
		$order = Order::find( $order_id );

		if( $order->is_completed ){
			$order->is_completed = 0;
			$order->save();
			session()->flash('sticky_error', 'Order Completion Cancelled');
		}else{			
			$order->is_completed = 1;
			$order->save();
			session()->flash('success', 'Order Completed successfully' );
		}

		return back();
	}

	public function order_paid( $order_id ){
		$order = Order::find( $order_id );

		if( $order->is_paid ){
			$order->is_paid = 0;
			$order->save();
			session()->flash('sticky_error', 'Order payment Cancelled');
		}else{			
			$order->is_paid = 1;
			$order->save();
			session()->flash('success', 'Order payment submitted successfully' );
		}

		return back();
	}

	public function delete($id){
		$cat_to_del = Category::find( $id );

		if( !is_null($cat_to_del) ){

			// if parent category, then delete all it's sub images and sub-cats
			if( $cat_to_del->parent == NULL ){
				$sub_cats = Category::all()->where('parent_id', $cat_to_del->id);


				foreach ($sub_cats as $sub_cat) {

					// delete all subcategory images 
					$cat_img_loc = 'images/categories/'.$sub_cat->image;

					if( !is_null($sub_cat->image) && File::exists( $cat_img_loc )){
						File::delete( $cat_img_loc );
					}

					// delete all sub categories

					$sub_cat->delete();
				}

			}

			// delete parent category images 

			$cat_img_loc2 = 'images/categories/'.$cat_to_del->image;

			if( !is_null($cat_to_del->image) && File::exists( $cat_img_loc2 )){
				File::delete( $cat_img_loc2 );
			}

			// delete parent category
			$cat_to_del->delete();

			session()->flash("success", "Category has been deleted successfully");
		}

		return back();
	}
}


/*



					echo "<pre>";
					var_dump();
					echo "<pre/>";
