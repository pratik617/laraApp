@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Dashboard</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
          <li class="active">Dashboard</li>
      </ol>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white-box">

            <div class="">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title">User Data</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="390">Total Users</td>
                                    <td> {{ $total_users }} </td>
                                </tr>
                                <tr>
                                    <td width="390">Active Users</td>
                                    <td> {{ $active_users }} </td>
                                </tr>
                                <tr>
                                    <td width="390">InActive Users</td>
                                    <td> {{ $inactive_users }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
