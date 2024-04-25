@extends('layouts.admin_app')
@section('content')
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        

<div class="kt-portlet kt-portlet--mobile">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Category
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
    <div class="kt-portlet__head-actions">
        <div class="dropdown dropdown-inline">
            
        </div>
        &nbsp;
        <a href="javascript:void(0)" class="btn btn-brand btn-elevate btn-icon-sm new-amaal" data-toggle="modal" data-target="#exampleModal">
            <i class="la la-plus"></i>
            New Record
        </a>
    </div>  
</div>      </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @if(count($amaal)>0)
                @php
                    $count=0;
                @endphp

                    @foreach($amaal as $amal)
                        @php $count++; @endphp
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$amal->name}}</td>
                            <td>
                                @if (!is_null($amal->icon))
                                    <img src="{!! asset("images/categories/$amal->icon") !!}" alt="Icon" class="edit_amal_icon" style="width:100px;padding: 0px;">
                                @endif
                        </td>
                            <td>{{$amal->description}}</td>
                            <td>
                                <a href="{{route('edit-amaal', $amal->id)}}">Edit</a> 
                                {{-- |
                                <a href="javascript:void(0)" data-id="{{$amal->id}}" class="delete_amal">Delete</a> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                        <tr>
                            <td colspan="6" style="text-align: center">No Record Found</td>
                        </tr>
                @endif
            </tbody>

        </table>
        <!--end: Datatable -->
    </div>
</div>  
    <!-- Modal POPUP -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="{{route('add-amaal')}}" method="POST" name="add-amaal" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row" style="padding: 5px;">
                    <div class="form-group" style="width: 100%">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="modal_name form-control modal_name" required>
                    </div>
                    <div class="form-group" style="width: 100%">
                        <label class="form-label">Icon</label>
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" required>
                              <label class="custom-file-label" for="inputGroupFile01">Choose Icon</label>
                            </div>
                          </div>
                        
                    </div> 
                    <div class="form-group" style="width: 100%">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="modal_desc form-control" rows="5" required></textarea>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
        </form>
      </div>
    </div>
</div>
    <!-- end:: Content -->
@endsection

@section('page_js')
	  <script src="{{asset('admin_assets/js/basic.js')}}" type="text/javascript"></script>
      <script type="text/javascript">
          $(".new-amaal").on('click',function(){
              $(".modal_name").val('');
              $(".modal_icon").val('');
              $(".modal_desc").val('');
          });

          $(".delete_amal").on('click',function(){
            /*alert($(this).data('id'));*/
            Swal.fire({
              title: 'Are you sure?',
              text: "Are you sure to delete amaal",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Delete'
            }).then((result) => {
               console.log(result);
               if (result.value==true) {
                var amal_id = $(this).data('id');
                $.ajax({
                    url: '{{route('delete-amal')}}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        amal_id : amal_id
                    },
                    success: function (data) {
                      if(data=='success'){
                        Swal.fire(
                          'Success!',
                          'Amaal deleted successfully',
                          'success'
                        );
                        setTimeout(function(){
                           window.location.reload();
                        }, 2000);
                      }
                      else{
                        
                      }
                       
                    }
                });
               } 
            });
          });
      </script>
@endsection
