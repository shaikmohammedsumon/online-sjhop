@extends('layouts.frontendmaster')
@section('contend')



<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>

                <tbody>

                    @php
                        $totalSum = 0; // শুরুতে 0 দিয়ে ইনিশিয়ালাইজ
                    @endphp
                    @forelse ($buyProducts as $buyProduct )
                    @php
                        $totalSum += $buyProduct->total; // প্রতিটি $buyProduct->total যোগ করা
                    @endphp

                        <tr onclick="window.location.href='{{route('shop.details',$buyProduct->product_id)}}';" style="cursor: pointer;">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('upload/products') }}/{{$buyProduct->addCurtProduct->image}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{$buyProduct->addCurtProduct->name}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{$buyProduct->addCurtProduct->price}} ৳</p>
                            </td>

                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <form action="{{route('user.cart.buy.producd.quantity.down',$buyProduct->id,)}}" method="GET">
                                        @csrf
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <span style="padding: 0 10px;">{{$buyProduct->quantity}}</span>

                                    <form action="{{route('user.cart.buy.producd.quantity.up',$buyProduct->id,)}}" method="GET">
                                        @csrf
                                        {{-- <input type="text" class="form-control form-control-sm text-center border-0" name="quantity" value="{{$buyProduct->quantity}}"> --}}

                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" >
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{$buyProduct->total}} ৳</p>
                            </td>

                            <td>
                                <form action="{{route('user.cart.buy.producd.delete',$buyProduct->id)}}" method="GET">
                                    @csrf
                                    <button class="btn btn-md rounded-circle bg-light border mt-4" type="submit">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>


                    @empty
                        <p style="color: red; text-align:center;">No Product</p>
                    @endforelse



                </tbody>
            </table>
        </div>



        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">{{ $totalSum }} ৳</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: 60 ৳</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        @php
                            $totalSumCust = 0;
                            $totalSumCust += $totalSum + 60;
                        @endphp
                        <p class="mb-0 pe-4">{{$totalSumCust}} ৳</p>
                    </div>
                    <a href="{{route('checkout.index')}}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->

@endsection


@section('script')
    <script>
        @if(session('add_cart'))
            Toastify({
            text: "{{session('add_cart')}}",
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

    <script>
        @if(session('delete'))
            Toastify({
            text: "{{session('delete')}}",
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
    <script>
        @if(session('bySeccess'))
            Toastify({
            text: "{{session('bySeccess')}}",
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
