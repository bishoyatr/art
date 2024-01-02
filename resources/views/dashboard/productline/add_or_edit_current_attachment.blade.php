@extends('index')

@section('content')

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">create product line</h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('productline.store_attachment')}}" enctype="multipart/form-data">
                <div class="card-body">

                        <input class="form-control" name="product_line_id" type="hidden" value="{{$product_line->id}}"
                               />

                    <div class="form-group">
                        <label for="exampleSelect1">name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{old('name')}}" />
                         @error('name')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">description
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="description" type="text" value="{{old('description')}}" />
                         @error('description')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">image
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="photo" type="file" />
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
                        <input class="form-control" name="youtube" type="text" />
                         @error('youtube')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">instagram
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="instagram" type="text" />
                         @error('instagram')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">facebook
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="facebook" type="text" />
                         @error('facebook')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">shop
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="shop" type="text" />
                         @error('shop')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>

                    <div class="form-group">
                        <label for="exampleSelect1">status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            <option @if(old('is_active')==1) selected @endif value="1">active</option>
                            <option @if(old('is_active')==0)selected @endif value="0">disable</option>
                        </select>
                    </div>
                      @error('is_active')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                        <div class="form-group">
                        <label for="exampleSelect1">attachment type
                            <span class="text-danger">*</span></label>
                        <select name="product_line_attachment_status" class="form-control" id="exampleSelect1">
                            <option @if(old('product_line_attachment_status')==1) selected @endif value="1">packaging</option>
                            <option @if(old('product_line_attachment_status')==0)selected @endif value="0">visibility</option>
                        </select>
                             @error('product_line_attachment_status')
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
