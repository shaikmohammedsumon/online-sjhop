@extends('layouts.dashboardmaster')
@section('contend')
<div class="rod">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Table head options</h4>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>product Image</th>
                                <th>product Name</th>
                                <th>product quantity</th>
                                <th>product price</th>
                                <th>Total price</th>
                                <th>Show All Details</th>
                                <th>Confirmation</th>

                                {{-- <th>Total price</th>
                                <th>Order by Name</th>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>Town/City</th>
                                <th>Postcode/zip</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Description</th>
                                <th>Order Date</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($view_product_details as $view_product_detail )
                                <tr>
                                    {{-- <p>{{$view_product_detail->id}}</p> --}}
                                    @if (Auth::user()->role == 'seller')
                                        @if (Auth::user()->id == $view_product_detail->seler_id)
                                        <td>{{$loop->index+1}}</td>
                                        <td>
                                            <img src="{{asset('upload/products')}}/{{$view_product_detail->addCurtProduct->image}}" alt="" width="80px" height="80px">
                                        </td>
                                        <td>{{$view_product_detail->addCurtProduct->name}}</td>
                                        <td>{{$view_product_detail->quantity}}</td>
                                        <td>{{$view_product_detail->addCurtProduct->price}}</td>
                                        <td>{{$view_product_detail->total}}</td>
                                        {{-- <td>{{$view_product_detail->byproductUserDetails->phone}}</td> --}}
                                        <td>
                                            <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#showView{{$view_product_detail->id}}">
                                                <i class="fa-solid fa-street-view btn btn-light"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <form action="{{route('order.confirmation',$view_product_detail->id)}}" method="POST"  id="confirm{{$view_product_detail->id}}">
                                                @csrf
                                                <select onchange="document.querySelector('#confirm{{$view_product_detail->id}}').submit()" name="confirmation" id="" class="btn btn-info" style="border: none;">
                                                    <option value="{{$view_product_detail->confirmation}}">{{$view_product_detail->confirmation}}</option>
                                                    <option value="Only 7 days left for your product to be delivered">Only 7 days left for your product to be delivered</option>
                                                    <option value="Only 6 days left for your product to be delivered">Only 6 days left for your product to be delivered</option>
                                                    <option value="Only 5 days left for your product to be delivered">Only 5 days left for your product to be delivered</option>
                                                    <option value="Only 4 days left for your product to be delivered">Only 4 days left for your product to be delivered</option>
                                                    <option value="Only 3 days left for your product to be delivered">Only 3 days left for your product to be delivered</option>
                                                    <option value="Only 2 days left for your product to be delivered">Only 2 days left for your product to be delivered</option>
                                                    <option value="Only 1 days left for your product to be delivered">Only 1 days left for your product to be delivered</option>
                                                    <option value="Today receive your product">Today receive your product</option>
                                                    <option value="Complete">Complete</option>

                                                </select>
                                            </form>
                                        </td>
                                        @endif
                                    @else
                                        @if (Auth::user()->role == 'admin')
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                                <img src="{{asset('upload/products')}}/{{$view_product_detail->addCurtProduct->image}}" alt="" width="80px" height="80px">
                                            </td>
                                            <td>{{$view_product_detail->addCurtProduct->name}}</td>
                                            <td>{{$view_product_detail->quantity}}</td>
                                            <td>{{$view_product_detail->addCurtProduct->price}}</td>
                                            <td>{{$view_product_detail->total}}</td>
                                            {{-- <td>{{$view_product_detail->byproductUserDetails->phone}}</td> --}}
                                            <td>
                                                <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#showView{{$view_product_detail->id}}">
                                                    <i class="fa-solid fa-street-view btn btn-light"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <form action="{{route('order.confirmation',$view_product_detail->id)}}" method="POST"  id="confirm{{$view_product_detail->id}}">
                                                    @csrf
                                                    <select onchange="document.querySelector('#confirm{{$view_product_detail->id}}').submit()" name="confirmation" id="" class="btn btn-info trxt-left" style="border: none;">
                                                        <option value="{{$view_product_detail->confirmation}}">{{$view_product_detail->confirmation}}</option>
                                                        <option value="Only 7 days left for your product to be delivered">Only 7 days left for your product to be delivered</option>
                                                        <option value="Only 6 days left for your product to be delivered">Only 6 days left for your product to be delivered</option>
                                                        <option value="Only 5 days left for your product to be delivered">Only 5 days left for your product to be delivered</option>
                                                        <option value="Only 4 days left for your product to be delivered">Only 4 days left for your product to be delivered</option>
                                                        <option value="Only 3 days left for your product to be delivered">Only 3 days left for your product to be delivered</option>
                                                        <option value="Only 2 days left for your product to be delivered">Only 2 days left for your product to be delivered</option>
                                                        <option value="Only 1 days left for your product to be delivered">Only 1 days left for your product to be delivered</option>
                                                        <option value="Today receive your product">Today receive your product</option>
                                                        <option value="complete">Complete</option>
                                                    </select>
                                                </form>
                                            </td>

                                        @endif
                                    @endif
                                </tr>
                                <div class="modal fade" id="showView{{$view_product_detail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            {{-- <h5 class="modal-title" id="exampleModalLabel"> {{$blog->id}} - {{$blog->title}} </h5> --}}
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body d-flex ">
                                                <img src="{{asset('upload/products')}}/{{$view_product_detail->addCurtProduct->image}}" alt="" width="50%" height="550px">

                                                <div class="modal-body">
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Name :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->byUserFirstName}} {{$view_product_detail->byproductUserDetails->byUserLastName}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Company Name:</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->companyName}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Address :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->address}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Town / City :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->town_city}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Country :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->country}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>PostCode / Zip :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->postConde}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Phone :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->phone}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Prement Method :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->payment_method}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Email :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->email}}</p>
                                                    </div>
                                                    <div class="info-container" style="display: flex; gap: 20px; align-items: center; padding: 10px 0;">
                                                        <h4>Description :</h4>
                                                        <p>{{$view_product_detail->byproductUserDetails->description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>

</div>



@endsection
