@extends('layouts.app')
@section('title', 'Users')

@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Profile</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
          <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="active">My Profile</li>
      </ol>
  </div>
</div>
<!-- /.col-lg-12 -->
@include('inc.messages')
<div class="row">
    <div class="col-lg-12">
        <div class="white-box">
          <!-- START user details -->
          <div class="">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                  <h3 class="box-title">My Profile</h3>
                  <div class="table-responsive">
                      <table class="table">
                          <tbody>
                              <tr>
                                  <td width="390">First Name</td>
                                  <td> {{ Auth::user()->first_name }} </td>
                              </tr>
                              <tr>
                                  <td width="390">Last Name</td>
                                  <td> {{ Auth::user()->last_name }} </td>
                              </tr>
                              <tr>
                                  <td>Email Address</td>
                                  <td> {{ Auth::user()->email }} </td>
                              </tr>
                              <tr>
                                  <td>Phone</td>
                                  <td> {{ Auth::user()->phone }} </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4">
                <h3 class="box-title">
                  <a href="{{ route('profile.edit') }}" class="fcbtn btn btn-primary btn-outline btn-1c btn-sm pull-right">Edit Profile</a>
                </h3>
                <img src="{{ url(App\Models\User::FILE_UPLOAD_DIR.'/'.Auth::user()->picture) }}" alt="" class="m-t-10 profile-pic" width="100%">

                <div id="change-profile-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Change Your Profile Picture</h4> </div>
                            <div class="modal-body">
                                <div id="body-overlay"><div><img src="{{ url('images/loading.gif') }}"/></div></div>
                                <img src="{{ url(App\Models\User::FILE_UPLOAD_DIR.'/'.Auth::user()->picture) }}" alt="" width="100%" class="m-b-10 profile-pic">
                                <form action="{{ route('profile.profile-pic.update') }}" method="post" id="upload_form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="picture" class="control-label">Upload Profile Picture:</label>
                                        <input type="file" class="form-control" id="picture" name="picture">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-block btn-danger btn-rounded m-t-10" id="change_profile" data-toggle="modal" data-target="#change-profile-modal">Change Profile Picture</button>

              </div>
            </div>
          </div>
          <!-- END user details -->
        </div>
    </div>
</div>


@endsection

@push('css')
<style media="screen">
#body-overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
#body-overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
</style>
@endpush

@push('footer_scripts')
<script type="text/javascript">
  $(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#upload_form').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
         url:"{{ route('profile.profile-pic.update') }}",
         method:"POST",
         data:new FormData(this),
         dataType:'JSON',
         contentType: false,
         cache: false,
         processData: false,
         success:function(data)
         {
           if (data.status == 'success') {
             alert('Profile picture has been changed succefully.');
           } else {
             alert('Something went wrong.');
           }
         }
        })
    });

    $("#picture").on('change', function() {
      readURL(this);
    });
  });

</script>
@endpush
