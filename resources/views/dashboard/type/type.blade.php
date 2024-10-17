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
<a href="{{route('types.create')}}" type="button" class="btn
                 btn-danger">create type</a>
            </td>
<table  class="table table-hover pt-0 mt-0" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>

        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
             <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>

            <td><a href="{{route('types.edit',$category->id)}}" type="button" class="btn btn-warning">edit</a>
            </td>
            <td><a href="{{route('types.destroy',$category->id)}}" type="button" class="btn btn-danger">delete</a>


        </tr>
    @endforeach
    </tbody>
</table>
@endsection


