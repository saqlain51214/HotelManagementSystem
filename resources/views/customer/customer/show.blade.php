@extends('layouts.master')
@push('css')
<style>
    hr.dashed {
        border-top: 3px dashed #bbb;
    }
    tr{
        box-shadow: 0px 3px 1px 2px #ccc;
    }
</style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Customer {{ $customer->id }}</h3>
                    @can('view-'.str_slug('Customer'))
                        <a class="btn btn-success pull-right" href="{{ url('/customer/customer') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                               
                            <tr>
                                <th>ID</th>
                                <td>{{ strtoupper($customer->id??'') }}</td>
                            </tr>
                           
                            <tr>
                                <th> First Name </th>
                                <td> {{  strtoupper($customer->first_name??'') }} </td>
                            </tr>
                           
                            <tr>
                                <th> Last Name </th>
                                <td> {{  strtoupper($customer->last_name??'') }} </td>
                            </tr>
                            <tr>
                                <th> Father Name </th>
                                <td> {{  strtoupper($customer->father_name??'') }} </td>
                            </tr>
                            
                            <tr>
                                <th> Customer Type </th>
                                <td> {{  strtoupper($customer->customer_type??'') }} </td>
                            </tr>
                            <tr>
                                <th> Customer Status </th>
                                <td> {{  strtoupper($customer->customer_status??'') }} </td>
                            </tr>
                            <tr>
                                <th> Gender </th>
                                <td> {{  strtoupper($customer->gender??'') }} </td>
                            </tr>
                            <tr>
                                <th> Country </th>
                                <td> {{  strtoupper($customer['Country']->name)??'' }} </td>
                            </tr>
                            <tr>
                                <th> Province </th>
                                <td> {{  strtoupper($customer['State']->name??'') }} </td>
                            </tr>
                            <tr>
                                <th> City </th>
                                <td> {{  strtoupper($customer['City']->name??'') }} </td>
                            </tr>
                            <tr>
                                <th> Phone Number </th>
                                <td> {{  strtoupper($customer->phone_code??'') }}{{  strtoupper($customer->cell_number)??'' }} </td>
                            </tr>
                            <tr>
                                <th> CNIC </th>
                                <td> {{  strtoupper($customer->cnic??'') }} </td>
                            </tr>
                            <tr>
                                <th> Passport </th>
                                <td> {{  strtoupper($customer->passport??'') }} </td>
                            </tr>
                            <tr>
                                <th> Expiry Date </th>
                                <td> {{  strtoupper($customer->cnic_or_passport_expiry_date??'') }} </td>
                            </tr>
                            <tr>
                                <th> Address </th>
                                <td> {{  strtoupper($customer->address??'') }} </td>
                            </tr>
                            <tr>
                                <th> Tour Reason </th>
                                <td> {{  strtoupper($customer->tour_reason??'') }} </td>
                            </tr>
                            <tr>
                                <th> Next Destination </th>
                                <td> {{  strtoupper($customer->next_destination??'') }} </td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

