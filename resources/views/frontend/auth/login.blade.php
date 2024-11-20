@extends('layouts.frontendmaster')
@section('contend')

    <div class="row" style="margin-top: 100px;">
        <div class="col-5 container">
            <div class="mt-5">
                <h2 class="text-center mb-4 ">Login</h2>
                <form action="{{route('gest.login')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailAddress" placeholder="Enter your email address" style="border: 2px solid green;" name="email" value="{{(session('email')) ? session('email') :  ''}}">
                        @error('email')
                                <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter your password" style="border: 2px solid green;" name="password" value="{{(session('password')) ? session('password') : '' }}">
                        @error('password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-11 d-flex align-items-center">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <p class="m-0">Don't have an account? <a href="{{route('gest.register')}}">Register !!</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
