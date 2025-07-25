
<div class="features-slider  owl-carousel" >
    @foreach ($items  as $item)
        <div class="slider-item">
            <div class="product-card ">
                <div class="product-thumb" >
                @if (!$item->is_stock())
                    <div class="product-badge bg-secondary border-default text-body
                    ">{{__('out of stock')}}</div>
                @endif
                @if($item->previous_price && $item->previous_price !=0)
                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                @endif
                <img class="lazy" data-src="{{url('/core/public/storage/images/'.$item->thumbnail)}}" alt="Product">
                <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                    @include('includes.item_footer',['sitem' => $item])
                </div>
            </div>
                <div class="product-card-inner">
                <div class="product-card-body">
                    <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                    <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                        {{ Str::limit($item->name, 35) }}
                    </a></h3>
                    {{-- <div class="rating-stars">
                        {!! Helper::renderStarRating($item->reviews->avg('rating')) !!}
                    </div> --}}
                    <h4 class="product-price">
                        {{-- @if ($item->previous_price !=0)
                        <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                        @endif --}}
                        {{PriceHelper::grandCurrencyPrice($item)}}
                    </h4>
                </div>

                </div>
            </div>
        </div>
    @endforeach
</div>

<script type="text/javascript" src="{{asset('assets/front/js/extraindex.js')}}"></script>
