@extends('index')

@section('content')

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">create product line</h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('productline.update',$product_line->id)}}">
                <div class="card-body">
                  <div class="form-group">
                        <label for="exampleSelect1">name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{$product_line->name}}"
                               id="example-date-input"/>
                         @error('name')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">product
                            <span class="text-danger">*</span></label>
                        <select name="product_id" class="form-control" id="exampleSelect1">
                            @foreach($products as $product)
                               <option @if($product_line->product_id==$product->id) selected @endif
                               value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
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
                        <div class="form-group">
                        <label for="exampleSelect1">product line type
                            <span class="text-danger">*</span></label>
                        <select name="product_line_status" class="form-control" id="exampleSelect1">
                            <option @if($product_line->product_line_status===1) selected @endif
                            value="1">packaging</option>
                            <option @if($product_line->product_line_status===0)selected @endif
                            value="0">visibility</option>
                            <option @if($product_line->product_line_status===null)selected @endif
                                                                                       value="">packaging&visibility</option>
                        </select>
                             @error('product_line_status')
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
