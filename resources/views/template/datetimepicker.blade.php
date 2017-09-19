	<label for="name" class="col-md-1 control-label">{{ucfirst($input['label'])}}</label>
	<div class="col-lg-4">
	    <div class="input-daterange input-group">
            <input type="text" placeholder="Start date" name="start_date" class="input-sm  datetimepicker form-control" autocomplete="off"
            @if(!empty($input['start_date'])) value="{{$input['start_date']}}" @endif>
            <span class="input-group-addon">to</span>
            <input type="text" placeholder="End date" name="end_date" class="input-sm form-control datetimepicker" autocomplete="off" @if(!empty($input['end_date']))value="{{$input['end_date']}}" @endif>
        </div>
	</div>
