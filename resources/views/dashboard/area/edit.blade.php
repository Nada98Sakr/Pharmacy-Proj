@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Areas</h1>
    <form method="POST" action="{{route('area.update',$area->id)}}" class="w-lg-50 mx-auto">
        @csrf
        @method('put')
        <div class="mb-3 mt-3">
            <label for="areaName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-100" id="areaName" placeholder="Area name"  value="{{ old('name', $area->name) }}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="areaAddress" class="form-label">Address</label>
            <input type="text" name="address" class="form-control w-100" id="areaAddress" placeholder="Adreess" value="{{ old('address', $area->address) }}">
            @error('address')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="areaCountry" class="form-label">country</label>
            <select name="country_id" class="js-example-basic-single js-states form-control w-100" id="creator">
                @foreach($countries as $country)
                <option value="{{$country->id}}" {{ old('country_id',  $area->country_id) == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                @endforeach
            </select>
            @error('country_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {    
$(".js-example-basic-single").select2();
});
</script>
@endsection