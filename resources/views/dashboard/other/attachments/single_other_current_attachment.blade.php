@extends('index')

@section('content')
    <!--begin::Card-->

    <!--begin::Form-->
        <div class="col-md-6">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-body">

                        <input class="form-control" name="id" type="hidden" value="{{ $product_line->id }}"
                            id="example-date-input" />
                        <div class="form-group">
                            <label for="exampleSelect1">name
                                <span class="text-danger">*</span></label>
                            <input class="form-control" readonly name="name" type="text" value="{{ $product_line->name }}"
                                id="example-date-input" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">description
                                <span class="text-danger">*</span></label>
                            <textarea class="form-control" readonly name="description" type="text" id="example-date-input">{{ $product_line->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">image
                                <span class="text-danger">*</span></label>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @foreach (\App\Http\Resources\ProductLineCurrentDataResource::getImageResource($product_line->image) as $image)
                                @php
                                    if (is_array($image)) {
                                        $image = $image['image'];
                                    }
                                @endphp
                                <img width="300px" height="300px" src="{{ $image }}" />
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">pdf :
                                <span class="text-danger">*</span></label>
                            <a href="{{ $product_line->pdf }}">pdf</a>
                            <input class="form-control" readonly name="pdf_file" value="{{$product_line->pdf}}" type="text" id="example-date-input" />
                            @error('pdf_file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">youtube :
                                <span class="text-danger">*</span></label>
                            <a href="{{ $product_line->youtube }}">youtube</a>
                            <input class="form-control" readonly name="youtube" type="text" value="{{ $product_line->youtube }}"
                                id="example-date-input" />
                            @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">instagram :
                                <span class="text-danger">*</span></label>
                            <a href="{{ $product_line->instagram }}">instagram</a>
                            <input class="form-control" readonly name="instagram" type="text"
                                value="{{ $product_line->youtube }}" id="example-date-input" />
                            @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">facebook :
                                <span class="text-danger">*</span></label>
                            <a href="{{ $product_line->facebook }}">facebook</a>
                            <input class="form-control" readonly name="facebook" type="text"
                                value="{{ $product_line->facebook }}" id="example-date-input" />
                            @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">shop :
                                <span class="text-danger">*</span></label>
                            <a href="{{ $product_line->shop }}">shop</a>
                            <input class="form-control" readonly name="shop" type="text" value="{{ $product_line->shop }}"
                                id="example-date-input" />
                            @error('shop')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">product line type
                                <span class="text-danger">*</span></label>
                            <select name="product_line_attachment_status" class="form-control" id="exampleSelect1">
                                @foreach (\App\Models\Type::all() as $item)
                                    @if ($product_line->product_line_attachment_status === $item->id)
                                        <option selected value="{{ $item->id }}">
                                            {{ $item->name }}
                                    @endif
                                    </option>
                                @endforeach
x
                            </select>
                            @error('product_line_attachment_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">status
                                <span class="text-danger">*</span></label>
                            <select name="is_active" class="form-control" id="exampleSelect1">
                                @if ($product_line->is_active == 1)
                                    <option selected value="1">active</option>
                                @endif
                                @if ($product_line->is_active === 0)
                                    <option selected value="0">disable</option>
                                @endif
                            </select>
                            @csrf

                        </div>

                </div>

            </div>
            <!--end::Card-->

        </div>
    <!--end::Form-->
@endsection
@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/paginations.js') }}"></script>
    <!--end::Page Scripts-->
@endsection
