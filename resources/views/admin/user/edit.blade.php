@extends('layouts.admin')

@section('title')
	<title> {{ $title }} </title>
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
				<form action="{{ url('admin/user/update') }}" id="formuser" class="form-horizontal form-bordered form-label-stripped" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-body ">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama<span class="required">*</span></label>
							<div class="col-md-10">
								<input class="form-control" type="hidden" id="id" value="{{ $id }}" name="id" >
								<input class="form-control" type="text" id="name" name="name" value="{{ $name }}"placeholder="Nama" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email<span class="required">*</span></label>
							<div class="col-md-10">
								<input type="email" class="form-control" id="email" value="{{ $email }}" name="email" readonly="true" />
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password <span class="required">*</span></label>
							<div class="col-md-10">
								<input class="form-control" type="password" id="password" name="password" >
								<span class="help-block">
									Password Boleh di Kosongkan jika tidak diedit </span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Konfirmasi Password <span class="required">*</span></label>
							<div class="col-md-10">
								<input class="form-control" type="password" id="confirm_password"  name="confirm_password" >
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-8 col-md-4">
								<a href="{{ url('admin/user') }}" class="btn btn-sm btn-danger btn-circle" name="back"><i class="fa fa-angle-left"></i> Back</a>
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


