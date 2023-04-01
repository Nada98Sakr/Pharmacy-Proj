@extends('layouts.app')
@section('content')
<div>
    <form method="POST" action="{{route('area.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Name" value="{{old('name')}}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
            <input type="text" name="address" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address" value="{{old('address')}}">
            @error('address')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection