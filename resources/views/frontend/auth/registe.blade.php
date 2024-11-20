@extends('layouts.frontendmaster')
@section('contend')


    <div class="row" style="margin-top: 100px;">
        <div class="col-5 container">
            <div class="mt-5">
                <h2 class="text-center mb-4 ">Register</h2>
                <form action="{{route('gest.register')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="firstName" placeholder="Enter your first name" style="border: 2px solid green;" name="name">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" placeholder="Enter your last name" style="border: 2px solid green;" name="last_name">
                            @error('last_name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phoneNumber" placeholder="Enter your phone number (+880)" style="border: 2px solid green;" name="phone">
                        @error('phone')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailAddress" placeholder="Enter your email address" style="border: 2px solid green;" name="email">
                        @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password @error('password') is-invalid @enderror" placeholder="Enter your password" style="border: 2px solid green;" name="password">
                            @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword @error('password_confirmation') is-invalid @enderror" placeholder="Confirm your password" style="border: 2px solid green;" name="password_confirmation">
                            @error('password_confirmation')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-11 d-flex align-items-center">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <p class="m-0">Already have an account? <a href="{{route('gest.login')}}">Login !!</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
