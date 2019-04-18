<div class="form-group{{ $errors->has('first_name') ? ' has-error' : ''}}">
  <label class="col-md-12 label-control" for="first_name">First Name</label>
  <div class="col-md-12">
    <input type="text" id="first_name" name="first_name" class="form-control " placeholder="Enter first name" value="{{ (isset($user->first_name))?$user->first_name:old('first_name') }}" >
    {!! $errors->first('first_name', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : ''}}">
  <label class="col-md-12 label-control" for="last_name">Last Name</label>
  <div class="col-md-12">
    <input type="text" id="last_name" name="last_name" class="form-control " placeholder="Enter last name" value="{{ (isset($user->last_name))?$user->last_name:old('last_name') }}" >
    {!! $errors->first('last_name', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
  <label class="col-md-12 label-control" for="email">Email Address</label>
  <div class="col-md-12">
    <input type="email" id="email" name="email" class="form-control " placeholder="Enter email address" value="{{ (isset($user->email))?$user->email:old('email') }}" >
    {!! $errors->first('email', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

@if($formMode == 'create')
  <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    <label class="col-md-12 label-control" for="password">Password</label>
    <div class="col-md-12">
      <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
      {!! $errors->first('password', '<span class="help-block"><small>:message</small></span>') !!}
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-12 label-control" for="confirmation">Confirm Password</label>
    <div class="col-md-12">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
    </div>
  </div>
@elseif($formMode == 'edit')
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
@endif

<div class="form-group{{ $errors->has('phone') ? ' has-error' : ''}}">
  <label class="col-md-12 label-control" for="name">Phone</label>
  <div class="col-md-12">
    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone" value="{{ (isset($user->phone))?$user->phone:old('phone') }}">
    {!! $errors->first('phone', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('picture') ? ' has-error' : ''}}">
  <label for="picture" class="col-md-12 label-control">Upload Profile Picture</label>
  <div class="col-md-12">
    <input type="file" id="picture" name="picture">
    {!! $errors->first('photos', '<span class="help-block"><small>:message</small></span>') !!}
  </div>
</div>

<div class="form-group">
    <label class="col-md-12">Status</label>
    <div class="col-md-12">
      <div class="radio-list">
          <label class="radio-inline p-0">
              <div class="radio radio-info">
                  <input type="radio" class="minimal" name="status" id="enable" value="1"{{ ($formMode === 'create') ? 'checked' : (isset($user) && $user->status == 1)?'checked':'' }}>
                  <label for="enable">Enable</label>
              </div>
          </label>
          <label class="radio-inline">
              <div class="radio radio-info">
                  <input type="radio" class="minimal" name="status" id="disable" value="0"{{ (isset($user) && $user->status == 0)?'checked':'' }}>
                  <label for="disable">Disable</label>
              </div>
          </label>
      </div>
    </div>
</div>

<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
<a href="{{ route('users.index') }}" class="btn btn-inverse waves-effect waves-light">Cancel</a>

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
