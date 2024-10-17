@extends('index')

@section('content')

@if(Session::has('error'))
    <div class=" col-12 text-center mr-2 ml-2" >
            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                    id="type-error">{{Session::get('error')}}
            </button>
    </div>
@endif
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Edit Sub Category </h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('otherTypesSubCategories.update',$category->id)}}">
                <div class="card-body">
                <div class="form-group">
                        <label for="exampleSelect1"> Name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{$category->name}}" id="example-date-input"/>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Category <span class="text-danger">*</span></label>
                        <select name="parent_id" class="form-control" id="exampleSelect1">
                            
                            @foreach($parent_categories as $parent_category)
                                <option @if($category->parent_id==$parent_category->id) selected @endif
                                    value="{{$parent_category->id}}"> {{$parent_category->name}} -
                                        {{$parent_category->t_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1"> Status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            <option @if($category->is_active==1) selected @endif value="1">active</option>
                            <option @if($category->is_active==0)selected @endif value="0">disable</option>
                        </select>
                    </div>
                    @error('is_active')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                        <label for="exampleSelect1"> Category Type
                            <span class="text-danger">*</span></label>
                        <select name="category_type" class="form-control" id="exampleSelect1">
                            @foreach($types as $item)
                                <option @if($category->category_type===$item->id) selected @endif value="{{$item->id}}">
                                    {{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('category_type')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
            @csrf


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->

    </div>

@endsection
@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset("assets/js/pages/crud/datatables/basic/paginations.js")}}"></script>
    <!--end::Page Scripts-->
@endsection
