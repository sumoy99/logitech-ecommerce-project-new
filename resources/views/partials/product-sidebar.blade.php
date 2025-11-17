<section class="flat-spacing-1">
        <div class="container">
            <div class="tf-shop-control grid-3 align-items-center">
                <div></div>
                <ul class="tf-control-layout d-flex justify-content-center">
                    <li class="tf-view-layout-switch sw-layout-list list-layout" data-value-layout="list">
                        <div class="item"><span class="icon icon-list"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                        <div class="item"><span class="icon icon-grid-2"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-3" data-value-layout="tf-col-3">
                        <div class="item"><span class="icon icon-grid-3"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-4 active" data-value-layout="tf-col-4">
                        <div class="item"><span class="icon icon-grid-4"></span></div>
                    </li>
                </ul>
                <div class="tf-control-sorting d-flex justify-content-end">
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">Featured</span>
                            <span class="icon icon-arrow-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item active">
                                <span class="text-value-item">Featured</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">Best selling</span>
                            </div>
                            <div class="select-item" data-sort-value="a-z">
                                <span class="text-value-item">Alphabetically, A-Z</span>
                            </div>
                            <div class="select-item" data-sort-value="z-a">
                                <span class="text-value-item">Alphabetically, Z-A</span>
                            </div>
                            <div class="select-item" data-sort-value="price-low-high">
                                <span class="text-value-item">Price, low to high</span>
                            </div>
                            <div class="select-item" data-sort-value="price-high-low">
                                <span class="text-value-item">Price, high to low</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">Date, old to new</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">Date, new to old</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tf-row-flex">
                <div class="tf-shop-sidebar sidebar-filter canvas-filter left">
                    <div class="canvas-wrapper">
                        <div class="canvas-header d-flex d-xl-none">
                            <div class="filter-icon">
                                <span class="icon icon-filter"></span>
                                <span>Filter</span>
                            </div>
                            <span class="icon-close icon-close-popup close-filter"></span>
                        </div>
                        <div class="canvas-body">
                            @if($subcategories->isNotEmpty())
                                <div class="widget-facet wd-categories">
                                    <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="categories">
                                        <span>Product categories</span>
                                        <span class="icon icon-arrow-up"></span>
                                    </div>
                                    <div id="categories" class="collapse show">
                                        <ul class="list-categoris current-scrollbar mb_36">
                                            @foreach($subcategories as $sub)
                                                <li class="cate-item">
                                                    <a href="{{ route('frontend.category_products', [$sub->slug, $sub->id]) }}">
                                                        <span>{{ $sub->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <form action="#" id="facet-filter-form" class="facet-filter-form">
                                 <input type="hidden" name="category_id" value="{{ $category->id }}">
                                <div class="widget-facet">
                                    <div class="facet-title" data-bs-target="#availability"
                                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="availability">
                                        <span>Availability</span>
                                        <span class="icon icon-arrow-up"></span>
                                    </div>
                                    <div id="availability" class="collapse show">
                                        <ul class="tf-filter-group current-scrollbar mb_36">
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="availability" class="tf-check"
                                                    id="inStock">
                                                <label for="inStock" class="label"><span>in Stock</span>&nbsp;</label>
                                            </li>
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="availability" class="tf-check"
                                                    id="outStock">
                                                <label for="outStock" class="label"><span>Out of
                                                        stock</span>&nbsp;</label>
                                            </li>
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="availability" class="tf-check"
                                                    id="upcoming">
                                                <label for="upcoming" class="label"><span>Upcoming</span>&nbsp;</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget-facet wrap-price">
                                    <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="price">
                                        <span>Price</span>
                                        <span class="icon icon-arrow-up"></span>
                                    </div>
                                    <div id="price" class="collapse show">
                                        <div class="widget-price filter-price">
                                            <div class="price-val-range" id="price-value-range" data-min="0"
                                                data-max="200000"></div>
                                            <div class="box-title-price">
                                                <span class="title-price">Price :</span>
                                                <div class="caption-price">
                                                    <div class="price-val" id="price-min-value" data-currency="{{currency()}}">
                                                    </div>
                                                    <span>-</span>
                                                    <div class="price-val" id="price-max-value" data-currency="{{currency()}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($brandIds->isNotEmpty())
                                    <div class="widget-facet">
                                        <div class="facet-title" data-bs-target="#brand" data-bs-toggle="collapse"
                                            aria-expanded="true" aria-controls="brand">
                                            <span>Brand</span>
                                            <span class="icon icon-arrow-up"></span>
                                        </div>
                                        <div id="brand" class="collapse show">
                                            <ul class="tf-filter-group current-scrollbar mb_36">
                                                @foreach ($brandIds as $brandId)
                                                    @php
                                                        $brand = DB::table('brands')->where('id', $brandId)->first();
                                                        $productCount = DB::table('products')
                                                            ->where('brand_id', $brandId)
                                                            ->where('status', 1)
                                                            ->count();
                                                    @endphp

                                                    @if ($brand)
                                                        <li class="list-item d-flex gap-12 align-items-center">
                                                            <input type="radio" name="brand" class="tf-check" id="{{$brand->name }}">
                                                            <label for="{{$brand->name }}" class="label">
                                                                <span>{{ ucfirst($brand->name) }}</span>&nbsp;
                                                                {{-- <span>({{ $productCount }})</span> --}}
                                                            </label>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($colors->isNotEmpty())
                                    <div class="widget-facet">
                                        <div class="facet-title" data-bs-target="#color" data-bs-toggle="collapse"
                                            aria-expanded="true" aria-controls="color">
                                            <span>Color</span>
                                            <span class="icon icon-arrow-up"></span>
                                        </div>
                                        <div id="color" class="collapse show">
                                            <ul class="tf-filter-group filter-color current-scrollbar mb_36">
                                                @foreach ($colors as $color)
                                                    <li class="list-item d-flex gap-12 align-items-center">
                                                        <input type="radio" name="color" class="tf-check-color"style="background-color:{{ $color->hex_code }};">
                                                        <label for="{{$color->name}}"
                                                            class="label"><span>{{$color->name}}</span>&nbsp;</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                {{-- <div class="widget-facet">
                                    <div class="facet-title" data-bs-target="#size" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="size">
                                        <span>Size</span>
                                        <span class="icon icon-arrow-up"></span>
                                    </div>
                                    <div id="size" class="collapse show">
                                        <ul class="tf-filter-group current-scrollbar">
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="size" class="tf-check tf-check-size"
                                                    value="S" id="S">
                                                <label for="S"
                                                    class="label"><span>S</span>&nbsp;<span>(7)</span></label>
                                            </li>
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="size" class="tf-check tf-check-size"
                                                    value="M" id="M">
                                                <label for="M"
                                                    class="label"><span>M</span>&nbsp;<span>(8)</span></label>
                                            </li>
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="size" class="tf-check tf-check-size"
                                                    value="L" id="L">
                                                <label for="L"
                                                    class="label"><span>L</span>&nbsp;<span>(8)</span></label>
                                            </li>
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="size" class="tf-check tf-check-size"
                                                    value="XL" id="XL">
                                                <label for="XL"
                                                    class="label"><span>XL</span>&nbsp;<span>(6)</span></label>
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                    </div>

                </div>
                <div class="tf-shop-content wrapper-control-shop">
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text"></div>
                        <div id="product-count-list" class="count-text"></div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters" style="display: none;">Remove All <i
                                class="icon icon-close"></i></button>
                    </div>
                    @include('partials.product.product_list_layout')
                    @include('partials.product.product_grid_layout')
                   
                </div>
            </div>
        </div>
</section>

<div class="btn-sidebar-mobile start-0 filterShop">
    <button class="type-hover">
        <i class="icon-open"></i>
        <span class="fw-5">Open Filter</span>
    </button>
</div>
<div class="overlay-filter" id="overlay-filter"></div>

