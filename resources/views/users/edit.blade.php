@extends('layouts.app')
@section('title', 'Edit User')

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

<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-30">Edit User #{{ $user->id }}</h3>

            @if(session('error'))
            	<div class="alert alert-danger">
            		{{ session('error') }}
            	</div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
              {{ method_field('PATCH') }}
              {{ csrf_field() }}

              @include ('users.form', ['formMode' => 'edit'])

            </form>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
