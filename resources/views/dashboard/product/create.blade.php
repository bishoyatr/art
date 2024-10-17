@extends('index')

@section('content')

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">create product </h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('product.store',$categories->id)}}">
                <div class="card-body">
                  <div class="form-group">
                        <label for="exampleSelect1">name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{old('name')}}" id="example-date-input"/>
                         @error('name')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <div class="form-group">
                        <label for="exampleSelect1">category
                            <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" id="exampleSelect1">
                               <option @if(old('category_id')==$categories->id) selected @endif
                               value="{{$categories->id}}">{{ $categories->name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">status
                            <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-control" id="exampleSelect1">
                            <option @if(old('is_active')===1) selected @endif value="1">active</option>
                            <option @if(old('is_active')===0)selected @endif value="0">disable</option>
                        </select>
                    </div>
                      @error('is_active')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                        <div class="form-group">

                        <label for="exampleSelect1">category type
                            <span class="text-danger">*</span></label>
                        <select name="product_status" class="form-control" id="exampleSelect1">
                            {{-- @foreach(\App\Models\Type::all() as $item) --}}
                                <option @if(old('category_type')=== $categories->category_type) selected @endif value="{{$categories->category_type}}">{{$types->name}}</option>
                            {{-- @endforeach --}}
                          
                        </select>
                         @error('product_status')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">packaging type
                            <span class="text-danger">*</span></label>
                        <select name="packaging_status" class="form-control" id="exampleSelect1">
                            <option @if(old('packaging_status')==1) selected @endif value="1">current</option>
                            <option @if(old('packaging_status')==0)selected @endif value="0">history</option>
                            <option value="">current&history</option>
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
