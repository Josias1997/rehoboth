<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status', 1)->get();
        $latest_products = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $home_categories = HomeCategory::find(1);
        $categories_ids = explode(',', $home_categories->sel_categories);
        $categories = Category::whereIn('id', $categories_ids)->get();
        $no_of_products = $home_categories->no_of_products;
        $products_on_sale = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);
        return view('livewire.home-component', ['sliders' => $sliders, 'latest_products' => $latest_products, 'categories' => $categories, 'no_of_products' => $no_of_products, 'products_on_sale' =>  $products_on_sale, 'sale' => $sale])->layout('layouts.base');
    }
}
