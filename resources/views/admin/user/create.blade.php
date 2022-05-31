@extends('layouts.admin')

@section('title')
	<title>Tambah</title>
	@endsection	
@section('section')
<div class="row">
	<div class="col-md-12">
		<div class="portlet box yellow-saffron">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>
					<span class="caption-subject bold uppercase">User</span>
				</div>
			</div>
				
			<div class="portlet-body form">
				<form action="{{ url('admin/user/create') }}" id="formuser" class="form-horizontal form-bordered form-label-stripped" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-body ">
						<div class="form-group">
							<label class="col-md-2 control-label">Username<span class="required">*</span></label>
							<div class="col-md-10">
								<input class="form-control" type="text" id="username" name="username" value="{{ old('username') }}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Name<span class="required">*</span></label>
							<div class="col-md-10">
								<input type="name" class="form-control" id="name" value="{{ old('name') }}" name="name" required/>
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password <span class="required">*</span></label>
							<div class="col-md-10">
								<input class="form-control" type="password" id="password" name="password" required >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Role <span class="required">*</span></label>
							<div class="col-md-10">
								<select class="form-control" name="role" id="role" required>
									<option value="1">Admin</option>
									<option value="2">Author</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-8 col-md-4">
								<a href="{{ url('amdin/user') }}" class="btn btn-sm btn-danger btn-circle" name="back"><i class="fa fa-angle-left"></i> Back</a>
								<button class="btn btn-sm  btn-warning btn-circle" name="reset" id="reset" type="reset" ><i class="fa fa-reply"></i> Reset</button>
								<button class="btn btn-sm  green-haze btn-circle"  name="submit" id="submituser"><i class="fa fa-check"></i> Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection


