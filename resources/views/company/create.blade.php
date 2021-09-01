@extends('company.layout')
@section('content')
    <section class="container-fluid">
        @if (!empty($data))
            <h1>Edit Company </h1>
        @else
            <h1>Add New Company</h1>
        @endif
        <a href="{{url('Companies')}}"><button type="button" class="btn btn-primary">Back </button><a>
    </section>
    <form  @if (empty($data)) action = "{{route('Companies.store')}}" @else action = "{{route('Companies.update',$data)}}"
        @endif   method="post" enctype="multipart/form-data" id="addUserForm" >
        @csrf
        @if (!empty($data))
            @method('PUT')
        @endif
        <input type ="hidden"  name ="id"  id="adminUserId" value="{{$data['id'] ?? ''}}">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" name = "name" class="form-control" id="name" value="{{ old('name' , $data['name'] ?? '') }}" >
            @error('name')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Email address</label>
            <input type="email" name = "email" class="form-control" id="email" value= "{{old('email',$data['email'] ?? '')}}" aria-describedby="emailHelp">
            @error('email')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputAddress" class="form-label">Website</label>
            <input type="text" name= "website" class="form-control" id="website" value="{{ old('website',$data['website'] ?? '') }}">
            @error('website')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleImage" class="form-label">Upload Logo</label>
            <input type="file" name= "logo" class="form-control" >
            @error('logo')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div></br>
        <button type="submit" class="btn btn-primary addUser">Submit</button>
    </form>
@endsection
