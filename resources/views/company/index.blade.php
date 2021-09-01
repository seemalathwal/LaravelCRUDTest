@extends('company.layout')
@section('content')
    <div class ="row">
        <div class = "col-lg-12 margin-tb">
            <div class = "pull-left">
                <h2>Companys Listing</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-success" href="{{url('Companies/create')}}">
                Add Company 
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
                <th>Name</th>
                <th>email</th>
                <th>website</th>
                <th>Logo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companyData as $companys)
                <tr>
                    <td>{{$companys->name}}</td>
                    <td>{{$companys->email}}</td>
                    <td>{{$companys->website}}</td> 
                    <td><img src= "{{ asset('storage/logo/'. $companys->logo)}}" width="50px" alt= "logo"/></td>
                    <td>
                        <a href="{{ route('Companies.edit',$companys) }}" style="float: left;">
                            <button type="button" class="btn btn-primary">Edit</button>
                        <a>&nbsp;
                        <form action="{{route('Companies.destroy',$companys)}}" method = "post" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick = "return confirm('Sure to Delete!!')">Delete</button>
                        </form>
                    </td> 
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$companyData->links('pagination::bootstrap-4')}}
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

    
