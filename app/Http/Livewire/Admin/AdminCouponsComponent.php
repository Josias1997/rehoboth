<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCouponsComponent extends Component
{

    public function deleteCoupon($id) {
        $coupon = Coupon::find($id);
        $coupon->delete();
        session()->flash('message', 'Coupon has been deleted successfully');
    }

    use WithPagination;
    public function render()
    {
        $coupons = Coupon::paginate(5);
        return view('livewire.admin.admin-coupons-component', ['coupons' => $coupons])->layout('layouts.base');
    }
}
