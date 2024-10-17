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

<div class="w-100 d-flex justify-content-between mb-10">
    @if($grand_parent[0]->parent_id)
    <a href="{{route('otherCategories.index',$grand_parent[0]->parent_id)}}" type="button" class="btn btn-info"> <- Back </a>
    @else
    <a href="{{route('category.index')}}" type="button" class="btn btn-info"> <- Back </a>
    @endif
    <a href="{{route('otherCurrentAttachments.create',$parent_id)}}" type="button" class="btn btn-success">
        Create Current Attachment</a>
</div>
    <table  class="table table-hover pt-0 mt-0" >
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">parent name</th>
                <th scope="col">status</th>
                <th scope="col">product line type</th>
                <th scope="col">Show Attachment</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach($attachments as $products_line)
                 <tr>
                <th scope="row">{{$products_line->id}}</th>
                <th scope="row">{{$products_line->name}}</th>
                     <td >{{$product->name}}</td>
    
                <td>
                    @if($products_line->is_active==1)
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
                         @php
                             $type = \App\Models\Type::find($products_line->product_line_attachment_status);
                         @endphp
                            <span class="label label-inline label-light-success font-weight-bold">
                                {{$type->name}}
                            </span>

                </td>
    

                <td><a href="{{route('otherCurrentAttachments.single',$products_line->id)}}" type="button" class="btn btn-success">Show
                    </a>
                </td>
                <td><a href="{{route('otherCurrentAttachments.edit',$products_line->id)}}" type="button" class="btn btn-warning">edit</a>
                </td>
                <td><a href="{{route('otherCurrentAttachments.delete',$products_line->id)}}" type="button" class="btn btn-danger">delete</a>
                </td>
    
            </tr>
        @endforeach
        </tbody>
    </table>
    
@endsection


