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
          <li class="active">Users</li>
      </ol>
  </div>
</div>
<!-- /.col-lg-12 -->
@include('inc.messages')
<!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
          <h3 class="box-title m-b-30">Manage Users
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm btn-flat pull-right" title="Add New User">
              <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
          </h3>


            <div class="table-responsive">
                <table id="users-table" class="table table-striped">
                    <thead>
                        <tr>
                          <th>Profile Picture</th>
        									<th>First Name</th>
        									<th>Last Name</th>
                          <th>Email</th>
        									<th>Status</th>
        									<th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer_scripts')
<script type="text/javascript">
  $(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('users.data') !!}',
        columns: [
            { data: 'picture', name: 'picture', orderable: false, searchable: false, },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
      			{ data: 'status', name: 'status', orderable: false, searchable: false,
      				render: function (status) {
      					return (status==1)?'<span class="text-success">Enable</span>':'<span class="text-danger">Disable</span>'
      				}
      			},
			      { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#users-table').on('click', '.btn-delete', function (e) {
  		e.preventDefault();
  		 $.ajaxSetup({
  			headers: {
  				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  			}
  		});
  		var url = $(this).data('remote');

  		// confirm then
  		if (confirm('Are you sure you want to delete this?')) {
  			$.ajax({
  				url: url,
  				type: 'DELETE',
  				dataType: 'json',
  				data: {method: '_DELETE', submit: true}
  			}).always(function (data) {
  				$('#users-table').DataTable().draw(false);
  			});
  		}else
  			alert("You have cancelled!");
  	});


  });

</script>
@endpush
