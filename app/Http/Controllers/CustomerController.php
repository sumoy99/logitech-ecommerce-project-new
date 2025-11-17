<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\InvoiceMail;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Item;
use App\Models\PaymentHistory;
use App\Models\Comment;
use App\Models\Review;
use App\Models\DownloadHistory;
use App\Models\ReferralWithdrawRequest;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\BillingAddress;
use App\Models\WishList;

use App\Models\CustomerSupport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\CommentReplyNotification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function test(){

    }
    
    public function customerDashboard()
    {
        return view('frontend.customer.customer_dashboard');
    }
    public function customerProfile()
    {
        $user = auth()->user();

        return view('frontend.customer.customerProfile', ['user' => $user]);
    }

    public function customerProfileUpdate(Request $request)
    {
        $user = auth()->user();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['gender'] = $request->gender;
        $data['phone_number'] = $request->phone_number;
        $data['address'] = $request->address;

        if ($request->hasFile('image')) {
            $data['image'] = compressAndSaveImage($request->file('image'), 'assets/upload/user_image/', $user->image);
        }

        $user->update($data);

        toastr()->success('Profile updated successfully.');
        return redirect()->back();
    }

    public function checkOutSuccess()
    {
        return view('frontend.customer.checkOutSuccess');
    }


    
    public function cartView(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $color = $request->color;

        $options = ['color' => $color];

        \DB::table('cart_items')->insert([
            'user_id' => $userId,
            'item_id' => $productId,
            'quantity' => $quantity,
            'options' => json_encode($options),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('frontend.customer.cart');
    }


    // new

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');

        // Check if product exists
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        // Default quantity and color
        $quantity = $request->input('quantity', $product->minimum_purchase ?? 1);
        $defaultColor = optional($product->colorImages->first())->color->name ?? null;
        $color = $request->input('color', $defaultColor);

        $options = ['color' => $color];

        if (auth()->check()) {
            $userId = auth()->id();

            // Update or insert in DB
            $existingItem = \DB::table('cart_items')
                ->where('user_id', $userId)
                ->where('item_id', $productId)
                ->first();

            if ($existingItem) {
                // Update quantity & options
                \DB::table('cart_items')
                    ->where('id', $existingItem->id)
                    ->update([
                        'quantity' => $quantity,
                        'options' => json_encode($options),
                        'updated_at' => now(),
                    ]);
            } else {
                // Insert new row
                \DB::table('cart_items')->insert([
                    'user_id' => $userId,
                    'item_id' => $productId,
                    'quantity' => $quantity,
                    'options' => json_encode($options),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        } else {
            // Session cart for guest users
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                // Update quantity
                $cart[$productId]['quantity'] = $quantity;
                $cart[$productId]['options'] = $options;
            } else {
                // Add new item
                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image ?? 'default.png',
                    'quantity' => $quantity,
                    'options' => $options,
                ];
            }

            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }


    public function loadCartModal()
    {
        if (auth()->check()) {
            $userId = auth()->id();

            $allProducts = getAllProducts();

            $cartItems = \DB::table('cart_items')
                ->where('cart_items.user_id', $userId)
                ->select('cart_items.item_id', 'cart_items.quantity')
                ->get()
                ->map(function ($cartItem) use ($allProducts) {
                    $product = $allProducts->firstWhere('id', $cartItem->item_id);

                    if ($product) {
                        return (object) [
                            'id' => $product->id,
                            'final_price' => $product->final_price,
                            'name' => $product->name,
                            'stock_status' => $product->stock_status,
                            'slug' => $product->slug,
                            'price' => $product->price,
                            'quantity' => $cartItem->quantity,
                            'thumbnail' => $product->productFile->thumbnail ?? null,
                            'image' => optional($product->colorImages->first())->image ?? null,
                            'brand' => $product->brand->name ?? null,
                        ];
                    }

                    return null;
                })
                ->filter(); 

        } else {
            return redirect()->route('login');
        }

        // $totalPrice = $cartItems->sum('final_price');

        $totalPrice = $cartItems
            ->where('stock_status', 'In stock')
            ->sum(function ($item) {
                return $item->final_price;
            });

        return view('partials.shopping-cart-modal', compact('cartItems', 'totalPrice'));
    }

    public function shoppingCart()
    {
        $userId = auth()->id();
        $allProducts = getAllProducts();

        $pageData['cartItems'] = \DB::table('cart_items')
            ->where('cart_items.user_id', $userId)
            ->select('cart_items.item_id', 'cart_items.quantity', 'cart_items.options')
            ->get()
            ->map(function ($cartItem) use ($allProducts) {
                $product = $allProducts->firstWhere('id', $cartItem->item_id);

                if ($product) {
                    $finalPrice = $product->final_price ?? $product->price;
                    $totalPrice = $finalPrice * $cartItem->quantity;

                    return (object) [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'brand' => $product->brand->name ?? null,
                        'thumbnail' => $product->productFile->thumbnail ?? null,
                        'image' => optional($product->colorImages->first())->image ?? null,
                        'price' => $product->price,
                        'stock_status' => $product->stock_status,
                        'final_price' => $finalPrice,
                        'quantity' => $cartItem->quantity,
                        'total_price' => $totalPrice,
                        'options' => json_decode($cartItem->options, true),
                    ];
                }

                return null;
            })
            ->filter();

        $pageData['totalPrice'] = $pageData['cartItems']->sum('total_price');

        return view('frontend.customer.shopping_cart', $pageData);
    }

    public function cartCount()
    {
        if (auth()->check()) {
            $count = \DB::table('cart_items')->where('user_id', auth()->id())->count();
        } else {
            $cart = session()->get('cart', []);
            $count = collect($cart)->sum('quantity');
        }

        return response()->json(['count' => $count]);
    }

    public function buyNow(Request $request) 
    {
        $userId = auth()->id();
        $productId = $request->query('id'); 

        if (!$productId) {
            return redirect()->route('frontend.customer.shopping_cart');
        }

        $product = getAllProducts()->firstWhere('id', $productId);
        if (!$product) {
            return redirect()->route('frontend.customer.shopping_cart');
        }

        $quantity = (int) $request->query('qty', $product->minimum_purchase ?? 1);

        $defaultColor = optional($product->colorImages->first())->color->name ?? null;
        $color = $request->query('color', $defaultColor);

        $options = ['color' => $color];

        $existingItem = \DB::table('cart_items')
            ->where('user_id', $userId)
            ->where('item_id', $productId)
            ->first();

        if ($existingItem) {
            \DB::table('cart_items')
                ->where('id', $existingItem->id)
                ->update([
                    'quantity' => $quantity,
                    'options' => json_encode($options),
                    'updated_at' => now(),
                ]);
        } else {
            // Insert new row
            \DB::table('cart_items')->insert([
                'user_id' => $userId,
                'item_id' => $productId,
                'quantity' => $quantity,
                'options' => json_encode($options),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('frontend.customer.shopping_cart');
    }


    public function CartPrdRmv($id)
    {
        $user = auth()->user();

        CartItem::where('user_id', $user->id)->where('item_id', $id)->delete();

       return redirect()->back();
    }

    public function checkOutView(Request $request)
    {
        $userId = auth()->id();
        $productIds = $request->input('productId', []); 
        $quantities = $request->input('itemQuantity', []);  

        foreach ($productIds as $index => $productId) {
            $quantity = $quantities[$index] ?? 1;

            \DB::table('cart_items')
                ->where('user_id', $userId)
                ->where('item_id', $productId)
                ->update([
                    'quantity' => $quantity,
                    'updated_at' => now(),
                ]);
        }

        $allProducts = getAllProducts();

        $page_data['cartItems'] = \DB::table('cart_items')
            ->where('cart_items.user_id', $userId)
            ->select('cart_items.item_id', 'cart_items.quantity', 'cart_items.options')
            ->get()
            ->map(function ($cartItem) use ($allProducts) {
                $product = $allProducts->firstWhere('id', $cartItem->item_id);
                if ($product) {
                    $total_price = $product->final_price * $cartItem->quantity;
                    return (object) [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->final_price,
                        'quantity' => $cartItem->quantity,
                        'total_price' => $total_price,
                        'thumbnail' => $product->productFile->thumbnail ?? null,
                        'options' => json_decode($cartItem->options, true),
                    ];
                }
                return null;
            })
            ->filter();
        
        $page_data['shippingAddress'] = BillingAddress::where('user_id', $userId)->first();

        

        $page_data['totalPrice'] = $page_data['cartItems']->sum('total_price');

        return view('frontend.customer.check_out', $page_data);
    }


    public function orderPlace(request $request)
    {

        $billing = BillingAddress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'house' => $request->house,
                'region' => $request->region,
                'area' => $request->area,
                'custom_area' => $request->custom_area,
                'city' => $request->city,
                'custom_area' => $request->custom_area,
                'address' => $request->address,
                'colony' => $request->colony,
            ]
        );

        $order = new Order();
        $order->order_number = 'ORD-' . strtoupper(Str::random(8));
        $order->user_id = Auth::id();
        $order->total_amount = $request->total_amount;
        $order->discount_amount = 0;
        $order->payment_method = $request->payment ?? 'cash_on_delivery';
        $order->payment_status = 'pending';
        $order->order_status = 'pending';
        $order->transaction_id = null;
        $order->shipping_id = $billing->id;
        $order->notes = $request->note;
        $order->created_at = Carbon::now();
        $order->save();

         foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $product->name,
                'price' => $request->price[$key],
                'quantity' => $request->quantity[$key],
                'subtotal' => $request->price[$key] * $request->quantity[$key],
                'color' => $request->color[$key] ?? null,
                'size' => $request->size[$key] ?? null,
                'created_at' => Carbon::now(),
            ]);
        }

        \DB::table('cart_items')
        ->where('user_id', Auth::id())
        ->whereIn('item_id', $request->product_id)
        ->delete();

        return redirect()->route('frontend.index')->with('success', 'Order placed successfully!');

    }

    public function myAccount()
    {
        return view('frontend.customer.my_account');
    }

    public function myOrder()
    {
        $userId = auth()->user()->id;

        $page_data['orders'] = Order::where('user_id', $userId)->get();

        return view('frontend.customer.my_order', $page_data);
    }

    public function orderItem($id)
    {
        
        $page_data['orderItems'] = OrderItem::where('order_id', $id)->get();

        return view('frontend.customer.order_item', $page_data);
    }


    public function wishListStore($id)
    {
         WishList::create([
                'product_id' => $id,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        return redirect()->back()->with('success', 'Wish list added successfully!');
    }

    public function wishListRemove($id)
    {
         $WishList = WishList::findOrFail($id);

        $WishList->delete();

        return redirect()->back()->with('success', 'Wish list remove successfully!');
    }

    public function wishList()
    {
        $user_id = auth()->id();

        $wishlistProductIds = WishList::where('user_id', $user_id)
            ->pluck('product_id')
            ->toArray();

        $page_data['products'] = getAllProducts(20, $wishlistProductIds);

        return view('frontend.customer.wishlist', $page_data);
    }





}
