@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Product</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/products" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <img class="img-preview img-fluid mb-3 col-sm-3">
                <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo"
                    name="photo" onchange="previewImage()">
                @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                    name="product_name" required autofocus value="{{ old('product_name') }}">
                @error('product_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="product_descriptions" class="form-label">Product Description</label>
                <input type="text" class="form-control @error('product_descriptions') is-invalid @enderror"
                    id="product_descriptions" name="product_descriptions"required autofocus
                    value="{{ old('product_descriptions') }}">
                @error('product_descriptions')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Product price</label>
                <input type="number" class="form-control @error('rice') is-invalid @enderror" id="price"
                    name="price"required autofocus value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#photo');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
