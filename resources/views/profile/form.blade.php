<div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
  <label class="col-md-12 label-control" for="first_name">First Name</label>
  <div class="col-md-12">
    <input type="text" id="first_name" name="first_name" class="form-control " placeholder="Enter first name" value="{{ (isset(Auth::user()->first_name))?Auth::user()->first_name:old('first_name') }}" >
    {!! $errors->first('first_name', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : ''}}">
  <label class="col-md-12 label-control" for="last_name">Last Name</label>
  <div class="col-md-12">
    <input type="text" id="last_name" name="last_name" class="form-control " placeholder="Enter last name" value="{{ (isset(Auth::user()->last_name))?Auth::user()->last_name:old('last_name') }}" >
    {!! $errors->first('last_name', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : ''}}">
  <label class="col-md-12 label-control" for="name">Phone</label>
  <div class="col-md-12">
    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone" value="{{ (isset(Auth::user()->phone))?Auth::user()->phone:old('phone') }}">
    {!! $errors->first('phone', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

  <div class="form-group">
    <div class="col-md-12">
    <div class="checkbox checkbox-purple">
      <input type="checkbox" id="change_password" name="change_password">
      <label for="change_password"> Change Password </label>
    </div>
    </div>
  </div>

  <div style="display:none;" id="change_password_wrapper">
    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : ''}}">
      <label class="col-md-12 label-control" for="current_password">Current Password</label>
      <div class="col-md-12">
        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
        {!! $errors->first('current_password', '<span class="help-block"><small>:message</small></span>') !!}
      </div>
    </div>

    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : ''}}">
      <label class="col-md-12 label-control" for="new_password">New Password</label>
      <div class="col-md-12">
        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
        {!! $errors->first('new_password', '<span class="help-block"><small>:message</small></span>') !!}
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-12 label-control" for="new_password_confirmation">Confirm Password</label>
      <div class="col-md-12">
        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm password">
      </div>
    </div>
  </div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Save</button>
<a href="{{ route('profile.index') }}" class="btn btn-inverse waves-effect waves-light">Cancel</a>

@push('footer_scripts')
<script type="text/javascript">
  $(document).ready(function() {
    if ($('#change_password').prop('checked') == true) {
      $('#change_password_wrapper').show();
    } else if($('#change_password').prop('checked') == false) {
      $('#change_password_wrapper').hide();
    }

    $('#change_password').click(function() {
      if ($(this).prop('checked') == true) {
        $('#change_password_wrapper').show();
      } else if($(this).prop('checked') == false) {
        $('#change_password_wrapper').hide();
      }
    });
  });
</script>
@endpush
