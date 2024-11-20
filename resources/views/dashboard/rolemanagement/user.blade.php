@extends('layouts.dashboardmaster')

@section('contend')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Table head options</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>user Image</th>
                                    <th>user Name</th>
                                    <th>user Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                @if ($user->id == Auth::user()->id)
                                    @continue
                                @endif
                                <tr>
                                    <th scope="row">{{$loop->index +1}}</th>
                                    <td>
                                        @if ($user->image == 'defualt.jpg')
                                        <img id="port_image" src="{{asset('upload/defualt/defualt.jpg')}}"  alt="" style="width: 70px !important; height: 70px !important; object-fit: contain; border-radius: 5px;">
                                        @else
                                        <img id="port_image" src="{{asset('upload/profile')}}/{{$user->image}}"  alt="" style="width: 70px !important; height: 70px !important; object-fit: contain; border-radius: 5px;">
                                        @endif
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <form action="{{route('user.role',$user->id)}}" method="POST"  id="pass_blogger_id{{$user->id}}">
                                            @csrf
                                            <select onchange="document.querySelector('#pass_blogger_id{{$user->id}}').submit()" name="role" id="" class="btn btn-info" style="border: none;">
                                                <option value="{{$user->role}}">{{$user->role}}</option>
                                                <option value="maneger">Maneger</option>
                                                <option value="seller">Seller</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        {{-- <a href="" class="btn btn-info"> <i class="fa-solid fa-pen-to-square"></i></a> --}}
                                        <a href="" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <p class="text-danger"> no Data found</p>
                                @endforelse
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
    @if(session('role_update'))
        Toastify({
        text: "{{session('role_update')}}",
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
