@extends('layouts.master')

@push('css')
    <link href="{{ asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
    {{--<link href="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">--}}
    <link href="{{asset('plugins/components/jqueryui/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
    <style>

        #rootwizard .nav.nav-pills {
            margin-bottom: 25px;
        }
        .nav-pills>li>a{
            cursor: default;;
            background-color: inherit;
        }
        .nav-pills>li>a:focus,.nav-tabs>li>a:focus, .nav-pills>li>a:hover, .nav-tabs>li>a:hover {
            border: 1px solid transparent!important;
            background-color: inherit!important;
        }

        .help-block {
            display: block;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .nav-pills>li>a{
            cursor: default;;
            background-color: inherit;
        }
        .nav-pills>li>a:focus,.nav-tabs>li>a:focus, .nav-pills>li>a:hover, .nav-tabs>li>a:hover {
            border: 1px solid transparent!important;
            background-color: inherit!important;
        }

        .has-error .help-block {
            color: #EF6F6C;
        }

        .select2 {
            width: 100% !important;
        }
        .error-block{
            background-color: #ff9d9d;
            color: red;
        }
        .select2-container--default .select2-selection--single{
            height: 39px !important;
            border-radius: 0px !important;
        }
        .preloader{
            opacity: 0.5 !important;
        }
       
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create User</h3>
                    <div class="clearfix"></div>
                    <form id="commentForm" action="{{url('user/create')}}"
                          method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                        <div id="rootwizard">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">User Profile</a></li>
                                <li><a href="#tab2" data-toggle="tab">Bio</a></li>
                                <li><a href="#tab3" data-toggle="tab">Address</a></li>
                                <li><a href="#tab4" data-toggle="tab">User Role</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <h2 class="hidden">&nbsp;</h2>

                                    <div class="form-group {{ $errors->first('name', 'has-error') }}">
                                        <label for="name" class="col-sm-2 control-label">Full Name *</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text"
                                                   placeholder="Name" class="form-control required"
                                                   value="{!! old('name') !!}"/>

                                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('father_name', 'has-error') }}">
                                        <label for="father_name" class="col-sm-2 control-label">Father Name *</label>
                                        <div class="col-sm-10">
                                            <input id="father_name" name="father_name" type="text"
                                                   placeholder="Father Name" class="form-control required"
                                                   value="{!! old('father_name') !!}"/>

                                            {!! $errors->first('father_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                        <label for="email" class="col-sm-2 control-label">Email *</label>
                                        <div class="col-sm-10">
                                            <input id="email" name="email" placeholder="E-mail" type="text"
                                                   class="form-control required email" value="{!! old('email') !!}"/>
                                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('customer_type', 'has-error') }}">
                                        <label for="customer_type" class="col-sm-2 control-label">Customer Type *</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" title="Select Type..." name="customer_type">
                                                <option value="">Select</option>
                                                <option value="male"
                                                        @if(old('customer_type') === 'local') selected="selected" @endif >Local
                                                </option>
                                                <option value="female"
                                                        @if(old('customer_type') === 'foreign') selected="selected" @endif >
                                                        foreign
                                                </option>
                                                <option value="other"
                                                        @if(old('customer_type') === 'international') selected="selected" @endif >International
                                                </option>

                                            </select>
                                        </div>
                                        <span class="help-block">{{ $errors->first('customer_type', ':message') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->first('customer_status', 'has-error') }}">
                                        <label for="customer_status" class="col-sm-2 control-label">Customer Status *</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" title="Select Type..." name="customer_status">
                                                <option value="">Select</option>
                                                <option value="male"
                                                        @if(old('customer_status') === 'local') selected="selected" @endif >Local
                                                </option>
                                                <option value="female"
                                                        @if(old('customer_status') === 'foreign') selected="selected" @endif >
                                                        foreign
                                                </option>
                                                <option value="other"
                                                        @if(old('customer_status') === 'international') selected="selected" @endif >International
                                                </option>

                                            </select>
                                        </div>
                                        <span class="help-block">{{ $errors->first('customer_status', ':message') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                        <label for="password" class="col-sm-2 control-label">Password *</label>
                                        <div class="col-sm-10">
                                            <input id="password" name="password" type="password" placeholder="Password"
                                                   class="form-control required" value="{!! old('password') !!}"/>
                                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}">
                                        <label for="password_confirm" class="col-sm-2 control-label">Confirm Password
                                            *</label>
                                        <div class="col-sm-10">
                                            <input id="password_confirmation" name="password_confirmation"
                                                   type="password"
                                                   placeholder="Confirm Password " class="form-control required"/>
                                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" disabled="disabled">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group  {{ $errors->first('dob', 'has-error') }}">
                                        <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                        <div class="col-sm-10">
                                            <input value="{{old('dob')}}" autocomplete="off" id="dob" name="dob" type="text" class="form-control"
                                                   data-date-format="YYYY-MM-DD"
                                                   placeholder="yyyy-mm-dd"/>
                                            <span class="help-block">{{ $errors->first('dob', ':message') }}</span>

                                        </div>
                                    </div>


                                    <div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
                                        <label for="pic" class="col-sm-2 control-label">Profile picture</label>
                                        <div class="col-sm-10">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 200px;">
                                                    <img src="http://placehold.it/200x200" alt="profile pic">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 200px;"></div>
                                                <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input id="pic" name="pic_file" type="file" class="form-control"/>
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            <span class="help-block">{{ $errors->first('pic_file', ':message') }}</span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="bio" class="col-sm-2 control-label">Bio
                                            <small>(brief intro) *</small>
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea name="bio" id="bio" class="form-control resize_vertical"
                                            rows="4">{!! old('bio') !!}</textarea>
                                        </div>
                                        {!! $errors->first('bio', '<span class="help-block">:message</span>') !!}
                                    </div>

                                    <div class="form-group {{ $errors->first('tour_reason', 'has-error') }}">
                                        <label for="tour_reason" class="col-sm-2 control-label">Tour Reason *</label>
                                        <div class="col-sm-10">
                                            <input id="tour_reason" name="tour_reason" type="text"
                                                   placeholder="Tour Reason" class="form-control required"
                                                   value="{!! old('tour_reason') !!}"/>

                                            {!! $errors->first('tour_reason', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('next_distination', 'has-error') }}">
                                        <label for="next_distination" class="col-sm-2 control-label">Next Destination *</label>
                                        <div class="col-sm-10">
                                            <input id="next_distination" name="next_distination" type="text"
                                                   placeholder="Next Distination" class="form-control required"
                                                   value="{!! old('next_distination') !!}"/>

                                            {!! $errors->first('next_distination', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3" disabled="disabled">
                                    <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                                        <label for="email" class="col-sm-2 control-label">Gender *</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" title="Select Gender..." name="gender">
                                                <option value="">Select</option>
                                                <option value="male"
                                                        @if(old('gender') === 'male') selected="selected" @endif >Male
                                                </option>
                                                <option value="female"
                                                        @if(old('gender') === 'female') selected="selected" @endif >
                                                    Female
                                                </option>
                                                <option value="other"
                                                        @if(old('gender') === 'other') selected="selected" @endif >Other
                                                </option>

                                            </select>
                                        </div>
                                        <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                                    </div>

                                    <div class="form-group {{ $errors->first('country', 'has-error') }}">
                                        <label for="country" class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            {{-- <input id="countries" name="country" type="text"
                                                   class="form-control"
                                                   value="{!! old('country') !!}"/> --}}
                                                   <select id='selCountry' style='width: 200px;' name="country">
                                                    <option value=''>Select Country</option> 

                                                    @foreach ($countries as $country)
                                                    <option value={{$country->id}}>{{$country->name}}</option> 
                                                        
                                                    @endforeach
                                                  </select>
                                            <span class="help-block">{{ $errors->first('country', ':message') }}</span>

                                        </div>
                                      
                                    </div>

                                    <div class="form-group {{ $errors->first('state', 'has-error') }}">
                                        <label for="state" class="col-sm-2 control-label">State</label>
                                        <div class="col-sm-10">
                                            {{-- <input id="state" name="state" type="text"
                                                   class="form-control"
                                                   value="{!! old('state') !!}"/> --}}
                                                   <select id='selState' style='width: 200px;' name="state" disabled=true>
                                                  </select>
                                            <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('city', 'has-error') }}">
                                        <label for="city" class="col-sm-2 control-label">City</label>
                                        <div class="col-sm-10">
                                            {{-- <input id="city" name="city" type="text" class="form-control"
                                                   value="{!! old('city') !!}"/> --}}
                                                   <select id='selCity' style='width: 200px;' name="city" disabled=true>
                                                   </select>
                                            <span class="help-block">{{ $errors->first('city', ':message') }}</span>

                                        </div>
                                    </div>

                                    {{-- <div class="form-group {{ $errors->first('phone_no', 'has-error') }}">
                                        <label for="address" class="col-sm-2 control-label">Phone No</label>
                                        <div class="col-sm-10">
                                            <input id="phone_no" name="phone_no" type="number" class="form-control"
                                                   value="{{ old('phone_no') }}"/>
                                            <span class="help-block">{{ $errors->first('phone_no', ':message') }}</span>

                                        </div>
                                    </div> --}}

                                    <div class="form-group {{ $errors->first('cell_no', 'has-error') }}">
                                        <label for="cell_no" class="col-sm-2 control-label">Cell Phone No</label>
                                        <div class="col-sm-10">
                                            <input id="cell_no" name="cell_no" type="number" class="form-control"
                                                   value="{{ old('cell_no') }}" maxlength="15" oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'/>
                                            <span class="help-block">{{ $errors->first('cell_no', ':message') }}</span>

                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                        <label for="address" class="col-sm-2 control-label">Address/Area/Street</label>
                                        <div class="col-sm-10">
                                            <input id="address" name="address" type="text" class="form-control"
                                                   value="{{ old('address') }}"/>
                                            <span class="help-block">{{ $errors->first('address', ':message') }}</span>

                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                                        <label for="postal" class="col-sm-2 control-label">Postal/zip</label>
                                        <div class="col-sm-10">
                                            <input id="postal" name="postal" type="number" class="form-control"
                                                   value="{!! old('postal') !!}"/>
                                            <span class="help-block">{{ $errors->first('postal', ':message') }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab4" disabled="disabled">
                                    <p class="text-danger"><strong>Be careful with role selection, if you give admin
                                            access.. they can access admin section</strong></p>

                                    <div class="form-group required {{ $errors->first('role', 'has-error') }}">
                                        <label for="group" class="col-sm-2 control-label">Role *</label>
                                        <div class="col-sm-10">
                                            <select class="form-control required" title="Select role..." name="role"
                                                    id="role">
                                                <option value="">Select</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                            @if($role->id == old('role')) selected="selected" @endif >{{ $role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">{{ $errors->first('role', ':message') }}</span>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group {{ $errors->first('cnic', 'has-error') }}">
                                        <label for="cnic" class="col-sm-2 control-label">CNIC *</label>
                                        <div class="col-sm-10">
                                            <input id="cnic" name="next_distination" type="text"
                                                   placeholder="CNIC" class="form-control required"
                                                   value="{!! old('cnic') !!}"/>

                                            {!! $errors->first('cnic', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('passport', 'has-error') }}">
                                        <label for="passport" class="col-sm-2 control-label">Passport *</label>
                                        <div class="col-sm-10">
                                            <input id="passport" name="next_distination" type="number"
                                                   placeholder="Passport Number" class="form-control required"
                                                   value="{!! old('passport') !!}"/>

                                            {!! $errors->first('passport', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('expiry_date', 'has-error') }}">
                                        <label for="expiry_date" class="col-sm-2 control-label">CNIC/Pass Expiry Date*</label>
                                        <div class="col-sm-10">
                                            <input id="expiry_date" name="expiry_date" type="date"
                                                   placeholder="Expiry Date" class="form-control required"
                                                   value="{!! old('expiry_date') !!}"/>

                                            {!! $errors->first('expiry_date', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    {{--<div class="form-group">--}}
                                    {{--<label for="activate" class="col-sm-2 control-label"> Activate User *</label>--}}
                                    {{--<div class="col-sm-10">--}}
                                    {{--<input id="activate" name="activate" type="checkbox"--}}
                                    {{--class="pos-rel p-l-30 custom-checkbox"--}}
                                    {{--value="1" @if(old('activate')) checked="checked" @endif >--}}
                                    {{--<span>To activate user account automatically, click the check box</span></div>--}}

                                    {{--</div>--}}
                                </div>
                                <ul class="pager wizard">
                                    <li class="previous"><a href="#">Previous</a></li>
                                    <li class="next"><a href="#">Next</a></li>
                                    <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>


                    @if(count($errors) > 0)
                        <div class="alert alert-danger">Errors! Please fill form with proper details</div>
                    @endif

                </div>
            </div>
        </div>

        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/components/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{asset('plugins/components/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('plugins/components/icheck/icheck.init.js')}}"></script>
    <script src="{{asset('plugins/components/moment/moment.js')}}"></script>
    {{--<script src="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>--}}
    <script src="{{asset('plugins/components/jqueryui/jquery-ui.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"
            type="text/javascript"></script>
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{ asset('/js/adduser.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

    <script>
        @if(\Session::has('message'))
        $.toast({
            heading: 'Success!',
            position: 'top-center',
            text: '{{session()->get('message')}}',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3000,
            stack: 6
        });
        @endif

        $("#cell_no").intlTelInput({});
        $('.iti').attr('style', 'display: block !important');
       


        // 

        $(document).ready(function(){

            // Initialize select2
            $("#selState,#selCountry,#selCity").select2();

            //  ajax call for fetching all states according to countries
            $(document).on('change','#selCountry',function(){
                let _this = $(this);
                let country_id = _this.val();
                let option = '';
                if(country_id != null){
                    $.ajax({
                    type: 'GET',
                    url: "{{url('get-states-by-select-country')}}/" +country_id,
                    data:{ 
                        _token:'{{ csrf_token() }}'
                    },
                    cache: false,
                    dataType: 'json',

                    beforeSend: function() {
                        
                        $(".preloader").css({ 'display' : '', 'opacity' : '0.5px' });
                        
                    },
                    success: function(response) {
                        $(".preloader").css({ 'display' : 'none', 'opacity' : '' });

                        console.log(response);
                        $("#selState").prop('disabled', false);
                      
                        let option = '<option value=""> Select State</option>';
                        $.each(response,function(index,row){
                            

                            option += `<option value=`+row['id']+`>`+row['name']+`</option>`;
                        
                        })
                    
                        $("#selState").empty();
                        $("#selState").append(option);
                        
                        
                    
                    },
                    error: function(xhr) { // if error occured
                        console.log('XHR',xhr);
                    },

                    });
                }else{
                    alert('Select any type');
                }
            });

            //  ajax call for fetching all cities according to states

            $(document).on('change','#selState',function(){
                let _this = $(this);
                let state_id = _this.val();
                let option = '';
                if(state_id != null){
                    $.ajax({
                    type: 'GET',
                    url: "{{url('get-cities-by-select-state')}}/" +state_id,
                    data:{ 
                        _token:'{{ csrf_token() }}'
                    },
                    cache: false,
                    dataType: 'json',

                    beforeSend: function() {
                        
                        $(".preloader").css({ 'display' : '', 'opacity' : '0.5px' });
                        
                    },
                    success: function(response) {
                        $(".preloader").css({ 'display' : 'none', 'opacity' : '' });

                        console.log(response);
                        $("#selCity").prop('disabled', false);
                      
                        let option = '<option value=""> Select City</option>';
                        $.each(response,function(index,row){
                            

                            option += `<option value=`+row['id']+`>`+row['name']+`</option>`;
                        
                        })
                    
                        $("#selCity").empty();
                        $("#selCity").append(option);
                        
                        
                    
                    },
                    error: function(xhr) { // if error occured
                        console.log('XHR',xhr);
                    },

                    });
                }else{
                    alert('Select any type');
                }
            });

        });
    </script>
@endpush