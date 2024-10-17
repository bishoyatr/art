@extends('index')

@section('content')

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Create Folder</h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('otherSubCategories.store',$parent_id)}}">
                <div class="card-body">
                    <input class="form-control" name="parent_id" type="hidden" value="{{$parent_id}}" id="example-date-input"/>
                    <input type="hidden" value="{{$parent->category_type}}" name="category_type" class="form-control" id="exampleSelect1" />

                  <div class="form-group">
                        <label for="exampleSelect1">name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" id="example-date-input"/>
                         @error('name')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            <option selected value="1">active</option>
                            <option value="0">disable</option>
                        </select>
                    </div>
                    @error('is_active')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        {{-- <div class="form-group">
                        <label for="exampleSelect1">category type
                            <span class="text-danger">*</span></label>
                        <select name="category_type" class="form-control" id="exampleSelect1">
                                <option selected value="{{$parent->id}}">{{$parent->name}}</option>
                        </select>

                             @error('category_type')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                    </div> --}}
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
