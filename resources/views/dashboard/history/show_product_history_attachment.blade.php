@extends('index')

@section('content')


        <!--begin::Card-->

            <!--begin::Form-->

                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">show  product line history attachment</h3>
            </div>
                            <form method="post" action="{{route('productline.store_attachment')}}" enctype="multipart/form-data">
                <div class="card-body">

                        <input class="form-control" name="product_line_id"  type="hidden" value="{{$history->id}}"
                               id="example-date-input"/>

                    <div class="form-group">
                        <label for="exampleSelect1">title
                            <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" readonly  type="text" value="{{$history->title}}"
                               id="example-date-input"/>

                  </div>
                  <label for="exampleSelect1">image
                            <span class="text-danger">*</span></label>
                        <div class="row col-md-12">
                    @foreach($images as $image)
                     <div class=" col-md-4">

                        <img width="300px" height="300px" src="{{asset("assets/images/").'/'.$image}}"/>
                  </div>
                    @endforeach
                        </div>


                    <div class="form-group mt-5">
                        <label for="exampleSelect1">youtube :
                            <span class="text-danger">*</span></label>
                         <a href="{{$history->youtube}}" >{{$history->youtube}}</a>
                  </div>

                 </div>

            </form>
       </div>
        <!--end::Card-->

    </div>
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
