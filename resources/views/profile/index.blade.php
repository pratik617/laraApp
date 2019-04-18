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
          <!-- START project details -->
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
                <img src="{{ url(env('FILE_UPLOAD_DIR').'/'.Auth::user()->picture) }}" alt="" class="m-t-10" width="100%">

                <!--<button class="btn btn-block btn-danger btn-rounded">Change Profile</button>-->
              </div>
            </div>
          </div>
          <!-- END project details -->
        </div>
    </div>
</div>

@endsection
