@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/components/toggle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>

          <style>
              .checkbox{
                  height: 10px !important;
              }
          </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Roomcategory</h3>
                    @can('add-'.str_slug('RoomCategory'))
                        <a class="btn btn-success pull-right" href="{{ url('/roomcategory/room-category/create') }}"><i
                                    class="icon-plus"></i> Add Roomcategory</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Room Type</th><th>Slug</th><th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roomcategory as $item)
                                <tr>
                                    <td>{{ @$loop->iteration ?? @$item->id }}</td>
                                    <td>{{ @$item->room_type }}</td>
                                    <td>{{ @$item->slug }}</td>
                                    {{-- <td>{{ $item->status }}</td> --}}
                                    <td>
                                        <input data-id="{{@$item->id}}" class="toggle-class checkbox" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->status == 'active' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        @can('view-'.str_slug('RoomCategory'))
                                            <a href="{{ url('/roomcategory/room-category/' . @$item->id) }}"
                                               title="View RoomCategory">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('RoomCategory'))
                                            <a href="{{ url('/roomcategory/room-category/' . @$item->id . '/edit') }}"
                                               title="Edit RoomCategory">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('RoomCategory'))
                                           
                                                <button type="submit" class="btn btn-danger btn-sm room_type_delete_btn" data-id="{{ $item->id }}"
                                                        title="Delete RoomCategory"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                        
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $roomcategory->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/components/toggle/bootstrap-toggle.min.js')}}"></script>
    <script src="{{asset('plugins/components/sweetalert/sweetalert2.min.js')}}"></script>
    
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {

            @if(\Session::has('flash_message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('flash_message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif

            $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 'active' : 'inactive'; 
                    var room_id = $(this).data('id'); 
                    
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/room-status-change',
                        data: {'status': status, 'room_id': room_id},
                        success: function(data){
                        console.log(data.flash_message);
                       
                        $.toast({
                            heading: 'Success!',
                            position: 'top-center',
                            text: 'Status change successfully.',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3000,
                            stack: 1
                        });
                     
                        }
                    });
                })
            })
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });

        $(document).on("click", ".room_type_delete_btn", function() {

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                let _this = $(this);
                let id = _this.data('id');
                if (id != null) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('delete-room-type')}}/"+id,
                        data: {
                            // _token: "{{ csrf_token() }}",
                        },
                        cache: false,
                        dataType: "json",
                        success: function(response) {
                            if (response.success === true) {
                                Swal.fire(
                                'Deleted!',
                                'Room has been deleted.',
                                'success'
                                )
                            } else {
                                Swal.fire(
                                'Error!',
                                'Try again please!.',
                                'success'
                                )
                            }
                            $("#myTable").load(location.href + " #myTable");
                            console.log(response);
                            },
                            error: function(xhr) {
                                console.log("XHR", xhr);
                                Swal.fire(
                                'Error!',
                                'Try again please!.',
                                'success'
                                )

                            },
                        });
                }else{
                    alert("Select any type");
                }
            
            }
            });

        });
    </script>

@endpush
