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