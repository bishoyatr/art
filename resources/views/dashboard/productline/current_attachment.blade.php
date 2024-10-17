@extends('index')

@section('content')


        <!--begin::Card-->

            <!--begin::Form-->
            @foreach($product_lines as $product_line)
                <div class="col-md-6">
                    <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">create product line current attachment</h3>
                <a href="{{route('productline.delete_current_attachment',$product_line->id)}}" class="btn btn-danger m-5">delete</a>
            </div>
                <div class="card-body">
            <form method="post" action="{{ $product_line->id ? route('productline.update_attachment') :  route('productline.store_attachment')}}" enctype="multipart/form-data">

                <input class="form-control" name="id"  type="hidden" value="{{$product_line->id}}" id="example-date-input"/>
                <div class="form-group">
                    <label for="exampleSelect1">name
                        <span class="text-danger">*</span></label>
                        <input class="form-control" name="name"   type="text" value="{{$product_line->name}}" id="example-date-input"/>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">description
                    <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" type="text" id="example-date-input">{{$product_line->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">image
                    <span class="text-danger">*</span></label>
                    <input class="form-control" name="photo[]" type="file" id="example-date-input" multiple/>
                        @error('photo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        @foreach(\App\Http\Resources\ProductLineCurrentDataResource::getImageResource($product_line->image) as $image)
                        @php
                        if(is_array($image))
                        {
                        $image=$image['image'];
                        }
                        @endphp
                        <img width="300px" height="300px" src="{{$image}}"/>
                        @endforeach
                </div>
                    <div class="form-group">
                        <label for="exampleSelect1">pdf :
                            <span class="text-danger">*</span></label>
                            <a  href="{{$product_line->pdf}}" >pdf</a>
                            <input class="form-control" name="pdf_file" type="file" id="example-date-input"/>
                        @error('pdf_file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror


                </div>
                    <div class="form-group">
                        <label for="exampleSelect1">youtube :
                            <span class="text-danger">*</span></label>
                        <a href="{{$product_line->youtube}}" >youtube</a>
                            <input class="form-control" name="youtube" type="text" value="{{$product_line->youtube}}" id="example-date-input"/>
                        @error('youtube')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="exampleSelect1">instagram :
                            <span class="text-danger">*</span></label>
                        <a href="{{$product_line->instagram}}" >instagram</a>
                            <input class="form-control" name="instagram" type="text" value="{{$product_line->youtube}}" id="example-date-input"/>
                        @error('youtube')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="exampleSelect1">instagram :
                            <span class="text-danger">*</span></label>
                        <a href="{{$product_line->instagram}}" >instagram</a>
                            <input class="form-control" name="instagram" type="text" value="{{$product_line->instagram}}" id="example-date-input"/>
                        @error('instagram')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="exampleSelect1">facebook :
                            <span class="text-danger">*</span></label>
                        <a href="{{$product_line->facebook}}" >facebook</a>
                            <input class="form-control" name="facebook" type="text" value="{{$product_line->facebook}}" id="example-date-input"/>
                        @error('facebook')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                        <label for="exampleSelect1">shop :
                            <span class="text-danger">*</span></label>
                         <a href="{{$product_line->shop}}" >shop</a>
                             <input class="form-control" name="shop" type="text" value="{{$product_line->shop}}" id="example-date-input"/>
                         @error('shop')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                     <div class="form-group">
                        <label for="exampleSelect1">product line type
                            <span class="text-danger">*</span></label>
                        <select name="product_line_attachment_status" class="form-control" id="exampleSelect1">
                            @foreach(\App\Models\Type::all() as $item)
                            @if($product_line->product_line_attachment_status===$item->id)
                                <option  selected value="{{$item->id}}">
                                    {{$item->name}}
                                    @endif 
                                </option>
                            @endforeach
{{--                            @if($product_line->product_line_attachment_status==1)--}}
{{--                            <option  selected  value="1">packaging</option>--}}
{{--                            @endif--}}
{{--                            @if($product_line->product_line_attachment_status===0)--}}
{{--                            <option selected  value="0">visibility</option>--}}
{{--                            @endif--}}
{{--                            @if($product_line->product_line_attachment_status===null)--}}
{{--                            <option selected   value="">packaging&visibility</option>--}}
{{--                           @endif--}}
                        </select>
                         @error('product_line_attachment_status')
                         <span class="text-danger">{{$message}}</span>
                         @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            @if($product_line->is_active==1)
                            <option  selected  value="1">active</option>
                            @endif
                            @if($product_line->is_active===0)
                            <option selected  value="0">disable</option>
                            @endif
                        </select>
              @csrf

                    </div>
 <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">edit</button>
                </div>
                               </form>
                 </div>

       </div>
        <!--end::Card-->

    </div>
            @endforeach
            <!--end::Form-->

@endsection
@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset("assets/js/pages/crud/datatables/basic/paginations.js")}}"></script>
    <!--end::Page Scripts-->
@endsection
