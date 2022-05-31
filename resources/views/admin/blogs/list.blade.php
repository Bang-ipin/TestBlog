
@extends('layouts.admin')

@section('title')
	<title> Blog </title>
	@endsection
@section('section')
<div class="row">
	<div class="col-md-12">
		<div class="portlet box yellow-saffron">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift "></i>
					<span class="caption-subject uppercase">Artikel</span>
				</div>
				<div class="actions">
					<a href="{{ url('admin/articles/create') }}" class="btn btn-danger btn-circle">
						<i class="fa fa-plus"></i><span class="hidden-480">Tambah </span>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-container">
					<table class="table table-striped table-bordered table-hover" id="listartikel">
						<thead>
							<tr role="row" class="heading">
								<th width="5%">
									No
								</th>
								<th width="25%">
									Title
								</th>
								<th width="5%">
									Content
								</th>
								<th width="10%">
									Tgl Posting
								</th>
								<th width="5%">
									Username
								</th>
								<th width="15%">
									 Actions
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($Blog as $item)
							<tr>
								<td>
									{{ $item->idpost}}
								</td>
								<td>
									{{ $item->title}}
								</td>
								<td>
									{{ $item->content}}
								</td>
								<td>
									{{ $item->username}}
								</td>
								<td>
									<a href="{{ url('admin/articles/'.$item->idpost.'/edit') }}" class='btn btn-sm btn-info btn-clean btn-icon' title='Edit details' ><i class='la la-edit' ></i>Edit</a>
									<a href='javascript:;' class='btn btn-sm btn-danger btn-clean btn-icon' title='Delete' onclick='hapusid($item->id)'><i class='la la-trash' ></i>Hapus</a>
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