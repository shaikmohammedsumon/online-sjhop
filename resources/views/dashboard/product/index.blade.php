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
                                    <th>product Seller</th>
                                    <th>product Iamge</th>
                                    <th>product Name</th>
                                    <th> Category</th>
                                    <th>product Price</th>
                                    <th>product Category</th>
                                    <th>Status</th>
                                    <th>Fresh Organic</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <th scope="row">{{$loop->index +1}}</th>
                                    <td>{{$product->oneUser->name}}</td>
                                    <td>
                                        <img src="{{asset('upload/products/')}}/{{$product->image}}" alt="" style="border-radius: 5px;" width="70px" height="70px">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category}}</td>
                                    <td style="text-align: center;">{{$product->price}} <span>৳</span></td>

                                    <td>
                                        <form action="{{route('product.category',$product->id)}}" method="POST" id="product_category{{$product->id}}">
                                            @csrf
                                            <select
                                            class="@if($product->product_category == 'none') btn btn-danger
                                                    @elseif($product->product_category == 'vesitables') btn btn-success
                                                    @elseif($product->product_category == 'fruites') btn btn-warning
                                                    @endif"
                                            onchange="document.querySelector('#product_category{{$product->id}}').submit()" name="product_category" id="product_category">

                                            @if ($product->product_category == 'none')
                                                <option selected disabled>None</option>
                                                <option value="vesitables">Vesitables</option>
                                                <option value="fruites">Fruites</option>
                                                @elseif ($product->product_category == 'vesitables')
                                                <option selected disabled>Vesitables</option>
                                                <option value="fruites">Fruites</option>
                                                <option value="none">None</option>
                                                @elseif ($product->product_category == 'fruites')
                                                <option selected disabled>Fruites</option>
                                                <option value="vesitables"> Vesitables</option>
                                                <option value="none">None</option>
                                                @endif
                                            </select>

                                        </form>
                                    </td>

                                    <td>
                                        <a href="{{route('product.action',$product->name)}}" class="@if ($product->status == 'active') btn bg-success text-white @else btn bg-danger text-white @endif ">{{$product->status}}</a>
                                    </td>

                                    <td>
                                        <a href="{{route('product.fresh.organic.vegetables',$product->name)}}" class="@if ($product->resh_organic_vegetables == 'active') btn bg-success text-white @else btn bg-danger text-white @endif ">{{$product->resh_organic_vegetables}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-info"> <i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{route('products.destroy',$product->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i> </button>
                                        </form>
                                    </td>

                                </tr>
                                @empty

                                @endforelse
                                <div class="col-12 ">
                                    <div class="pagination d-flex  justify-content-center mt-5">
                                        {{$products->links()}}
                                    </div>
                                </div>

                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div>

    </div>
@endsection


@section('script')

<script>
    @if(session('created'))
        Toastify({
        text: "{{session('created')}}",
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
    @if(session('action'))
        Toastify({
        text: "{{session('action')}}",
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
    @if(session('update'))
        Toastify({
        text: "{{session('update')}}",
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
