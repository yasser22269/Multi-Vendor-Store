<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('front.cart',[
            'cart' => $this->cart,
        ]);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $product = Product::findOrfail($request->post('product_id'));
        $this->cart->add($product,$request->post('quantity'));

        if ($request->expectsJson()) {

            return response()->json([
                'message' => 'Item added to cart!',
            ], 201);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $this->cart->update($id,$request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cart->delete($id);

        return [
            'message' => 'Item deleted!',
        ];
    }
}
