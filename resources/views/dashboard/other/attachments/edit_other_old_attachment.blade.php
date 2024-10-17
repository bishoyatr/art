@extends('index')

@section('content')

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">edit history attachment</h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('otherOldAttachments.update',$history->id)}}" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                      <input class="form-control" name="history_id" type="hidden" value="{{$history->id}}"
                             id="example-date-input"/>
                      <input class="form-control" name="product_id" type="hidden" value="{{$history->product_id}}"
                             id="example-date-input"/>
                      <input class="form-control" name="type" type="hidden" value="{{$history->type}}" id="example-date-input"/>
                        <label for="exampleSelect1">title
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="title" type="text" value="{{$history->title}}"
                               id="example-date-input"/>
                         @error('title')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">youtube
                            <span class="text-danger">*</span></label>
                        <input class="form-control"  name="youtube" type="text" value="{{$history->youtube}}"
                               id="example-date-input"/>
                         @error('youtube')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">images
                            <span class="text-danger">*</span></label>
                        <input class="form-control"  multiple accept="image/*" name="history_images[]" type="file" id="example-date-input"/>
                         @error('history_images')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            <option @if($history->is_active==1) selected @endif value="1">active</option>
                            <option @if($history->is_active==0)selected @endif value="0">disable</option>
                        </select>
                    </div>
                      @error('is_active')
                         <span class="text-danger">{{$message}}</span>
                         @enderror

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
