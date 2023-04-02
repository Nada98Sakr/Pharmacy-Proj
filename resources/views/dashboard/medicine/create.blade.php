@extends('layouts.app')
@section('content')
<div class="col-12">
    <form method="POST" action="{{route('medicine.store')}}" enctype="multipart/form-data" class="w-lg-50 mx-auto">
        @csrf

        <div class="mb-3 col-12">
            <label for="exampleFormControlInput0" class="form-label">Medicine Name</label>
            <input type="text" name="name" class="form-control w-100" id="exampleFormControlInput0" placeholder="Medicine Name" value="{{old('name')}}">
        </div>
        @error('name')
            <p class="text-danger mt-1">{{ $message }}</p>
        @enderror

        <div class="mb-3 col-12">
            <label for="exampleFormControlTextarea1" class="form-label">Medicine Type</label>
            <input type="text" name="type" class="form-control w-100" id="exampleFormControlInput1" placeholder="Medicine Type" value="{{old('type')}}">
            @error('type')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="exampleFormControlTextarea2" class="form-label">Medicine Price</label>
            <input type="Number" name="price" class="form-control w-100" id="exampleFormControlInput2" placeholder="Medicine Price" value="{{old('price')}}">
            @error('price')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>
</div>
@endsection