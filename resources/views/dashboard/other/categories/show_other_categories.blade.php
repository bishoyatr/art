@extends('index')
@section('content')

<style>
    .dimmed{
        pointer-events: none;
        color: gray; 
    }
</style>

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

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Create
        </button>
        <ul class="dropdown-menu">
            
            
          <li><a class="dropdown-item @if($children_type == "old" || $children_type == 'current') dimmed @endif" href="{{route('otherSubCategories.create',$parent_id)}}">Create Folder</a></li>
          <li><a class="dropdown-item @if($children_type == "folder" || $children_type == 'current') dimmed @endif" href="{{route('otherOldAttachments.create',$parent_id)}}">Create Old Attachment</a></li>
          <li><a class="dropdown-item @if($children_type == "old" || $children_type == 'folder') dimmed @endif" href="{{route('otherCurrentAttachments.create',$parent_id)}}">Create Current Attachment</a></li>
        </ul>
      </div>
    
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
            @php
                $child_type = \App\Models\LinkOtherProcess::where('parent_id',$category->id)->first();
                if($child_type){
                    if($child_type->file_type == 'old'){
                    $show_subs_route = 'otherOldAttachments.index';
                }elseif($child_type->file_type == 'current'){
                    $show_subs_route = 'otherCurrentAttachments.index';
                }else{
                    $show_subs_route = 'otherCategories.index';
                }
                }else{
                    $show_subs_route = 'otherCategories.index';
                }
            @endphp
                <td><a href="{{route('otherCategories.edit',$category->id)}}" type="button" class="btn btn-warning">edit</a>
                </td>
                <td><a href="{{route('otherCategories.destroy',$category->id)}}" type="button" class="btn btn-danger">delete</a>
                </td>
                <td><a href="{{route($show_subs_route,$category->id)}}" type="button" class="btn btn-danger">Show Sub</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset("assets/js/bootstrap.bundle.min.js")}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    {{-- <script src="{{asset("assets/js/pages/crud/datatables/basic/paginations.js")}}"></script> --}}
    <!--end::Page Scripts-->
@endsection
