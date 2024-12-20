@extends('layouts.frontendmaster')
@section('contend')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop Detail</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="{{asset('upload/products')}}/{{$shopDetails->image}}" class="img-fluid rounded" alt="Image">
                            </a>
                        </div>
                    </div>

                    {{-- shop Delails start--}}
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">{{$shopDetails->name}}</h4>
                        <p class="mb-3">Category: {{$shopDetails->category}}</p>
                        <h5 class="fw-bold mb-3">{{$shopDetails->price}} ৳</h5>
                        <div class="d-flex mb-4">
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>{{$shopDetails->description}}</p>

                        <form action="{{route('user.buy.product.details',$shopDetails->id)}}" method="POST">
                            @csrf
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="1" name="quantity">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                        </form>
                    </div>
                    {{-- shop Delails end--}}

                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>{{$shopDetails->description}}</p>

                                <div class="px-2">
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">{{$shopDetails->weight}} kg</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Country of Origin</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">{{$shopDetails->country_of_origin}}</p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Quality</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">{{$shopDetails->quality}}</p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Сheck</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">{{$shopDetails->check}}</p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Min Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">{{$shopDetails->min_weight}} Kg</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">

                                @foreach ($comments as $comment)

                                <div class="d-flex">
                                    <img src="{{asset('upload/profile')}}/{{$comment->userComment->image}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;"> {{ Carbon\Carbon::parse($comment->created_at)->format('F-d-Y') }}</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>{{$comment->userComment->name}} {{$comment->userComment->last_name}}</h5>
                                        </div>
                                        <p>{{$comment->review}}</p>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12 ">
                                    <div class="pagination d-flex  justify-content-center mt-5">
                                            {{$comments->links()}}
                                    </div>
                                </div>

                                {{-- <div class="d-flex">
                                    <img src="{{asset('frontend_asset')}}/img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Sam Peters</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div> --}}


                            </div>
                            <div class="tab-pane" id="nav-vision" role="tabpanel">
                                <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                    amet diam et eos labore. 3</p>
                                <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                    Clita erat ipsum et lorem et sit</p>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user())

                        @if (empty($comment->confirmation))
                            {{-- <p>Confirmation is empty.</p> --}}
                        @elseif ($comment->confirmation == 'complete')


                            <form action="{{route('comment',$comment->id)}}" method="POST">
                                @csrf
                                <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="text" class="form-control border-0 me-4 @error('name') is-invlid @enderror" placeholder="Yur Name *" name="name" value="{{Auth::user()->name}} {{Auth::user()->last_name}}" disabled>
                                            @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="email" class="form-control border-0 @error('email') is-invlid @enderror" placeholder="Your Email *" name="email" value="{{Auth::user()->email}}" disabled>
                                            @error('email')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea id="" class="form-control border-0 @error('review') is-invlid @enderror" cols="30" rows="8" placeholder="Your Review *" spellcheck="false" name="review"></textarea>
                                            @error('review')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            {{-- <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Please rate:</p>
                                                <div class="d-flex align-items-center" style="font-size: 12px;">
                                                    <i class="fa fa-star text-muted"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div> --}}
                                            <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        @endif
                    @endif
                </div>
            </div>


            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="input-group w-100 mx-auto d-flex mb-4">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                        <div class="mb-4">
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

                        <h4 class="mb-4">Featured products</h4>
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
        </div>
        <h1 class="fw-bold mb-0">Related products</h1>
        <div class="vesitable">
            <div class="owl-carousel vegetable-carousel justify-content-center">
                @foreach ($relateds as $related)
                <div class="col-md-6 col-lg-4 col-xl-12">
                        <a href="{{route('shop.details',$related->id)}}">
                        <div class="rounded position-relative fruite-item">
                            <div class="fruite-img">
                                <img src="{{asset('upload/products')}}/{{$related->image}}" class="img-fluid w-100 rounded-top" alt="" style="width: 200px; height:250px;">
                            </div>
                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom" style="height: 220px;">
                                <h4>{{$related->category}}</h4>
                                <p>{{Str::limit($related->description, '70') }}</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold mb-0">{{$related->price}} ৳ / kg</p>
                                    <a href="{{route('user.buy.product', $related->id)}}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->

@endsection


@section('script')
<script>
    @if(session('comment'))
        Toastify({
        text: "{{session('comment')}}",
        duration: 3000,
        destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){} // Callback after click
        }).showToast();
    @endif
</script>

@endsection
