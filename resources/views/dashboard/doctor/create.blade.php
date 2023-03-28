@extends('layouts.app')
@section('content')
<div>
    <form method="POST" action="{{route('doctor.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 mt-3" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-50" id="exampleFormControlInput1" placeholder="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Email</label>
            <input type="text" name="email" class="form-control w-50" id="exampleFormControlInput1" placeholder="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="text" name="password" class="form-control w-50" id="exampleFormControlInput1" placeholder="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">national_id</label>
            <input type="text" name="national_id" class="form-control w-50" id="exampleFormControlInput1"
                placeholder="">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Pharmacy Name</label>
            <select name="pharmacy" class="form-control w-50">
                @foreach($pharmacies as $pharmacy)
                <option value="{{$pharmacy->id}}">{{$pharmacy->name}}</option>
                @endforeach
            </select>
        </div>
        <label class="form-check-label">avatar image</label>
        <input class="form-control w-50" type="file" id="formFile" name="avatar_image">
        <br>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection