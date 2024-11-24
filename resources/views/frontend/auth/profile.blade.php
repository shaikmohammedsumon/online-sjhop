@extends('layouts.frontendmaster')
@section('contend')
    <div class="row" style="margin-top:150px; padding:0 7%;">
        <div class="col-12">
            <div class="d-flex justify-content-between" style="border-bottom: 1px solid rgb(227, 227, 227); " >
                <div class="d-flex justify-items-center">
                    <div class="mt-1 ">
                        @if (Auth::user())
                            @if (Auth::user()->image == 'defualt.jpg')

                                <button style="border: none; background:none;" data-bs-toggle="modal" data-bs-target="#profilePic">
                                {{-- <i class="fas fa-search text-primary"></i> --}}
                                    <img src="{{asset('upload/defualt/defualt.jpg')}}" alt="" width="100px" height="100px">
                                </button>
                            @else
                                {{-- <button style="padding-right:10px; padding-bottom:10px; border: none; background:none;" ata-bs-toggle="modal" data-bs-target="#profilePic">
                                    <img src="{{ asset('upload/profile')}}/{{Auth::user()->image}}" alt=""  width="100px" height="100px" style="border-radius:5px; ">
                                </button> --}}

                                <button style="border: none; background:none;" data-bs-toggle="modal" data-bs-target="#profilePic" >
                                    {{-- <i class="fas fa-search text-primary"></i> --}}
                                    <div style="padding-right:10px; padding-bottom:10px;">

                                        <img src="{{asset('upload/profile')}}/{{Auth::user()->image}}" alt="" width="100px" height="100px" style=" border-radius:5px;">
                                    </div>
                                </button>
                            @endif
                        @else
                        <i class="fas fa-user fa-2x"> </i>
                        @endif
                    </div>
                    <div>
                        <h5>Name : {{Auth::user()->name}} {{Auth::user()->last_name}}</h5>
                        <h5>Email : {{Auth::user()->email}}</h5>
                        <h5>phone : {{Auth::user()->phone}}</h5>
                    </div>
                </div>
                <div>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="dropdown-item notify-item" type="submit">
                            <span>Logout</span>
                            <i class="fe-log-out"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Cart Page Start -->
<div class="container-fluid ">
    <div class="container ">
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
                    @forelse ($buyProduct_checkout as $buyProduct )
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
                                    <span style="padding: 0 10px;">{{$buyProduct->quantity}}</span>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{$buyProduct->total}} ৳</p>
                            </td>

                            <td>
                              <p  class="mb-0 mt-4">{{ ($buyProduct->processing == 'active') ? 'processing' : ''}}</p>
                            </td>
                        </tr>
                    @empty
                        <p style="color: red; text-align:center;">No Product</p>
                    @endforelse

                </tbody>
            </table>
        </div>


    </div>
    </div>
</div>
<!-- Cart Page End -->



    <div class="modal fade" id="profilePic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body d-flex align-items-center justify-content-center" style="height: 100%;">
                    <div class="input-group w-75 mx-auto d-flex justify-content-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mb-3">Profila Image Update form</h4>
                                    <form role="form" action="{{route('pforile.image.update')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Select Image</label>
                                            <div class="col-sm-9">
                                                <picture>
                                                    @if (Auth::user()->image == 'defualt.jpg')
                                                    <img id="port_image" src="{{asset('upload/defualt/defualt.jpg')}}" alt="" style="width:100%; height: 300px; object-fit:contain;">
                                                    @else
                                                    <img id="port_image" src="{{asset('upload/profile')}}/{{Auth::user()->image}}" alt="" style="width:100%; height: 300px; object-fit:contain;">
                                                    @endif
                                                </picture><br>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Chocse Profila Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" onchange="document.getElementById('port_image').src =window.URL.createObjectURL(this.files[0]) " class="form-control @error('image') is-invalid @enderror" id="inputEmail3" placeholder="image" name="image">

                                                @error('image')
                                                <p class="text-danger">{{ $message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="justify-content-end row">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
