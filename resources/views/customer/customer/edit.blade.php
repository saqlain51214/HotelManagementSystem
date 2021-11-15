@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Edit Customer #{{ $customer->id }}</h3>
                    @can('view-'.str_slug('Customer'))
                        <a class="btn btn-success pull-right" href="{{ url('/customer/customer') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/customer/customer/' . $customer->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="commentForm">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include ('customer.customer.update', ['submitButtonText' => 'Update'])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
