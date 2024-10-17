@extends('index')
@section('content')
@if(Session::has('error'))
    <div class=" col-12 text-center mr-2 ml-2" >
            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                    id="type-error">{{Session::get('error')}}
            </button>
    </div>
@endif
@if(Session::has('success'))
    <div class=" col-12 text-center mr-2 ml-2">
            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                    id="type-error">{{Session::get('success')}}
            </button>
    </div>
@endif
<a href="{{route('users.create')}}" type="button" class="btn
                 btn-danger">create User</a>
            </td>
<table  class="table table-hover pt-0 mt-0" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">pdf allowed</th>
            <th scope="col">is active</th>

        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
             <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>{{$category->pdf_allowed}}</td>
            <td>{{$category->is_active}}</td>

            <td><a href="{{route('users.edit',$category->id)}}" type="button" class="btn btn-warning">edit</a>
            </td>
            <td><a href="{{route('users.destroy',$category->id)}}" type="button" class="btn btn-danger">delete</a>


        </tr>
    @endforeach
    </tbody>
</table>
@endsection


