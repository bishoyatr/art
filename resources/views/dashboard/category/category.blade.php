@extends('index')
@section('content')
    @if(Session::has('error'))
        <div class=" col-12 text-center mr-2 ml-2">
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
    <a href="{{route('category.create')}}" type="button" class="btn
                btn-danger">create category</a>
    </td>
    <table class="table table-hover pt-0 mt-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">status</th>
            <th scope="col">caregory type</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
            <th scope="col">create sub</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>
                    @if($category->is_active==1)
                        <span class="label label-inline label-light-success font-weight-bold">
                            active
                        </span>
                    @else
                        <span class="label label-inline label-light-danger font-weight-bold">
                            not active
                        </span>
                    @endif
                </td>
                <td>
                    @php
                        $type = \App\Models\Type::find($category->category_type);
                    @endphp
                    @if($type)
                        <span class="label label-inline label-light-success font-weight-bold">
                            {{$type->name}}
                        </span>
                    @endif 

                </td>
                @if($type && $type->process == 1)
                    <td><a href="{{route('category.edit',$category->id)}}" type="button" class="btn btn-warning">edit</a>
                    </td>
                    <td><a href="{{route('category.destroy',$category->id)}}" type="button"
                           class="btn btn-danger">delete</a>
                    </td>
                    <td><a href="{{route('subcategory.index',$category->id)}}" type="button" class="btn
                     btn-danger">create sub</a>
                    </td>
                @else
                    <td><a href="{{route('otherCategories.edit',$category->id)}}" type="button" class="btn btn-warning">edit</a>
                    </td>
                    <td><a href="{{route('otherCategories.destroy',$category->id)}}" type="button"
                           class="btn btn-danger">delete</a>
                    </td>
                    <td><a href="{{route('otherCategories.index',$category->id)}}" type="button" class="btn
                     btn-danger">create sub</a>
                    </td>
                
                @endif

            </tr>
        @endforeach
    </tbody>
</table>
@endsection


