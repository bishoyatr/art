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
    @if($grand_parent_id[0]->parent_id)
    <a href="{{route('otherCategories.index',$grand_parent_id[0]->parent_id)}}" type="button" class="btn btn-info"> <- Back </a>
    @else
    <a href="{{route('category.index')}}" type="button" class="btn btn-info"> <- Back </a>
    @endif
    <a href="{{route('otherOldAttachments.create',$parent_id)}}" type="button" class="btn btn-info">Create Old Attachment </a>
</div>

<table  class="table table-hover pt-0 mt-0" >
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
    @foreach($attachments as $attachment)
             <tr>
            <th scope="row">{{$attachment->id}}</th>
            <th scope="row">{{$attachment->title}}</th>
            <th scope="row"><a href="{{$attachment->youtube}}">{{$attachment->youtube}}</a></th>

            <td>
                @if($attachment->is_active==1)
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
                        $type = \App\Models\Type::find($attachment->type);
                    @endphp
                        <span class="label label-inline label-light-success font-weight-bold">{{$type->name}}</span>

            </td>
            <td>
                <a href="{{route('otherOldAttachments.edit',$attachment->id )}}" type="button" class="btn btn-info">edit</a>
                <a href="{{route('otherOldAttachments.single',$attachment->id )}}" type="button" class="btn btn-warning">show</a>
                <a href="{{route('otherOldAttachments.delete',$attachment->id )}}" type="button" class="btn btn-danger">delete</a>
            </td>


        </tr>
    @endforeach
    </tbody>
</table>
@endsection


