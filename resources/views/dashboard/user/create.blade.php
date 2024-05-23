@extends('index')

@section('content')

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">create category</h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('users.store')}}">
                <div class="card-body">
                  <div class="form-group">
                        <label for="exampleSelect1">name
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{old('name')}}" id="example-date-input"/>
                         @error('name')
                         <span class="text-danger">{{$message}}</span>
                         @enderror
                  </div>
                    <input name="avatar" value="product_line/default.png" hidden="">

                    <div class="form-group">
                        <label for="exampleSelect1">password
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="password" type="text"  id="example-date-input"/>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleSelect1">is Active
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="is_active" type="checkbox" value=1  id="example-date-input"/>
                        @error('is_active')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleSelect1">pdf allowed
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="pdf_allowed" type="checkbox"  value=1 id="example-date-input"/>
                        @error('pdf_allowed')
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
