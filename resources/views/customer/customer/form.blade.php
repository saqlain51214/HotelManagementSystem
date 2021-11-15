@push('css')
<link href="{{ asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
<link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
{{--<link href="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">--}}
<link href="{{asset('plugins/components/jqueryui/jquery-ui.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />

<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
    height: 24px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
    .preloader{
        opacity: 0.5 !important;
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
</style>
    
@endpush
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<div id="rootwizard">
<div class="white-box " style="box-shadow: 0px 3px 1px 2px #ccc;" >
    <div class="row">
        <div class="col-md-10"> <h2>Customer Profile</h2></div>
        <div class="col-md-2" style="margin-top: 10px;">
            <label class="switch">
                <input type="checkbox" id="cuntomer_profile_btn">
                <span class="slider round"></span>
              </label>
        </div>
    </div>
   <div id="customer_profile" style="display: none">
        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
            <label for="first_name" class="col-md-4 control-label">{{ 'First Name' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="first_name" type="text" id="first_name" value="{{ $customer->first_name?? ''}}" required maxlength="40">
                {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
            <label for="last_name" class="col-md-4 control-label">{{ 'Last Name' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="last_name" type="text" id="last_name" value="{{ $customer->last_name?? ''}}" maxlength="40">
                {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('father_name') ? 'has-error' : ''}}">
            <label for="father_name" class="col-md-4 control-label">{{ 'Father Name' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="father_name" type="text" id="father_name" value="{{ $customer->father_name?? ''}}" maxlength="40" >
                {!! $errors->first('father_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="white-box" style="box-shadow: 0px 3px 1px 2px #ccc;">
    <div class="row">
        <div class="col-md-10"> <h2>Customer Details</h2></div>
        <div class="col-md-2" style="margin-top: 10px;">
            <label class="switch">
                <input type="checkbox" id="customer_details_btn">
                <span class="slider round"></span>
              </label>
        </div>
    </div>
    <div id="customer_details" style="display: none">
        <div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
            <label for="country" class="col-md-4 control-label">{{ 'Country' }}</label>
            <div class="col-md-6">
                {{-- <input class="form-control" name="country" type="text" id="country" value="{{ $customer->country?? ''}}" > --}}
                <select  name="country" type="text" id="country"  >
                    <option value=''>Select Country</option> 

                    @foreach ($countries as $country)
                    <option value={{$country->id}}>{{$country->name}}</option> 
                        
                    @endforeach
                  </select>
                {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('province') ? 'has-error' : ''}}">
            <label for="province" class="col-md-4 control-label">{{ 'Province' }}</label>
            <div class="col-md-6">
                {{-- <input class="form-control" name="province" type="text" id="province" value="{{ $customer->province?? ''}}" > --}}
                <select id='province' name="province"disabled=true>
                </select>
                {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
            <label for="city" class="col-md-4 control-label">{{ 'City' }}</label>
            <div class="col-md-6">
                {{-- <input class="form-control" name="city" type="text" id="city" value="{{ $customer->city?? ''}}" > --}}
                <select  name="city" id="city"  disabled=true>
                </select>
                {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        {{-- <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
            <label for="phone_number" class="col-md-4 control-label">{{ 'Phone Number' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="phone_number" type="number" id="phone_number" value="{{ $customer->phone_number?? ''}}" maxlength="15" oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' >
                {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
            </div>
        </div> --}}
        <div class="form-group {{ $errors->has('cell_number') ? 'has-error' : ''}}">
            <label for="cell_number" class="col-md-4 control-label">{{ 'Cell Number' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="cell_number_old" type="number" placeholder="3XXXXXXXX" id="cell_number_old" value="{{ $customer->cell_number?? ''}}" maxlength="15" oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'>
                <input class="form-control" name="cell_number" type="hidden"  id="cell_number_orignal" >
                {!! $errors->first('cell_number', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('cnic') ? 'has-error' : ''}}">
            <label for="cnic" class="col-md-4 control-label">{{ 'Cnic' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="cnic" type="number" id="cnic" value="{{ $customer->cnic?? ''}}" placeholder="123456789" maxlength="25" oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'>
                {!! $errors->first('cnic', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('passport') ? 'has-error' : ''}}">
            <label for="passport" class="col-md-4 control-label">{{ 'Passport' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="passport" type="text" id="passport" value="{{ $customer->passport?? ''}}" placeholder="F123456789" maxlength="25" oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'>
                {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('cnic_or_passport_expiry_date') ? 'has-error' : ''}}">
            <label for="cnic_or_passport_expiry_date" class="col-md-4 control-label">{{ 'Cnic Or Passport Expiry Date' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="cnic_or_passport_expiry_date" autocomplete="off" data-date-format="YYYY-MM-DD"
                placeholder="yyyy-mm-dd" type="text" id="cnic_or_passport_expiry_date" value="{{ $customer->cnic_or_passport_expiry_date?? ''}}" >
                {!! $errors->first('cnic_or_passport_expiry_date', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="white-box" style="box-shadow: 0px 3px 1px 2px #ccc;">
    <div class="row">
        <div class="col-md-10"> <h2>Customer Addresses</h2></div>
        <div class="col-md-2" style="margin-top: 10px;">
            <label class="switch">
                <input type="checkbox" id="customer_address_btn">
                <span class="slider round"></span>
              </label>
        </div>
    </div>
    <div id="customer_address" style="display: none">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            <label for="address" class="col-md-4 control-label">{{ 'Address' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="address" type="text" id="address" value="{{ $customer->address?? ''}}" maxlength="70">
                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('customer_gender') ? 'has-error' : ''}}">
            <label for="customer_gender" class="col-md-4 control-label">{{ 'Customer Gender' }}</label>
            <div class="col-md-6">
                {{-- <input class="form-control" name="customer_type" type="text" id="customer_type" value="{{ $customer->customer_type?? ''}}" > --}}
                <select class="form-control" title="Select Gender..." name="gender" id="customer_gender">
                    <option value="">Select Gender</option>
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
                

                {!! $errors->first('customer_type', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
        <div class="form-group {{ $errors->has('customer_status') ? 'has-error' : ''}}">
            <label for="customer_status" class="col-md-4 control-label">{{ 'Customer Status' }}</label>
            <div class="col-md-6">
                {{-- <input class="form-control" name="customer_status" type="text" id="customer_status" value="{{ $customer->customer_status?? ''}}" > --}}
                <select class="form-control" title="Select Type..." name="customer_status" id="customer_status">
                    <option value="">Select Status</option>
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
                {!! $errors->first('customer_status', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('customer_type') ? 'has-error' : ''}}">
            <label for="customer_type" class="col-md-4 control-label">{{ 'Customer Type' }}</label>
            <div class="col-md-6">
                {{-- <input class="form-control" name="customer_type" type="text" id="customer_type" value="{{ $customer->customer_type?? ''}}" > --}}
                <select class="form-control" title="Select Type..." name="customer_type" id="customer_type">
                    <option value="">Select Type</option>
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
                {!! $errors->first('customer_type', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('tour_reason') ? 'has-error' : ''}}">
            <label for="tour_reason" class="col-md-4 control-label">{{ 'Tour Reason' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="tour_reason" type="text" id="tour_reason" value="{{ $customer->tour_reason?? ''}}" maxlength="40">
                {!! $errors->first('tour_reason', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('next_destination') ? 'has-error' : ''}}">
            <label for="next_destination" class="col-md-4 control-label">{{ 'Next Destination' }}</label>
            <div class="col-md-6">
                <input class="form-control" name="next_destination" type="text" id="next_destination" value="{{ $customer->next_destination?? ''}}" maxlength="40" >
                {!! $errors->first('next_destination', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary next finish" id="submit_btn" type="submit" value="{{ $submitButtonText?? 'Create' }}">
    </div>
</div>
</div>

@push('js')
    <script src="{{ asset('plugins/components/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{asset('plugins/components/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('plugins/components/icheck/icheck.init.js')}}"></script>
    <script src="{{asset('plugins/components/moment/moment.js')}}"></script>
    {{--<script src="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>--}}
    <script src="{{asset('plugins/components/jqueryui/jquery-ui.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{ asset('/js/addCustomer.js') }}"></script>


    <script>
      

        $('#cell_number_old').keyup(function(){

            var intlNumber = $("#cell_number_old").intlTelInput("getSelectedCountryData");
            var no = $(this).val();
            $('#cell_number_orignal').val(intlNumber.dialCode.concat(no));
            console.log('=>intlNumbe',intlNumber.dialCode);
        });

// $("#cuntomer_profile_btn").attr("checked", false);
// $("#customer_details_btn").attr("checked", false);
// $("#customer_address_btn").attr("checked", false);

            //  ajax call for fetching all states according to countries
    $(document).on("change", "#country", function() {
        let _this = $(this);
        let country_id = _this.val();
        let option = "";
        if (country_id != null) {
            $.ajax({
                type: "GET",
                url: "{{url('get-states-by-select-country')}}/" + country_id,
                data: {
                    // _token: "{{ csrf_token() }}",
                },
                cache: false,
                dataType: "json",

                beforeSend: function() {
                    $(".preloader").css({ display: "", opacity: "0.5px" });
                },
                success: function(response) {
                    $(".preloader").css({ display: "none", opacity: "" });

                    console.log(response);
                    $("#province").prop("disabled", false);

                    option = '<option value=""> Select State</option>';
                    $.each(response, function(index, row) {
                        option +=
                            `<option value=` + row["id"] + `>` + row["name"] + `</option>`;
                    });

                    $("#province").empty();
                    $("#province").append(option);
                },
                error: function(xhr) {
                    // if error occured
                    console.log("XHR", xhr);
                },
            });
        } else {
            alert("Select any type");
        }
    });

    //  ajax call for fetching all cities according to states

    $(document).on("change", "#province", function() {
        let _this = $(this);
        let state_id = _this.val();
        let option = "";
        if (state_id != null) {
            $.ajax({
                type: "GET",
                url: "{{url('get-cities-by-select-state')}}/" + state_id,
                data: {
                    // _token: "{{ csrf_token() }}",
                },
                cache: false,
                dataType: "json",

                beforeSend: function() {
                    $(".preloader").css({ display: "", opacity: "0.5px" });
                },
                success: function(response) {
                    $(".preloader").css({ display: "none", opacity: "" });

                    console.log(response);
                    $("#city").prop("disabled", false);

                    option = '<option value=""> Select City</option>';
                    $.each(response, function(index, row) {
                        option +=
                            `<option value=` + row["id"] + `>` + row["name"] + `</option>`;
                    });

                    $("#city").empty();
                    $("#city").append(option);
                },
                error: function(xhr) {
                    // if error occured
                    console.log("XHR", xhr);
                },
            });
        } else {
            alert("Select any type");
        }
    });
    </script>
@endpush