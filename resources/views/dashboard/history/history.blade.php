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
         <?php
        
         if($products->isEmpty()){  ?>  <a href="{{route('history.create',$product_id)}}" type="button" class="btn btn-info">create </a> <?php }  ?>

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">year title</th>
            <th scope="col">status</th>
            <th scope="col">type</th>
            <th scope="col">add history attachment</th>
<?php if($products->isEmpty()){ ?> <th scope="col">edit</th><?php }  ?>

            <th scope="col">delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
             <tr>
            <th scope="row">{{$product->id}}</th>
            <th scope="row">{{$product->title}}</th>

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
            <td><a href="{{route('history.add_history_attachment',[$product->product_id,$product->type] )}}" type="button"
                   class="btn
            btn-info">add history
                    attchment</a>
            </td>
            <?php if(!empty($products)){ ?>    <td> <a  type="button"
                   class="btn
            btn-success"  href="{{route('history.create',$product_id)}}" type="button" >edit </a>
            </td><?php }  ?>
            <td><a href="{{route('history.deleteYeartitle',[$product->id,$product->type] )}}"
                   type="button"
                   class="btn
            btn-danger">delete</a>
            </td>


        </tr>
    @endforeach
    </tbody>
</table>
@endsection


