@extends('master.front')

@section('title')
    {{ $item->name }}
@endsection


@section('meta')
    <meta name="tile" content="{{ $item->title }}">
    <meta name="keywords" content="{{ $item->meta_keywords }}">
    <meta name="description" content="{{ $item->meta_description }}">

    <meta name="twitter:title" content="{{ $item->title }}">
    <meta name="twitter:image" content="{{ url('/core/public/storage/images/' . $item->photo) }}">
    <meta name="twitter:description" content="{{ $item->meta_description }}">

    <meta name="og:title" content="{{ $item->title }}">
    <meta name="og:image" content="{{ url('/core/public/storage/images/' . $item->photo) }}">
    <meta name="og:description" content="{{ $item->meta_description }}">
@endsection



@section('content')


    <style>
        body {
            background-position: center;
            background-color: #ffffff;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Open Sans", sans-serif;
            font-size: 15px;
            font-weight: 400;
            line-height: 1.5;
        }

        .details-page-top-right-content {
            background: #ffffff;
            padding: 0px 72px 7px;
            border-radius: 10px;
            height: 100%;
        }

        .product-gallery {
            position: relative;
            border-radius: 10px;
            background: #ffffff;
            padding-bottom: 1px;
            overflow: hidden;
        }
           .gallery-wrapper {
                            display: flex;
                            gap: 20px;
                            max-width: 900px;
                            margin: 30px auto;
                        }

                        .thumbnail-list {
                            width: 100px;
                            display: flex;
                            flex-direction: column;
                            gap: 10px;
                        }

                        .thumbnail-list img {
                            width: 100%;
                            border: 2px solid transparent;
                            cursor: pointer;
                        }

                        .thumbnail-list img.selected {
                            border-color: gray;
                        }

                        .image-display {
                            flex: 1;
                            position: relative;
                            overflow: hidden;
                        }

                        .image-zoom-wrapper {
                            position: relative;
                            /* for lens positioning */
                        }

                        .main-product-image {
                            width: 100%;
                            max-height: 500px;
                            object-fit: contain;
                            display: block;
                        }

                        .lens-box {
                            position: absolute;
                            border: 1px solid #ccc;
                            width: 100px;
                            height: 100px;
                            opacity: 0.4;
                            background: #fff;
                            display: none;
                            cursor: crosshair;
                            pointer-events: none;
                            z-index: 10;
                        }

                        .zoom-window {
                            width: 18%;
                            height: 38%;
                            position: absolute;
                            left: 48.9%;
                            top: 29.7%;
                            border: 1px solid #ddd;
                            display: none;
                            overflow: hidden;
                            z-index: 1000000000;
                            background: #fff;
                        }

                        .zoom-window img {
                            position: absolute;
                            width: auto;
                            height: auto;
                            max-width: none;
                            /* allow scaling */
                        }
    </style>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="separator"></li>
                        <li><a href="{{ route('front.catalog') }}">{{ __('Shop') }}</a>
                        </li>
                        <li class="separator"></li>
                        <li>{{ $item->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-1x mb-1">
        <div class="row">
            <!-- Poduct Gallery-->
            <div class="col-xxl-6 col-lg-6 col-md-6">
                <div class="product-gallery">
                    @if ($item->video)
                        <div class="gallery-wrapper">
                            <div class="gallery-item video-btn text-center">
                                <a href="{{ $item->video }}" title="Watch video"></a>
                            </div>
                        </div>
                    @endif
                    @if ($item->is_stock())
                        <span
                            class="product-badge
                        @if ($item->is_type == 'feature') bg-warning
                        @elseif($item->is_type == 'new')
                        bg-success
                        @elseif($item->is_type == 'top')
                        bg-info
                        @elseif($item->is_type == 'best')
                        bg-dark
                        @elseif($item->is_type == 'flash_deal')
                            bg-success @endif
                        ">{{ __($item->is_type != 'undefine' ? ucfirst(str_replace('_', ' ', $item->is_type)) : '') }}</span>
                    @else
                        <span class="product-badge bg-secondary border-default text-body">{{ __('out of stock') }}</span>
                    @endif



                    <div class="gallery-wrapper">
                        <div class="thumbnail-list">


                            <img class="thumbnail selected" src="{{ url('/core/public/storage/images/' . $item->photo) }}"
                                data-full="{{ url('/core/public/storage/images/' . $item->photo) }}" alt="Thumbnail 1">

                            @foreach ($galleries as $key => $gallery)
                                <img class="thumbnail" src="{{ url('/core/public/storage/images/' . $gallery->photo) }}"
                                    data-full="{{ url('/core/public/storage/images/' . $gallery->photo) }}"
                                    alt="Thumbnail 2">
                            @endforeach


                        </div>
                        <div class="image-display image-zoom-wrapper">
                            <img id="mainProdImg" class="main-product-image"
                                src="{{ url('/core/public/storage/images/' . $item->photo) }}" alt="Main Product Image">
                            <div class="lens-box" id="lensBox"></div>
                        </div>
                    </div>




                </div>
            </div>
            <div class="zoom-window" id="zoomWindow">
                <img id="zoomedImg" src="{{ url('/core/public/storage/images/' . $item->photo) }}" alt="Zoomed Image">
            </div>
           
            <!-- Product Info-->
            <div class="col-xxl-6 col-lg-6 col-md-6">
                <div class="details-page-top-right-content d-flex" id="details-page-top-right-content">

                    <div class="div w-100">

                        <input type="hidden" id="item_id" value="{{ $item->id }}">
                        <input type="hidden" id="demo_price"
                            value="{{ PriceHelper::setConvertPrice($item->discount_price) }}">
                        <input type="hidden" value="{{ PriceHelper::setCurrencySign() }}" id="set_currency">
                        <input type="hidden" value="{{ PriceHelper::setCurrencyValue() }}" id="set_currency_val">
                        <input type="hidden" value="{{ $setting->currency_direction }}" id="currency_direction">
                        <h4 class="mb-2 p-title-main" style="text-transform: capitalize;">{{ $item->name }}</h4>
                        <div class="mb-3">
                            {{-- <div class="rating-stars d-inline-block gmr-3">
                                {!! Helper::renderStarRating($item->reviews->avg('rating')) !!}
                            </div> --}}
                            {{-- @if ($item->is_stock())
                                <span class="text-success  d-inline-block">{{ __('In Stock') }} <b>({{ $item->stock }}
                                        @lang('items'))</b></span>
                            @else
                                <span class="text-danger  d-inline-block">{{ __('Out of stock') }}</span>
                            @endif --}}
                        </div>
                        @if ($item->is_type == 'flash_deal')
                            @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
                                <div class="countdown countdown-alt mb-3" data-date-time="{{ $item->date }}">
                                </div>
                            @endif
                        @endif
                        <span class="h3 d-block price-area">
                            @if (
                                $item->previous_price != 0 &&
                                    PriceHelper::setPreviousPrice($item->previous_price) != PriceHelper::grandCurrencyPrice($item))
                                <small
                                    class="d-inline-block"><del>{{ PriceHelper::setPreviousPrice($item->previous_price) }}</del></small>
                                +
                            @endif
                            <span id="main_price" class="main-price">{{ PriceHelper::grandCurrencyPrice($item) }}</span>
                            <span style="font-size: 16px;color: gray;">+vat</span>
                        </span>
                        @if ($item->item_type == 'normal')
                            <div class="pt-1 mb-4"><span class="text-medium">{{ __('SKU') }}:</span>
                                #{{ $item->sku }}</div>
                        @endif
                        <style>
                            .radio-inputs {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                max-width: 350px;
                                user-select: none;
                            }

                            .radio-inputs>* {
                                margin: 6px;
                            }

                            .radio-input:checked+.radio-tile:before {
                                transform: scale(1);
                                opacity: 1;
                                background-color: gray;
                                border-color: black;
                            }

                            .radio-input:checked+.radio-tile .radio-label {
                                color: #000000;
                                font-weight: 600;
                            }

                            .radio-input:focus+.radio-tile {
                                border-color: black;
                            }

                            .radio-input:focus+.radio-tile:before {
                                transform: scale(1);
                                opacity: 1;
                            }

                            .radio-tile {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                                border: 1px solid black;
                                background-color: #fff;
                                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                                transition: 0.15s ease;
                                cursor: pointer;
                                position: relative;
                                padding: 4px 18px;
                            }

                            .radio-tile:hover {
                                background-color: #f0f0f0;
                            }

                            .radio-input:checked+.radio-tile {
                                border-color: #959595;
                                color: black;
                                background: #dddcdc;
                            }

                            .radio-label {
                                color: #707070;
                                transition: 0.375s ease;
                                text-align: center;
                                font-size: 13px;
                            }

                            .radio-input {
                                clip: rect(0 0 0 0);
                                -webkit-clip-path: inset(100%);
                                clip-path: inset(100%);
                                height: 1px;
                                overflow: hidden;
                                position: absolute;
                                white-space: nowrap;
                                width: 1px;
                            }

                            .custom-radio {
                                margin: 0px 6px;
                            }

                            .attribute-alert {
                                background: white;
                                border: 1px solid #ddd;
                                padding: 15px;
                                margin-top: 10px;
                                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                            }

                            .attribute-alert .alert-text {
                                color: red;
                                font-weight: bold;
                                margin-bottom: 10px;
                            }

                            .attribute-alert .alert-options {
                                display: flex;
                                gap: 10px;
                                flex-wrap: wrap;
                            }

                            .attribute-alert label {
                                border: 1px solid #000;
                                padding: 6px 14px;
                                cursor: pointer;
                                font-weight: 500;
                            }

                            .attribute-alert input {
                                display: none;
                            }
                        </style>


                        <div class="row margin-top-1x">
                            @foreach ($attributes as $attribute)
                                @if ($attribute->options->count() != 0)
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="d-block font-weight-bold">{{ $attribute->name }}</label>

                                            <div class="attribute_option" data-attr="{{ $attribute->id }}">
                                                @foreach ($attribute->options->where('stock', '!=', '0') as $key => $option)
                                                    <label class="custom-radio {{ $key == 0 ? 'active' : '' }}">
                                                        <input class="radio-input d-none" type="radio"
                                                            name="attribute_{{ $attribute->id }}"
                                                            value="{{ $option->name }}" data-type="{{ $attribute->id }}"
                                                            data-href="{{ $option->id }}"
                                                            data-target="{{ PriceHelper::setConvertPrice($option->price) }}">
                                                        <span class="radio-tile">
                                                            <span class="radio-label">{{ $option->name }}</span>
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                            <!-- 🔥 Alert goes here for this attribute -->
                                            <div class="attribute-alert"
                                                style="display: none;position: fixed;z-index: 999;top: 0;left: 0;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.6);justify-content: center;align-items: center;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <script>
                            function check_attribute() {
                                let allSelected = true;

                                document.querySelectorAll('.attribute_option').forEach(function(group) {
                                    const attrId = group.getAttribute('data-attr');
                                    const selected = group.querySelector('input[type="radio"]:checked');
                                    const alertBox = group.nextElementSibling; // get the .attribute-alert
                                    const attributeOptionRect = group.getBoundingClientRect();
                                    const top = (attributeOptionRect.top + window.scrollY) - 25;
                                    const left = (attributeOptionRect.left + window.scrollX - 25);

                                    if (!selected) {
                                        allSelected = false;

                                        const groupLabel = group.closest('.form-group').querySelector('label').innerText;

                                        // Clone options for inline alert
                                        const clone = group.cloneNode(true);
                                        clone.classList.remove('attribute_option');

                                        alertBox.innerHTML = `
                                            <div style="top: ${top}px;left: ${left}px;position: fixed;background: white;padding: 1px 27px;">
                                                <p class="alert-text">Please select a ${groupLabel.toLowerCase()}</p>
                                                <div class="alert-options"></div>
                                            </div>`;
                                        alertBox.querySelector('.alert-options').appendChild(clone);
                                        alertBox.style.display = 'block';

                                        // Make alert options clickable
                                        alertBox.querySelectorAll('input[type="radio"]').forEach(radio => {
                                            radio.addEventListener('change', function() {
                                                const originalRadio = group.querySelector(
                                                    `input[value="${this.value}"]`);
                                                if (originalRadio) {
                                                    originalRadio.checked = true;
                                                    alertBox.style.display = 'none';
                                                }
                                            });
                                        });

                                    } else {
                                        alertBox.style.display = 'none';
                                    }
                                });

                                if (allSelected) {
                                    enableScroll()
                                    return true; // All attributes are selected
                                } else {
                                    disableScroll();
                                    return false; // Not all attributes are selected
                                };
                                // return true; // Temporarily returning true for testing
                            }

                            function disableScroll() {
                                document.body.style.overflow = 'hidden';
                            }

                            function enableScroll() {
                                document.body.style.overflow = 'auto';
                            }
                        </script>

                        <div class="row align-items-end pb-4">
                            <div class="col-sm-12">
                                @if ($item->item_type == 'normal')
                                    <div class="qtySelector product-quantity d-none">
                                        <span class="decreaseQty subclick"><i class="fas fa-minus "></i></span>
                                        <input type="text" class="qtyValue cart-amount" value="1">
                                        <span class="increaseQty addclick"><i class="fas fa-plus"></i></span>
                                        <input type="hidden" value="3333" id="current_stock">
                                    </div>
                                @endif

                                <div class="p-action-button">
                                    @if ($item->item_type != 'affiliate')
                                        @if ($item->is_stock())
                                            <button class="btn btn-primary m-0 a-t-c-mr" id="add_to_cart"><i
                                                    class="icon-bag"></i><span>{{ __('Add to Cart') }}</span></button>
                                            <button class="btn btn-primary m-0" id="but_to_cart"><i
                                                    class="icon-bag"></i><span>{{ __('Buy Now') }}</span></button>
                                        @else
                                            <button class="btn btn-primary m-0"><i
                                                    class="icon-bag"></i><span>{{ __('Out of stock') }}</span></button>
                                        @endif
                                    @else
                                        <a href="{{ $item->affiliate_link }}" target="_blank"
                                            class="btn btn-primary m-0"><span><i
                                                    class="icon-bag"></i>{{ __('Buy Now') }}</span></a>
                                    @endif

                                </div>

                            </div>
                        </div>

                        <div class="div">
                            <button class="btn btn-primary m-0 a-t-c-mr" id="">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                        viewBox="0 0 17 16" fill="none">
                                        <path
                                            d="M9.73089 6.51967L8.25089 7.25967M8.25089 7.25967L6.77088 6.51967M8.25089 7.25967V9.11301M14.1776 4.29301L12.6976 5.03301M14.1776 4.29301L12.6976 3.55301M14.1776 4.29301V6.14634M2.32422 4.29301L3.80422 3.55301M2.32422 4.29301L3.80422 5.03301M2.32422 4.29301V6.14634M8.25089 14.6663L6.77088 13.9263M8.25089 14.6663L9.73089 13.9263M8.25089 14.6663V12.813M12.6976 12.4463L14.1776 11.7063V9.85301M9.73089 2.07301L8.25089 1.33301L6.77088 2.07301H9.73089ZM3.80422 12.4463L2.32422 11.7063V9.85301L3.80422 12.4463Z"
                                            stroke="#EAEAEA" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M8.25088 14.6668L6.77088 13.9268M8.25088 14.6668L9.73089 13.9268M8.25088 14.6668V12.8135M3.80422 12.4468L2.32422 11.7068V9.85352L3.80422 12.4468Z"
                                            stroke="#EAEAEA" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg> Try This Online</span>
                                    
                                </button>
                                <br>
                                <br>
                            <div class="t-c-b-area">

                                <style>
                                    .collapsible {
                                        background-color: #ffffff;
                                        color: gray;
                                        cursor: pointer;
                                        padding: 7px 6px;
                                        width: 100%;
                                        border: none;
                                        text-align: left;
                                        outline: none;
                                        font-size: 16px;
                                        border-bottom: 1px solid #ddd;
                                        display: flex;
                                        align-items: center;
                                        justify-content: space-between;
                                    }

                                    .collapsible .icon {
                                        font-size: 18px;
                                        transition: transform 0.3s ease;
                                    }

                                    .active_aa .icon {
                                        transform: rotate(90deg);
                                    }

                                    .content_aa {
                                        padding: 0 18px;
                                        max-height: 0;
                                        overflow: hidden;
                                        transition: max-height 0.3s ease-out;
                                        background-color: #ffffff;
                                        margin-top: 5px;
                                    }
                                </style>

                                <!-- First Collapsible -->
                                <button type="button" class="collapsible">
                                    <div>
                                        <i class="fas fa-ruler"></i> Size Chart
                                    </div>
                                    <span class="icon">&#9654;</span>
                                </button>
                                <div class="content_aa">
                                    <img class="lazy" data-src="{{ url('/assets/size.jpg') }}"
                                        src="{{ url('/assets/size.jpg') }}" alt="Size Chart"
                                        style="width: 100%; height: auto; max-height: 500px;">
                                </div>
                                <!-- First Collapsible -->
                                <button type="button" class="collapsible">
                                    <div>
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i> Product info
                                    </div>

                                    <span class="icon">&#9654;</span>
                                </button>
                                <div class="content_aa">
                                    <div class="pt-1 mb-1"><span class="text-medium">{{ __('Categories') }}:</span>
                                        <a
                                            href="{{ route('front.catalog') . '?category=' . $item->category->slug }}">{{ $item->category->name }}</a>
                                        @if ($item->subcategory->name)
                                            /
                                        @endif
                                        <a
                                            href="{{ route('front.catalog') . '?subcategory=' . $item->subcategory->slug }}">{{ $item->subcategory->name }}</a>
                                        @if ($item->childcategory->name)
                                            /
                                        @endif
                                        <a
                                            href="{{ route('front.catalog') . '?childcategory=' . $item->childcategory->slug }}">{{ $item->childcategory->name }}</a>
                                    </div>
                                    <div class="pt-1 mb-1"><span class="text-medium">{{ __('Tags') }}:</span>
                                        @if ($item->tags)
                                            @foreach (explode(',', $item->tags) as $tag)
                                                @if ($loop->last)
                                                    <a
                                                        href="{{ route('front.catalog') . '?tag=' . $tag }}">{{ $tag }}</a>
                                                @else
                                                    <a
                                                        href="{{ route('front.catalog') . '?tag=' . $tag }}">{{ $tag }}</a>,
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <!-- Second Collapsible (Example) -->
                                <button type="button" class="collapsible">
                                    <div>
                                        <i class="fas fa-newspaper"></i>
                                        Description
                                    </div>
                                    <span class="icon">&#9654;</span>
                                </button>
                                <div class="content_aa">
                                    <p>
                                        {!! $item->details !!}
                                    </p>
                                </div>
                                <button type="button" class="collapsible">
                                    <div>
                                        <i class="fa fa-address-book" aria-hidden="true"></i>
                                        Specifications
                                    </div>
                                    <span class="icon">&#9654;</span>
                                </button>
                                <div class="content_aa">
                                    <div class="comparison-table">
                                        <table class="table table-bordered">
                                            <thead class="bg-secondary">
                                            </thead>
                                            <tbody>
                                                <tr class="bg-secondary">
                                                    <th class="text-uppercase">{{ __('Specifications') }}</th>
                                                    <td><span class="text-medium">{{ __('Descriptions') }}</span></td>
                                                </tr>
                                                @if ($sec_name)
                                                    @foreach (array_combine($sec_name, $sec_details) as $sname => $sdetail)
                                                        <tr>
                                                            <th>{{ $sname }}</th>
                                                            <td>{{ $sdetail }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="text-center">
                                                        <td colspan="2">{{ __('No Specifications') }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <script>
                                    const collapsibles = document.querySelectorAll('.collapsible');
                                    collapsibles.forEach(btn => {
                                        btn.addEventListener('click', function() {
                                            this.classList.toggle('active_aa');
                                            const content = this.nextElementSibling;
                                            if (content.style.maxHeight) {
                                                content.style.maxHeight = null;
                                            } else {
                                                content.style.maxHeight = content.scrollHeight + "px";
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>


    {{-- <!-- Reviews-->
    <div class="container  review-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="h3">{{ __('Latest Reviews') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                @forelse ($reviews as $review)
                    <div class="single-review">
                        <div class="comment">
                            <div class="comment-author-ava"><img class="lazy"
                                    data-src="{{ url('/core/public/storage/images/' . $review->user->photo) }}"
                                    alt="Comment author">
                            </div>
                            <div class="comment-body">
                                <div class="comment-header d-flex flex-wrap justify-content-between">
                                    <div>
                                        <h4 class="comment-title mb-1">{{ $review->subject }}</h4>
                                        <span>{{ $review->user->first_name }}</span>
                                        <span class="ml-3">{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <div class="rating-stars">
                                            @php
                                                for ($i = 0; $i < $review->rating; $i++) {
                                                    echo "<i class = 'far fa-star filled'></i>";
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                                <p class="comment-text  mt-2">{{ $review->review }}</p>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-5">
                        {{ __('No Review') }}
                    </div>
                @endforelse
                <div class="row mt-15">
                    <div class="col-lg-12 text-center">
                        {{ $reviews->links() }}
                    </div>
                </div>

            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="d-inline align-baseline display-3 mr-1">
                                {{ round($item->reviews->avg('rating'), 2) }}</div>
                            <div class="d-inline align-baseline text-sm text-warning mr-1">
                                <div class="rating-stars">
                                    {!! Helper::renderStarRating($item->reviews->avg('rating')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="pt-3">
                            <label class="text-medium text-sm">5 {{ __('stars') }} <span class="text-muted">-
                                    {{ $item->reviews->where('status', 1)->where('rating', 5)->count() }}</span></label>
                            <div class="progress margin-bottom-1x">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ $item->reviews->where('status', 1)->where('rating', 5)->sum('rating') * 20 }}%; height: 2px;"
                                    aria-valuenow="100"
                                    aria-valuemin="{{ $item->reviews->where('rating', 5)->sum('rating') * 20 }}"
                                    aria-valuemax="100"></div>
                            </div>
                            <label class="text-medium text-sm">4 {{ __('stars') }} <span class="text-muted">-
                                    {{ $item->reviews->where('status', 1)->where('rating', 4)->count() }}</span></label>
                            <div class="progress margin-bottom-1x">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ $item->reviews->where('status', 1)->where('rating', 4)->sum('rating') * 20 }}%; height: 2px;"
                                    aria-valuenow="{{ $item->reviews->where('rating', 4)->sum('rating') * 20 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <label class="text-medium text-sm">3 {{ __('stars') }} <span class="text-muted">-
                                    {{ $item->reviews->where('status', 1)->where('rating', 3)->count() }}</span></label>
                            <div class="progress margin-bottom-1x">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ $item->reviews->where('rating', 3)->sum('rating') * 20 }}%; height: 2px;"
                                    aria-valuenow="{{ $item->reviews->where('rating', 3)->sum('rating') * 20 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <label class="text-medium text-sm">2 {{ __('stars') }} <span class="text-muted">-
                                    {{ $item->reviews->where('status', 1)->where('rating', 2)->count() }}</span></label>
                            <div class="progress margin-bottom-1x">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ $item->reviews->where('status', 1)->where('rating', 2)->sum('rating') * 20 }}%; height: 2px;"
                                    aria-valuenow="{{ $item->reviews->where('rating', 2)->sum('rating') * 20 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <label class="text-medium text-sm">1 {{ __('star') }} <span class="text-muted">-
                                    {{ $item->reviews->where('status', 1)->where('rating', 1)->count() }}</span></label>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ $item->reviews->where('status', 1)->where('rating', 1)->sum('rating') * 20 }}; height: 2px;"
                                    aria-valuenow="0"
                                    aria-valuemin="{{ $item->reviews->where('rating', 1)->sum('rating') * 20 }}"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        @if (Auth::user())
                            <div class="pb-2"><a class="btn btn-primary btn-block" href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#leaveReview"><span>{{ __('Leave a Review') }}</span></a></div>
                        @else
                            <div class="pb-2"><a class="btn btn-primary btn-block"
                                    href="{{ route('user.login') }}"><span>{{ __('Login') }}</span></a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @if (count($related_items) > 0)
        <div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
            <!-- Related Products Carousel-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="h3">{{ __('You May Also Like') }}</h2>
                    </div>
                </div>
            </div>
            <!-- Carousel-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="relatedproductslider owl-carousel">
                        @foreach ($related_items as $related)
                            <div class="slider-item">
                                <div class="product-card">

                                    @if ($related->is_stock())
                                        @if ($related->is_type == 'new')
                                        @else
                                            <div
                                                class="product-badge
                                    @if ($related->is_type == 'feature') bg-warning

                                    @elseif($related->is_type == 'top')
                                    bg-info
                                    @elseif($related->is_type == 'best')
                                    bg-dark
                                    @elseif($related->is_type == 'flash_deal')
                                    bg-success @endif
                                    ">
                                                {{ $related->is_type != 'undefine' ? ucfirst(str_replace('_', ' ', $related->is_type)) : '' }}
                                            </div>
                                        @endif
                                    @else
                                        <div
                                            class="product-badge bg-secondary border-default text-body
                                    ">
                                            {{ __('out of stock') }}</div>
                                    @endif
                                    @if ($related->previous_price && $related->previous_price != 0)
                                        <div class="product-badge product-badge2 bg-info">
                                            -{{ PriceHelper::DiscountPercentage($related) }}</div>
                                    @endif

                                    @if ($related->previous_price && $related->previous_price != 0)
                                        <div class="product-badge product-badge2 bg-info">
                                            -{{ PriceHelper::DiscountPercentage($related) }}</div>
                                    @endif
                                    <div class="product-thumb">
                                        <img class="lazy"
                                            data-src="{{ url('/core/public/storage/images/' . $related->thumbnail) }}"
                                            alt="Product">
                                        <div class="product-button-group">
                                            <a class="product-button wishlist_store"
                                                href="{{ route('user.wishlist.store', $related->id) }}"
                                                title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>
                                            @include('includes.item_footer', ['sitem' => $related])
                                        </div>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="product-category"><a
                                                href="{{ route('front.catalog') . '?category=' . $related->category->slug }}">{{ $related->category->name }}</a>
                                        </div>
                                        <h3 class="product-title"><a href="{{ route('front.product', $related->slug) }}">
                                                {{ Str::limit($related->name, 35) }}
                                            </a></h3>
                                        <h4 class="product-price">
                                            {{-- @if ($related->previous_price != 0 && $related->previous_price == PriceHelper::grandCurrencyPrice($related))
                                                <del>{{ PriceHelper::setPreviousPrice($related->previous_price) }}</del>
                                            @endif --}}
                                            {{ PriceHelper::grandCurrencyPrice($related) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif



    @auth
        <form class="modal fade ratingForm" action="{{ route('front.review.submit') }}" method="post" id="leaveReview"
            tabindex="-1">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Leave a Review') }}</h4>
                        <button class="close modal_close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $user = Auth::user();
                        @endphp
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-name">{{ __('Your Name') }}</label>
                                    <input class="form-control" type="text" id="review-name"
                                        value="{{ $user->first_name }}" required>
                                </div>
                            </div>
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-email">{{ __('Your Email') }}</label>
                                    <input class="form-control" type="email" id="review-email"
                                        value="{{ $user->email }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-subject">{{ __('Subject') }}</label>
                                    <input class="form-control" type="text" name="subject" id="review-subject" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-rating">{{ __('Rating') }}</label>
                                    <select name="rating" class="form-control" id="review-rating">
                                        <option value="5">5 {{ __('Stars') }}</option>
                                        <option value="4">4 {{ __('Stars') }}</option>
                                        <option value="3">3 {{ __('Stars') }}</option>
                                        <option value="2">2 {{ __('Stars') }}</option>
                                        <option value="1">1 {{ __('Star') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review-message">{{ __('Review') }}</label>
                            <textarea class="form-control" name="review" id="review-message" rows="8" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit"><span>{{ __('Submit Review') }}</span></button>
                    </div>
                </div>
            </div>
        </form>
    @endauth


     <script>
                const thumbnails = document.querySelectorAll('.thumbnail');
                const mainProdImg = document.getElementById('mainProdImg');
                const lensBox = document.getElementById('lensBox');
                const zoomWindow = document.getElementById('zoomWindow');
                const zoomedImg = document.getElementById('zoomedImg');
                const zoomWrapper = document.querySelector('.image-zoom-wrapper');
                // const details_page_top_right_content = document.getElementById('details-page-top-right-content');

                // var details_page_top_right_content_top = details_page_top_right_content.top;
                // var details_page_top_right_content_left = details_page_top_right_content.left;

                // zoomWindow.style.top = details_page_top_right_content_top + 'px';
                // zoomWindow.style.left = details_page_top_right_content_left + 'px';
                // Change main image and zoom on thumbnail click
                thumbnails.forEach(thumb => {
                    thumb.addEventListener('click', () => {
                        thumbnails.forEach(t => t.classList.remove('selected'));
                        thumb.classList.add('selected');
                        mainProdImg.src = thumb.dataset.full;
                        zoomedImg.src = thumb.dataset.full;
                    });
                });

                zoomWrapper.addEventListener('mouseenter', () => {
                    lensBox.style.display = 'block';
                    zoomWindow.style.display = 'block';
                    updateZoomImageSize();
                });

                zoomWrapper.addEventListener('mouseleave', () => {
                    lensBox.style.display = 'none';
                    zoomWindow.style.display = 'none';
                });

                zoomWrapper.addEventListener('mousemove', (e) => {
                    const rect = zoomWrapper.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const lensX = Math.max(0, Math.min(x - lensBox.offsetWidth / 2, zoomWrapper.offsetWidth - lensBox
                        .offsetWidth));
                    const lensY = Math.max(0, Math.min(y - lensBox.offsetHeight / 2, zoomWrapper.offsetHeight - lensBox
                        .offsetHeight));

                    lensBox.style.left = lensX + 'px';
                    lensBox.style.top = lensY + 'px';

                    const scaleX = zoomWindow.offsetWidth / lensBox.offsetWidth;
                    const scaleY = zoomWindow.offsetHeight / lensBox.offsetHeight;

                    zoomedImg.style.width = mainProdImg.width * scaleX + 'px';
                    zoomedImg.style.height = mainProdImg.height * scaleY + 'px';

                    zoomedImg.style.left = -lensX * scaleX + 'px';
                    zoomedImg.style.top = -lensY * scaleY + 'px';
                });

                function updateZoomImageSize() {
                    const scaleX = zoomWindow.offsetWidth / lensBox.offsetWidth;
                    const scaleY = (zoomWindow.offsetHeight / lensBox.offsetHeight);
                    zoomedImg.style.width = mainProdImg.width * scaleX + 'px';
                    zoomedImg.style.height = 'auto'; // Maintain aspect ratio
                }

                mainProdImg.addEventListener('load', updateZoomImageSize);
            </script>

@endsection
