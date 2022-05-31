@extends('layouts.admin')

@section('title')
	<title> Form Artikel</title>
	@endsection
@section('section')
<div class="row">
	<div class="col-md-12">
		<div class="portlet box yellow-saffron">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>
					<span class="caption-subject uppercase">Artikel</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<form action="{{url('admin/articles/create') }}" id="formartikel" class="form-horizontal form-row-stripped form-bordered" method="POST" enctype="multipart/form-data" >
						@csrf
						<div class="form-group">
							<label class="col-md-2 control-label">Judul Artikel:<span class="text-danger">*</span></label>
							<div class="col-md-10">
								<input class="form-control" type="text" name="title" id="title" value="{{ $title }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Konten:<span class="text-danger">*</span></label>
							<div class="col-md-10">
								<textarea class="form-control" id="editor-ckeditor" type="text" name="content" data-error-container="#content">{{ $content }}</textarea>
								<div id="content"></div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-8 col-md-4">
									<a href="{{ url('admin/articles') }}" class="btn btn-danger btn-sm btn-circle" name="back"><i class="fa fa-angle-left"></i> Back</a>
									<button class="btn green-haze btn-sm btn-circle"  name="submit" ><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
