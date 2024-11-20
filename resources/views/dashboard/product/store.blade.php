@extends('layouts.dashboardmaster')
@section('contend')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Products Store</h4>

                    <form role="form" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Product Category</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('category') is-invalid @enderror" name="category" >
                                    <option selected disabled>Select</option>
                                    @foreach ($categorys as $category)
                                        <option value="{{$category->title}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Product name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="name" name="name" value="{{old('name')}}">
                                @error('name')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Product Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="inputEmail3" placeholder="price" name="price" value="{{old('price')}}">
                                @error('price')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Selected Image</label>
                            <div class="col-sm-9">
                                <picture>
                                    <img id="port_image" src="{{asset('upload/defualt/defualt.jpg')}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
                                </picture><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Product Image</label>
                            <div class="col-sm-9">
                                <input type="file" onchange="document.getElementById('port_image').src =window.URL.createObjectURL(this.files[0]) " class="form-control @error('image') is-invalid @enderror" id="inputEmail3" placeholder="image" name="image" value="{{old('image')}}">
                                @error('image')
                                <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Product Description</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="inputEmail3" placeholder="description" name="description" rows="10">  {{old('description')}}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 mt-5">
                            <h1 for="inputEmail3" class="col-sm-3 col-form-label">Product Deteils</h1>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="mb-2 col-md-2">
                                        <label for="inputEmail4" class="form-label">Weight</label>
                                        <input type="number" class="form-control @error('weight') is-invalid @enderror" id="inputEmail4" placeholder="kg" name="weight" value="{{old('weight')}}">
                                        @error('weight')
                                            <p class="text-danger">{{ $message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2 col-md-3">
                                        <label for="inputPassword4" class="form-label">Country of Origin</label>
                                        <input type="text" class="form-control @error('country_of_origin') is-invalid @enderror" id="inputPassword4" placeholder="Address" name="country_of_origin" value="{{old('country_of_origin')}}">
                                        @error('country_of_origin')
                                            <p class="text-danger">{{ $message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2 col-md-2">
                                        <label for="inputPassword4" class="form-label">Quality</label>
                                        <input type="text" class="form-control @error('quality') is-invalid @enderror" id="inputPassword4" placeholder="Quality" name="quality" value="{{old('quality')}}">
                                        @error('quality')
                                            <p class="text-danger">{{ $message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2 col-md-2">
                                        <label for="inputPassword4" class="form-label">Сheck</label>
                                        <input type="text" class="form-control @error('check') is-invalid @enderror" id="inputPassword4" placeholder="Сheck" name="check" value="{{old('check')}}">
                                        @error('check')
                                            <p class="text-danger">{{ $message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2 col-md-2">
                                        <label for="inputPassword4" class="form-label">Min Weight</label>
                                        <input type="number" class="form-control @error('min_weight') is-invalid @enderror" id="inputPassword4" placeholder="kg" name="min_weight" value="{{old('min_weight')}}">
                                        @error('min_weight')
                                            <p class="text-danger">{{ $message}}</p>
                                        @enderror
                                    </div>
                                </div>
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



