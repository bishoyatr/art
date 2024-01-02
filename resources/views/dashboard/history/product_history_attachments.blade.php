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
<table  class="table table-hover pt-0 mt-0" >
    <a href="{{route('history.create_history_attachment',[$product_id,$type])}}" type="button" class="btn
          btn-info">create </a>

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">youtube</th>
            <th scope="col">status</th>
            <th scope="col">type</th>
            <th scope="col">actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($product_history_attachments as $product)
             <tr>
            <th scope="row">{{$product->id}}</th>
            <th scope="row">{{$product->title}}</th>
            <th scope="row"><a href="{{$product->youtube}}">{{$product->youtube}}</a></th>

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
                @if($product->type===1)
                <span class="label label-inline label-light-success font-weight-bold">
                    packaging
                </span>
                @elseif($product->type===0)
                <span class="label label-inline label-light-warning font-weight-bold">
                    visibility
                </span>
                @elseif($product->type==null)
                    <span class="label label-inline label-light-info font-weight-bold">
                    packaging&visibility
                </span>
                 @endif
            </td>
            <td><a href="{{route('history.edit_history_attachment',$product->id )}}" type="button"
                   class="btn
            btn-info">edit</a>
                 <a href="{{route('history.show_history_attachment',$product->id )}}" type="button"
                   class="btn
            btn-warning">show</a>
                <a href="{{route('history.delete_history_attachment',$product->id )}}" type="button"
                   class="btn btn-danger">delete</a>
            </td>


        </tr>
    @endforeach
    </tbody>
</table>
@endsection


