@extends('layouts.app')
@section('title', 'Edit My Profile')

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

<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-30">Edit My Profile</h3>

            @if(session('error'))
            	<div class="alert alert-danger">
            		{{ session('error') }}
            	</div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('profile.update', Auth::user()->id) }}">
              {{ method_field('PATCH') }}
              {{ csrf_field() }}

              @include ('profile.form')

            </form>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
