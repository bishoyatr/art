@extends('index')

@section('content')

@if(Session::has('error'))
    <div class=" col-12 text-center mr-2 ml-2" >
            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                    id="type-error">{{Session::get('error')}}
            </button>
    </div>
@endif
@if(Session::has('success'))
    <div class=" col-12 text-center mr-2 ml-2">
            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                    id="type-error">{{Session::get('success')}}
            </button>
    </div>
@endif

    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">

                <h3 class="card-title"> Send Notification </h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{route('notification.send')}}" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                        <label for="exampleSelect1"> Notification By :</label>
                        <input required class="form-control" name="name" type="text" id="example-date-input"/>
                </div>
                    <div class="form-group">
                        <label for="exampleSelect1"> Notification Body </label>
                        <input required class="form-control" name="description" type="text" id="example-date-input"/>
                    </div>
                        <div class="form-group">
                        <label for="exampleSelect1"> Image </label>
                        <input required type="file" class="form-control" name="image" id="example-date-input">
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
