@extends('Employee.layout')
@section('content')
    <div class ="row">
        <div class = "col-lg-12 margin-tb">
            <div class = "pull-left">
                <h2>Employees Listing</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-success" href="{{url('EmployeeResources/create')}}">
                Add Employee 
            </a>
        </div>
    </div>
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    @if($message = Session::get('fail'))
        <div class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
    @endif
    <table class="table table-striped" id ="userList"> 
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($Data as $employee)
            <tr>
                <td>{{$employee->firstName}}</td>
                <td>{{$employee->lastName}}</td>
                <td>{{$employee->company->name}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->phone}}</td> 
                <td>
                    <a href="{{ route('EmployeeResources.edit',$employee) }}" style="float: left;">
                        <button type="button" class="btn btn-primary">Edit</button>
                    <a>&nbsp;
                    <form action="{{route('EmployeeResources.destroy',$employee)}}" method = "post" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick = "return confirm('Sure to Delete!!')">Delete</button>
                    </form>
                </td> 
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$Data->links('pagination::bootstrap-4')}}
    
@endsection()
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function(){
                $("div.alert").remove();
            }, 3000 ); // 3 secs
        });
    </script>
@endpush

    
