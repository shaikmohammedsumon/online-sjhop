@extends('layouts.dashboardmaster')

@section('contend')

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Table head options</h4>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>Category Iamge</th>
                                <th>Category title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categorys as $category)
                            <tr>
                                <th scope="row">{{$loop->index +1}}</th>
                                <td>
                                    <img src="{{asset('upload/category/')}}/{{$category->image}}" alt="" style="border-radius: 5px;" width="70px" height="70px">
                                </td>
                                <td>{{$category->title}}</td>
                                <td>
                                    <a href="{{route('category.action',$category->slug)}}" class="@if ($category->status == 'active') btn bg-success text-white @else btn bg-danger text-white @endif ">{{$category->status}}</a>
                                </td>
                                <td>
                                    <a href="{{route('category.edit',$category->slug)}}" class="btn btn-info"> <i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('category.delete',$category->slug)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>

                            </tr>
                            @empty

                            @endforelse


                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>


    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Horizontal form</h4>

                <form role="form" action="{{route('category.created')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="title" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="title" name="title">
                            @error('title')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="slug" class="form-control " id="inputEmail3" placeholder="slug" name="slug">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Select Image</label>
                        <div class="col-sm-9">
                            <picture>
                                <img id="port_image" src="{{asset('upload/defualt/defualt.jpg')}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
                            </picture><br>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Image</label>
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


@endsection

