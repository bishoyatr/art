@extends('index')

@section('content')
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">update year title </h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('history.update',$year_title->id)}}">
                <div class="card-body">
                  <div class="form-group">
                        <label for="exampleSelect1">Update year title
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" name="title" type="text" value="{{$year_title->title}}"
                               id="example-date-input"/>
                  </div>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="description"  value="..." id="example-date-input"/>
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            <option @if($year_title->is_active==1) selected @endif value="1">active</option>
                            <option @if($year_title->is_active==0)selected @endif value="0">disable</option>
                        </select>
                    </div>
                        <div class="form-group">
                            {{-- {{print_r($product->product_status)}} --}}
                        <label for="exampleSelect1">category type
                            <span class="text-danger">*</span></label>
                        <select name="type" class="form-control" id="exampleSelect1">
                            <option selected value="{{$year_title->type}}">{{$type->name}}</option>
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
