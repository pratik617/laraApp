@extends('layouts.app')
@section('title', 'Users')

@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Users</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
          <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li><a href="{{ route('users.index') }}">Users</a></li>
          <li class="active">{{ $user->full_name }}</li>
      </ol>
  </div>
</div>
<!-- /.col-lg-12 -->

<div class="row">
    <div class="col-lg-12">
        <div class="white-box">
          <!-- START project details -->
          <div class="">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8">
                  <h3 class="box-title">User Details</h3>
                  <div class="table-responsive">
                      <table class="table">
                          <tbody>
                              <tr>
                                  <td width="390">First Name</td>
                                  <td> {{ $user->first_name }} </td>
                              </tr>
                              <tr>
                                  <td width="390">Last Name</td>
                                  <td> {{ $user->last_name }} </td>
                              </tr>
                              <tr>
                                  <td>Email Address</td>
                                  <td> {{ $user->email }} </td>
                              </tr>
                              <tr>
                                  <td>Phone</td>
                                  <td> {{ $user->phone }} </td>
                              </tr>
                              <tr>
                                  <td>Created at</td>
                                  <td> {{ $user->created_at }} </td>
                              </tr>
                              <tr>
                                  <td>Updated at</td>
                                  <td> {{ $user->updated_at }} </td>
                              </tr>
                              <tr>
                                  <td>Status</td>
                                  <td>
                                    @if($user->status == 1)
                                      <span class="text-success">Enable</span>
                                    @else
                                      <span class="text-danger">Disable</span>
                                    @endif
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4">
                <h3 class="box-title">
                  <a href="{{ route('users.index') }}" class="fcbtn btn btn-primary btn-outline btn-1c btn-sm pull-right">Go Back</a>
                </h3>
                <img src="{{ url(App\Models\User::FILE_UPLOAD_DIR.'/'.$user->picture) }}" alt="" class="m-t-10" width="100%">
              </div>
            </div>
          </div>
          <!-- END project details -->
        </div>
    </div>
</div>

@endsection
