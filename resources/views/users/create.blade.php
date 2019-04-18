@extends('layouts.app')
@section('title', 'Create User')

@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Users</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
          <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li><a href="{{ route('users.index') }}">Users</a></li>
          <li class="active">Create User</li>
      </ol>
  </div>
</div>
<!-- /.col-lg-12 -->

<!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-30">Create User</h3>
            <form class="form-horizontal" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}

              @include ('users.form', ['formMode' => 'create'])

            </form>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
