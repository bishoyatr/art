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
<a href="{{route('subcategory.create',$parent_id)}}" type="button" class="btn
                 btn-danger">create sub</a>
            </td>
<table  class="table table-hover pt-0 mt-0" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">parent name</th>
            <th scope="col">status</th>
            <th scope="col">caregory type</th>
            <th scope="col">create product</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
             <tr>
            <th scope="row">{{$category->id}}</th>
            <th scope="row">{{$category->name}}</th>
                @if($category->parentCategory) <td >{{$category->parentCategory->name}}</td>
                 @else
                    <td >no parent </td>
                 @endif


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
                @if($category->category_type===1)
                <span class="label label-inline label-light-success font-weight-bold">
                    packaging
                </span>
                @elseif($category->category_type===0)
                <span class="label label-inline label-light-warning font-weight-bold">
                    visibility
                </span>
                @elseif($category->category_type==null)
                    <span class="label label-inline label-light-info font-weight-bold">
                    packaging&visibility
                </span>
                 @endif
            </td>
            <td><a href="{{route('product.index',$category->id)}}" type="button" class="btn btn-info">create
                    product</a>
            </td>
            <td><a href="{{route('subcategory.edit',$category->id)}}" type="button" class="btn btn-warning">edit</a>
            </td>
            <td><a href="{{route('subcategory.destroy',$category->id)}}" type="button" class="btn btn-danger">delete</a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
@endsection


