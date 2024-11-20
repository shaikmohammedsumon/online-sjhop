@extends('layouts.dashboardmaster')
@section('contend')


<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Name Update form your Current name is <span class="text-info">{{Auth::user()->name}}</span></h4>

                <form role="form" action="{{route('pforile.name.update')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name Update</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="type new name" name="name">
                            @error('name')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Password Update form</h4>

                <form role="form" action="{{route('pforile.password.update')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="inputEmail3" placeholder="Old Password" name="old_password">
                            @error('old_password')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputEmail3" placeholder="New Password" name="password">
                            @error('password')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputEmail3" placeholder="Confirm Password" name="password_confirmation">
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



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
                                <img id="port_image" src="{{asset('upload/defualt/defualt.jpg')}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
                                @else
                                <img id="port_image" src="{{asset('upload/profile')}}/{{Auth::user()->image}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
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


@endsection

@section('script')

<script>
    @if(session('name_update'))
        Toastify({
        text: "{{session('name_update')}}",
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
    @if(session('old_password'))
        Toastify({
        text: "{{session('old_password')}}",
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
