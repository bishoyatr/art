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
<a href="{{route('productline.create',[$product->id,$product->product_status])}}" type="button" class="btn btn-success">
    create</a>
<table  class="table table-hover pt-0 mt-0" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">parent name</th>
            <th scope="col">status</th>
            <th scope="col">product line type</th>
            <th scope="col">add product line attachment</th>
            <th scope="col">show product line attachment</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
        </tr>
    </thead>
    <tbody>
      
    @foreach($products_lines as $products_line)
   
             <tr>
            <th scope="row">{{$products_line->id}}</th>
            <th scope="row">{{$products_line->name}}</th>
                 <td >{{$products_line->product->name}}</td>

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
                @if($products_line->product_line_status===1)
                <span class="label label-inline label-light-success font-weight-bold">
                    packaging
                </span>
                @elseif($products_line->product_line_status===0)
                <span class="label label-inline label-light-warning font-weight-bold">
                    visibility
                </span>
                @elseif($products_line->product_line_status==null)
                    <span class="label label-inline label-light-info font-weight-bold">
                    packaging&visibility
                </span>
                 @endif
            </td>

            <td><a href="{{route('productline.add_attachment',$products_line->id)}}" type="button" class="btn btn-success">add
                    current attachment
                </a>
            </td>
                 <td><a href="{{route('productline.show_current_attachment',$products_line->id)}}" type="button" class="btn
                 btn-success">show
                    current attachment
                </a>
            </td>
                 <td><a href="{{route('productline.edit',$products_line->id)}}" type="button" class="btn btn-warning">edit</a>
            </td>
            <td><a href="{{route('productline.destroy',$products_line->id)}}" type="button" class="btn btn-danger">delete</a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
@endsection


