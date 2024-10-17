@extends('index')
@section('content')
<h1 class="text-center w-100 text-info">Sub Category : {{$parent_category->name}} </h1>
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
    <a href="{{route('otherTypesSubCategories.create',$parent_category->id)}}" type="button" class="btn btn-danger"> Create Sub Category</a>
            
<table  class="table table-hover pt-0 mt-0" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Parent Name</th>
            <th scope="col">Status</th>
            <th scope="col">Category Type</th>
            <th scope="col">Old</th>
            <th scope="col">Current</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
            <tr>
            <th scope="row">{{$category->id}}</th>
            <th scope="row">{{$category->name}}</th>
            <td >{{$parent_category->name}}</td>
            <td>
                @if($category->is_active==1)
                <span class="label label-inline label-light-success font-weight-bold">
                    active
                </span>
                @else
                <span class="label label-inline label-light-danger font-weight-bold">
                    not active
                </span>
                @endif
            </td>
            <td>
                @foreach($types as $ty)
                    @if($category->category_type === $ty->id)
                        <span class="label label-inline label-light-success font-weight-bold">
                            {{$ty->name}}
                        </span>
                    @endif
                @endforeach
            </td>
            <td>
                <a href="{{route('otherTypesOldAttachments.index',$category->id)}}" type="button" class="btn btn-info"> Old </a>
            </td>
            <td>
                <a href="{{route('otherTypesCurrentAttachments.index',$category->id)}}" type="button" class="btn btn-info"> Current </a>
            </td>
            <td>
                <a href="{{route('otherTypesSubCategories.edit',$category->id)}}" type="button" class="btn btn-warning">Edit</a>
            </td>
            <td><a href="{{route('otherTypesSubCategories.delete',$category->id)}}" type="button" class="btn btn-danger">Delete</a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
@endsection


