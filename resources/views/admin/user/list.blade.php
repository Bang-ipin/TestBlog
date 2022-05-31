@extends('layouts.admin')

@section('title')
	<title>User </title>
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
				<div class="actions">
					<a href="{{ url('admin/user/create') }}" class="btn btn-danger btn-circle"><i class="fa fa-plus"></i><span class="hidden-480"> Tambah </span></a>
				</div>
			</div>
			
			<div class="portlet-body">
				<div class="table-container">
					<table  class="table table-striped table-bordered table-hover" id="listuser">
						<thead>
							<tr role="row" class="heading">
								<th width="5%">
									Username
								</th>
								<th width="15%">
									 Name
								</th>
								<th width="15%">
									 Role
								</th>
								<th width="10%">
									 Actions
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dataUser as $item)
							<tr>
								<td>
									{{ $item->username}}
								</td>
								<td>
									{{ $item->name}}
								</td>
								<td>
									{{ $item->role}}
								</td>
								<td>
									@if ($item->role == '2' )
										<a class='btn btn-sm btn-info btn-clean btn-icon' title='Edit details'  href=".url('admin/user/'.$user->id.'/edit')."><i class='la la-edit'></i> Edit</a>
									@else
										<a href="{{ url('admin/user/'.$item->id.'/edit') }}" class='btn btn-sm btn-info btn-clean btn-icon' title='Edit details' ><i class='la la-edit' ></i>Edit</a>
										<a href='javascript:;' class='btn btn-sm btn-danger btn-clean btn-icon' title='Delete' onclick='hapusid($item->id)'><i class='la la-trash' ></i>Hapus</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection