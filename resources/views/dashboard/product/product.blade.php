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
<a href="{{route('product.create',$category_id)}}" type="button" class="btn btn-info">create
                    product</a>
<table  class="table table-hover pt-0 mt-0" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">parent name</th>
            <th scope="col">status</th>
            <th scope="col">product type</th>
            <th scope="col">packaging type</th>
            <th scope="col">history</th>
            <th scope="col">product line</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
             <tr>
            <th scope="row">{{$product->id}}</th>
            <th scope="row">{{$product->name}}</th>
                 <td >{{$product->category->name}}</td>

            <td>
                @if($product->is_active==1)
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
                         $type = \App\Models\Type::find($product->product_status);
                     @endphp
                     @if($type)
                         <span class="label label-inline label-light-success font-weight-bold">
                                        {{$type->name}}
                                    </span>
                     @else
                         <span class="label label-inline label-light-info font-weight-bold">
                                            All
                                        </span>
                     @endif
            </td>
            <td>
                @if($product->packaging_status===1)
                <span class="label label-inline label-light-success font-weight-bold">
                    current
                </span>
                @elseif($product->packaging_status===0)
                <span class="label label-inline label-light-warning font-weight-bold">
                    history
                </span>
                @elseif($product->packaging_status==null)
                    <span class="label label-inline label-light-info font-weight-bold">
                    current&history
                </span>
                 @endif
            </td>
            @if($product->packaging_status===0)

            <td><a href="{{route('history.index',$product->id)}}" type="button" class="btn btn-info">history</a></td>
              <td> </td>
            @endif
                 @if($product->packaging_status===null)

            <td><a href="{{route('history.index',$product->id)}}" type="button" class="btn btn-info">history</a></td>
                 <td><a href="{{route('productline.index',[$product->id,$product->product_status])}}"
                   type="button"
                   class="btn btn-info">create product line </a>
            </td>
            @endif
             @if($product->packaging_status===1)
                    <td> </td>
            <td><a href="{{route('productline.index',[$product->id,$product->product_status])}}"
                   type="button"
                   class="btn btn-info">create product line </a>
            </td>
            @endif
            <td><a href="{{route('product.edit',$product->id)}}" type="button" class="btn btn-warning">edit</a>
            </td>
            <td><a href="{{route('product.destroy',$product->id)}}" type="button" class="btn btn-danger">delete</a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
@endsection


