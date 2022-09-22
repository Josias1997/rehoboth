<?php
namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories = [];
    public $number_of_products;

    public function mount() {
        $home_category = HomeCategory::find(1);
        $this->selected_categories = explode(',', $home_category->sel_categories);
        $this->number_of_products = $home_category->no_of_products;
    }

    public function updateHomeCategory() {
        $home_category = HomeCategory::find(1);
        $home_category->sel_categories = implode(',', $this->selected_categories);
        $home_category->no_of_products = $this->number_of_products;
        $home_category->save();
        session()->flash('message', 'Home Category has been updated successfully');
    }
 
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component', ['categories' => $categories])->layout('layouts.base');
    }
}
