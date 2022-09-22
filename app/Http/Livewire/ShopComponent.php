<?php
namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{

    public $sorting;
    public $pageSize;

    public $min_price;
    public $max_price;

    public function mount() {
        $this->sorting = 'default';
        $this->pageSize = 12;
        $this->min_price = 1;
        $this->max_price = 1000;
    }

    public function store($product_id, $product_name, $product_price) {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price) {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in to Wishlist');
    }

    use WithPagination;
    public function render()
    {
        if ($this->sorting == 'date') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if ($this->sorting == 'price') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);  
        } else if ($this->sorting == 'price-desc') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);  
        } else {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->paginate($this->pageSize);  
        }
        $categories = Category::all();
        return view('livewire.shop-component', ['products' => $products, 'categories' => $categories])->layout('layouts.base');
    }
}