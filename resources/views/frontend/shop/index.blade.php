@extends('layouts.frontendmaster')
@section('contend')

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <form action="{{route('shop.search')}}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                        <button type="submit" class="btn btn-outline-secondary p-3" id="search-icon-1">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Category :</label>
                                <form action="{{route('shop.fruitlist')}}" method="POST" id="fruitlist">
                                    @csrf
                                    <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                        onchange="document.querySelector('#fruitlist').submit()">

                                        @if (request()->routeIs('shop.fruitlist'))
                                            <option selected>{{$selects}}</option>
                                            @foreach ($categorys as $category)
                                                    <option value="{{$category->title}}"> {{$category->title}}</option>
                                            @endforeach
                                        @else
                                            <option  selected>Nothing</option>
                                            @foreach ($categorys as $category)
                                                    <option value="{{$category->title}}" > {{$category->title}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @foreach ($categorys as $category)
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="{{route('shop.category',$category->title)}}"><img src="{{asset('upload/category/')}}/{{$category->image}}" alt="" style="width: 20px; height:20px; border-radius:50%; margin-right:10px;" >{{$category->title}}</a>
                                                    <span>({{$category->oneProduct()->count()}})</span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                                    <div class="mb-3">
                                        <h4 class="mb-2">Price</h4>
                                        <form action="{{ route('shop.price') }}" method="GET" id="price_search">
                                            @csrf
                                            <input
                                                onchange="document.querySelector('#price_search').submit()"
                                                type="range"
                                                class="form-range w-100"
                                                id="rangeInput"
                                                name="rangeInput"
                                                min="10"
                                                max="1000"
                                                value="{{ isset($return_rangeInput) ? $return_rangeInput : 10 }}"
                                                oninput="amount.value = parseInt(rangeInput.value).toLocaleString('en-IN') + ' ৳'">
                                        </form>
                                        <output id="amount" name="amount" for="rangeInput">
                                            {{ isset($return_rangeInput) ? number_format($return_rangeInput, 0, '.', ',') . ' ৳' : '10 ৳' }}
                                        </output>
                                    </div>

                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Additional</h4>
                                        <div class="mb-2">
                                            <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Beverages">
                                            <label for="Categories-1"> Organic</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Beverages">
                                            <label for="Categories-2"> Fresh</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Beverages">
                                            <label for="Categories-3"> Sales</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" class="me-2" id="Categories-4" name="Categories-1" value="Beverages">
                                            <label for="Categories-4"> Discount</label>
                                        </div>
                                        <div class="mb-2">
                                            <input type="radio" class="me-2" id="Categories-5" name="Categories-1" value="Beverages">
                                            <label for="Categories-5"> Expired</label>
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="col-lg-12">
                                    <h4 class="mb-3">Featured products</h4>
                                    @foreach ($featured as $featuredes )
                                    <a href="{{route('shop.details',$featuredes->id)}}">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="{{asset('upload/products')}}/{{$featuredes->image}}" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">{{$featuredes->name}}</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">{{$featuredes->price}} ৳</h5>
                                                    {{-- <h5 class="text-danger text-decoration-line-through">4.11 $</h5> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach

                                    <div class="d-flex justify-content-center my-4">
                                        <a href="{{route('shop.index')}}" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="{{asset('frontend_asset')}}/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">

                                @forelse ($products as $product)

                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <a href="{{route('shop.details',$product->id)}}">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="{{asset('upload/products')}}/{{$product->image}}" class="img-fluid w-100 rounded-top" alt="" style="width: 200px; height:250px;">
                                        </div>
                                        @if ($product->product_category == 'none')
                                        @else
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$product->product_category }}</div>
                                        @endif
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom" style="height: 220px;">
                                            <h4>{{$product->category}}</h4>
                                            <p>{{Str::limit($product->description, '70') }}</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">{{$product->price}} ৳ / kg</p>
                                                <a href="{{route('user.buy.product', $product->id)}}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                @empty
                                    <p style="text-align: center; color:red;"> No Product Found!!</p>
                                @endforelse


                            <div class="col-12 ">
                                <div class="pagination d-flex  justify-content-center mt-5">
                                        {{$products->links()}}
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
