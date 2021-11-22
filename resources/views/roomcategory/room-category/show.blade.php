@extends('layouts.master')
@push('css')
<style>
    hr.dashed {
        border-top: 3px dashed #bbb;
    }
    tr{
        box-shadow: 0px 3px 1px 2px #ccc;
    }
    .table tbody td.status .active {
        background: #cff6dd;
        color: #1fa750;
    }
    .table tbody td.status span {
        position: relative;
        border-radius: 30px;
        padding: 4px 10px 4px 25px;
    }
    .table tbody td.status .active:after {
        background: #23bd5a;
    }
    .table tbody td.status span:after {
        position: absolute;
        top: 9px;
        left: 10px;
        width: 10px;
        height: 10px;
        content: '';
        border-radius: 50%;
    }
    .table tbody td.status .waiting {
        background: #fdf5dd;
        color: #cfa00c;
    }
    .table tbody td.status .waiting:after {
        background: #f2be1d;
    }
</style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">RoomCategory {{ @$roomcategory->id }}</h3>
                    @can('view-'.str_slug('RoomCategory'))
                        <a class="btn btn-success pull-right" href="{{ url('/roomcategory/room-category') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ @$roomcategory->id }}</td>
                            </tr>
                            <tr><th> Room Type </th>
                                <td> {{ strtoupper(@$roomcategory->room_type) }} </td>
                            </tr>
                            <tr>
                                <th> Slug </th>
                                <td> {{ strtoupper(@$roomcategory->slug) }} </td>
                            </tr>
                            <tr>
                                <th> Price </th>
                                <td> {{ strtoupper(@$roomcategory->price) }} </td>
                            </tr>

                            <tr>
                                <th> No of beds </th>
                                @if($roomcategory->total_bed < 1)
                                    <td></td>
                                @else
                                    <td> {{ @$roomcategory->total_bed }}{{@$roomcategory->total_bed ==1  ? '-bed' : '-beds' }}</td>
                                @endif
                            </tr>

                            <tr>
                                <th> No of extra beds </th>
                                @if($roomcategory->total_bed < 1)
                                    <td></td>
                                @else
                                    <td> {{ strtoupper(@$roomcategory->extra_bed) }}{{@$roomcategory->extra_bed ==1  ? '-bed' : '-beds' }} </td>
                                @endif
                            </tr>

                            <tr>
                                <th> Description </th>
                                <td> {{ strtoupper(@$roomcategory->description) }} </td>
                            </tr>

                            <tr>
                                <th> Status </th>
                                @include('include.status',['variable'=>@$roomcategory->status])
                                {{-- <td class="status"> <span class="{{ @$roomcategory->status  ? 'active' : 'waiting' }}"> {{ strtoupper(@$roomcategory->status) }} </span></td> --}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

