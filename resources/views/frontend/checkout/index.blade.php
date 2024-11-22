@extends('layouts.frontendmaster')
@section('contend')
       <!-- Checkout Page Start -->
       <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="{{route('chechout.confirm.product')}}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control @error('byUserFirstName') is-invalid @enderror" value="{{Auth::user()->name}}" name="byUserFirstName">
                                    @error('byUserFirstName')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control @error('byUserLastName') is-invalid @enderror" value="{{Auth::user()->last_name}}" name="byUserLastName">
                                     @error('byUserLastName')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Company Name<sup>*</sup></label>
                            <input type="text" class="form-control @error('companyName') is-invalid @enderror" placeholder="Optinal" name="companyName">
                             @error('companyName')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="House Number Street Name" name="address">
                             @error('address')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control @error('town_city') is-invalid @enderror" name="town_city">
                             @error('town_city')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="Bangladesh" disabled>
                             @error('country')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control @error('postConde') is-invalid @enderror" name="postConde"  placeholder="0000">
                             @error('postConde')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{Auth::user()->phone}}" name="phone">
                             @error('phone')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-item pb-4">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{Auth::user()->email}}" name="email">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-item">
                            <textarea  class="form-control @error('description') is-invalid @enderror" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)" name="description"></textarea>
                             @error('description')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalSum = 0; // শুরুতে 0 দিয়ে ইনিশিয়ালাইজ
                                        $add_to_carts_id = '';
                                    @endphp
                                    @forelse ($buyProducts as $buyProduct)
                                        @php
                                            $totalSum += $buyProduct->total; // প্রতিটি $buyProduct->total যোগ করা

                                            $add_to_carts_id = $buyProduct->id . ',' .$add_to_carts_id;
                                        @endphp
                                    <tr class="text-center">
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="{{ asset('upload/products') }}/{{$buyProduct->addCurtProduct->image}}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5 text-center">{{$buyProduct->addCurtProduct->name}}</td>
                                        <td class="py-5">{{$buyProduct->addCurtProduct->price}} ৳</td>
                                        <td class="py-5">{{$buyProduct->quantity}}</td>
                                        <td class="py-5">{{$buyProduct->total}} ৳</td>
                                    </tr>
                                    @empty
                                        <p style="color: red; text-align:center;">No Product</p>
                                    @endforelse


                                    <tr>
                                        <th scope="row">

                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-0">Delevery fee</p>
                                            <p class="mb-0 text-dark text-uppercase py-3">TOTAL </p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark text-center " >60 ৳</p>
                                                <p class="mb-0 text-dark text-center">{{$totalSum + 60}} ৳</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0 payment-checkbox @error('payment_method') is-invalid @enderror" id="Payments-1" name="payment_method" value="Cash On Delivery" onclick="onlyOne(this)">
                                    <label class="form-check-label" for="Payments-1">Cash On Delivery</label>
                                    @error('payment_method')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0 payment-checkbox @error('payment_method') is-invalid @enderror" id="Delivery-1" name="payment_method" value="Nagad" onclick="onlyOne(this)">
                                    <label class="form-check-label" for="Delivery-1">Nagad</label>
                                    @error('payment_method')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0 payment-checkbox @error('payment_method') is-invalid @enderror" id="Paypal-1" name="payment_method" value="Bkash" onclick="onlyOne(this)">
                                    <label class="form-check-label" for="Paypal-1">Bkash</label>
                                    @error('payment_method')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <script>
                            function onlyOne(checkbox) {
                                // সব checkbox আনচেক করুন
                                const checkboxes = document.querySelectorAll('.payment-checkbox');
                                checkboxes.forEach((item) => {
                                    if (item !== checkbox) item.checked = false;
                                });
                            }
                        </script>

                        <input type="hidden" name="byUser_Id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="addToCart_ID" value="{{$add_to_carts_id}}">

                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->

@endsection
