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
                <h3 class="card-title">edit sub category</h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('subcategory.update',$category->id)}}">
                <div class="card-body">
                  <div class="form-group">
                        <label for="exampleSelect1">name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{$category->name}}"
                               id="example-date-input"/>
                         @error('name')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">category
                            <span class="text-danger">*</span></label>
                        <select name="parent_id" class="form-control" id="exampleSelect1">
                            
                            @foreach($mainProducts as $parent_category)
                                <option @if($category->parent_id==$parent_category->cat_id) selected @endif
                                    value="{{$parent_category->cat_id}}"> {{$parent_category->cat_name}} -
                                        {{$parent_category->type_name}}
                                </option>
                            @endforeach
                            {{-- @foreach($childCategories as $cat) 
                                @if($cat->id == $parent_category->category_type)
                                {{$cat->name}}
                                @endif
                            @endforeach --}}
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleSelect1">status
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
                        <label for="exampleSelect1">category type
                            <span class="text-danger">*</span></label>
                        <select name="category_type" class="form-control" id="exampleSelect1">
                            @foreach($types as $item)
                                <option @if($category->category_type===$item->id) selected @endif value="{{$item->id}}">
                                    {{$item->name}}</option>
                            @endforeach

                            {{--                            <option @if($category->category_type===1) selected @endif value="1">packaging</option>--}}
{{--                            <option @if($category->category_type===0)selected @endif value="0">visibility</option>--}}
{{--                            <option @if($category->category_type===null)selected @endif--}}
{{--                            value="">packaging&visibility</option>--}}
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
