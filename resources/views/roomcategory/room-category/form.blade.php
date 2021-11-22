
@push('css')
<link href="{{asset('plugins/components/select2/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/components/jquery/bootstrapValidator.min.css')}}" rel="stylesheet">

<style>
    input{
        border-radius: 4px !important;
    }
    textarea{
        border-radius: 4px !important;
    }
    .select2-container--default .select2-selection--single {
        height: 38px;
    }
</style>
@endpush
<div class="form-group {{ $errors->has('room_type') ? 'has-error' : ''}}">
    <label for="room_type" class="col-md-4 control-label">{{ 'Room Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="room_type" type="text" id="room_type" minlength="5" maxlength="30" value="{{ $roomcategory->room_type?? ''}}" >
        {!! $errors->first('room_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="col-md-4 control-label">{{ 'Slug' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="slug" type="text" id="slug" readonly value="{{ $roomcategory->slug?? ''}}" >
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="number" id="price" placeholder="Rs"  maxlength="10" value="{{ $roomcategory->price?? ''}}"  maxlength="10" oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'>
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('total_bed') ? 'has-error' : ''}}">
    <label for="total_bed" class="col-md-4 control-label">{{ 'No of Beds' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="total_bed" type="text" id="total_bed" readonly value="{{ $roomcategory->total_bed?? ''}}" > --}}
        <select class="form-control" name="total_bed" id="total_bed">
            <option value="">Select</option>
            @for($i=1; $i<=100; $i++)
                @if($i==1)
                    <option value="{{ $i }}" {{@$roomcategory->total_bed == $i  ? 'selected' : ''}}> {{ $i }} -Bed</option>
                @else
                    <option value="{{ $i }}" {{@$roomcategory->total_bed == $i  ? 'selected' : ''}}> {{ $i }} -Beds</option>
                @endif
            @endfor
        </select>
        {!! $errors->first('total_bed', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('extra_bed') ? 'has-error' : ''}}">
    <label for="extra_bed" class="col-md-4 control-label">{{ 'Extra Beds' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="extra_bed" type="text" id="extra_bed" readonly value="{{ $roomcategory->extra_bed?? ''}}" > --}}
        <select class="form-control"  name="extra_bed" id="extra_bed">
            <option value="">Select</option>
            @for($i=0; $i<=100; $i++)
                @if($i==0)
                    @if(@$ACTION !='CREATES')
                        <option value={{ $i }} {{@$roomcategory->extra_bed == $i  ? 'selected' : ''}}> No-Bed</option>
                    @else
                     <option value={{ $i }}> No-Bed</option>
                    @endif
                @elseif($i==1)
                    <option value={{ $i }} {{@$roomcategory->extra_bed == $i  ? 'selected' : ''}}> {{ $i }} -Bed</option>
                @else
                    <option value={{ $i }} {{@$roomcategory->extra_bed == $i  ? 'selected' : ''}}> {{ $i }} -Beds</option>
                @endif
            @endfor
        </select>
        {!! $errors->first('extra_bed', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" name="description" type="text" id="description" rows="15" cols="10" >{{ $roomcategory->description?? ''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        {{-- <input class="form-control" name="status" type="text" id="status" value="{{ $roomcategory->status?? ''}}" > --}}
        <select class="form-control" name="status" id="status">
            <option value="">Select Status</option>
            <option value="active" @if(@$roomcategory->status == 'active') selected @endif >Active</option>
            <option value="inactive" @if(@$roomcategory->status == 'inactive')selected @endif>InActive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4" id="submit">
        <input class="btn btn-primary finish"  type="submit" value="{{ $submitButtonText?? 'Create' }}">
    </div>
</div>

@push('js')
<script src="{{asset('plugins/components/select2/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/components/toggle/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('plugins/components/jquery/bootstrapValidator.min.js')}}"></script>
<script src="{{ asset('/js/roomCategory.js') }}"></script>
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>



<script>

</script>


@endpush
