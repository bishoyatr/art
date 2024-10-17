@extends('index')

@section('content')

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Edit product line</h3>
            </div>
            {{-- <a href="{{route('otherCurrentAttachments.update',$product_line->id)}}">click m</a> --}}
            <!--begin::Form-->
            <form method="post" action="{{route('otherCurrentAttachments.update',$product_line->id)}}" enctype="multipart/form-data">
            
                @csrf
                
                
                <div class="card-body">

                        <input class="form-control" name="id" type="hidden" value="{{$product_line->product_line_id}}" />

                    <div class="form-group">
                        <label for="exampleSelect1">name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{$product_line->name}}" />
                         @error('name')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">description
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="description" type="text" value="{{$product_line->description}}" />
                         @error('description')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">image
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="photo[]" type="file" multiple/>
                         @error('photo')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">pdf
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="pdf_file" type="file" />
                         @error('pdf_file')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">youtube
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="youtube" type="text" value="{{$product_line->youtube}}" />
                         @error('youtube')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">instagram
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="instagram" type="text" value="{{$product_line->instagram}}" />
                         @error('instagram')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">facebook
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="facebook" type="text" value="{{$product_line->facebook}}" />
                         @error('facebook')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">shop
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="shop" type="text" value="{{$product_line->shop}}" />
                         @error('shop')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>

                    <div class="form-group">
                        <label for="exampleSelect1">status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            <option @if($product_line->is_active==1) selected @endif value="1">active</option>
                            <option @if($product_line->is_active==0)selected @endif value="0">disable</option>
                        </select>
                    </div>
                      @error('is_active')
                         <span class="text-danger">{{$message}}</span>
                         @enderror

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
