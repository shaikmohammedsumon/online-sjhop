@extends('layouts.dashboardmaster')

@section('contend')

<div class="row">

    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Category Update form</h4>

                <form role="form" action="{{route('category.update',$category->slug)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="title" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="title" name="title" value="{{$category->title}}">
                            @error('title')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="slug" class="form-control " id="inputEmail3" placeholder="slug" name="slug" value="{{$category->slug}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Select Image</label>
                        <div class="col-sm-9">
                            <picture>
                                <img id="port_image" src="{{asset('upload/category')}}/{{$category->image}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
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


