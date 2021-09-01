@extends('company.layout')
@section('content')
<section class="container-fluid">
    @if (!empty($data))
        <h1>Edit Employee</h1>
    @else
        <h1>Add New Employee</h1>
    @endif
    <a href="{{url('Companies')}}"><button type="button" class="btn btn-primary">Back </button><a>
</section>
    <form  @if (empty($data)) action = "{{route('EmployeeResources.store')}}" @else action = "{{route('EmployeeResources.update',$data)}}"
    @endif   method="post" enctype="multipart/form-data" id="addUserForm" >
        @csrf
        @if (!empty($data))
            @method('PUT')
        @endif
        <input type ="hidden"  name ="id"  id="adminUserId" value="{{$data['id'] ?? ''}}">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label"> First Name</label>
            <input type="text" name = "Fname" class="form-control" id="name" value="{{ old('firstName' , $data['firstName'] ?? '') }}" >
            @error('Fname')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputName" class="form-label"> Last Name</label>
            <input type="text" name = "Lname" class="form-control" id="name" value="{{ old('lastName' , $data['lastName'] ?? '') }}" >
            @error('Lname')
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
            <label for="exampleInputAddress" class="form-label">Phone</label>
            <input type="text" name= "phone" class="form-control" id="phone" value="{{ old('phone',$data['phone'] ?? '') }}">
            @error('phone')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputAddress" class="form-label">Select Company</label>
            <select name="company" class="form-control">
                @foreach($companyLists as $company)
                    <option value="{{ $company->id }}" >{{ $company->name }}</option>
                @endforeach    
            </select>
            @error('company')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div></br>
        <button type="submit" class="btn btn-primary addUser">Submit</button>
    </form>
    @endsection
