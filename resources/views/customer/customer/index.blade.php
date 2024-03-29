@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    {{-- <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/> --}}
          
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Customer</h3>
                    @can('add-'.str_slug('Customer'))
                        <a class="btn btn-success pull-right" href="{{ url('/customer/customer/create') }}"><i
                                    class="icon-plus"></i> Add Customer</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Country</th>
                                <th>CNIC</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer as $item)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->Country->name }}</td>
                                    <td>{{ $item->cnic }}</td>
                                    <td>
                                        @can('view-'.str_slug('Customer'))
                                            <a href="{{ url('/customer/customer/' . $item->id) }}"
                                               title="View Customer">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('Customer'))
                                            <a href="{{ url('/customer/customer/' . $item->id . '/edit') }}"
                                               title="Edit Customer">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Customer'))
                                           
                                                <button type="submit"  class="btn btn-danger btn-sm customer_delete_btn" data-id="{{ $item->id }}"
                                                        title="Delete Customer"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                     
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $customer->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
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
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });

        $(document).on("click", ".customer_delete_btn", function() {

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
                        url: "{{url('delete-customer')}}/"+id,
                        data: {
                            // _token: "{{ csrf_token() }}",
                        },
                        cache: false,
                        dataType: "json",
                        success: function(response) {
                            if (response.success === true) {
                                Swal.fire(
                                'Deleted!',
                                'Customer has been deleted.',
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
