<div class="wrap-icon-section wishlist">
    <a href="{{ route('wishlist') }}" class="link-direction">
        <i class="fa fa-heart" aria-hidden="true"></i>
        <div class="left-info">
            @if(Cart::instance('wishlist')->count() > 0)
                <span class="index">{{ Cart::instance('wishlist')->count() }} item{{ Cart::instance('wishlist')->count() > 1 ? 's' : ''}}</span>
            @endif
            <span class="title">WISHLIST</span>
        </div>
    </a>
</div>
