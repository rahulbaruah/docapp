@extends('AdminLTE.admin_template')

@section('css')
	@parent
<link href="/bower_components/AdminLTE/plugins/select2/select2.min.css" rel="stylesheet" />
<style type="text/css">
	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    line-height: inherit;
	}
</style>
@endsection

@section('content')
<!-- message --->
<?php if(session()->has('msg')){ $msg = array_flatten(session('msg')); }
if(count($errors) > 0){ $msg = $errors->all(); }
 ?>
<div class="alert alert-warning alert-dismissable" style="{{ empty($msg) ? 'display:none' : '' }}">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>
<span class="msg">
@if (!empty($msg))
		<ul style="margin:0">
		@foreach ($msg as $errmsg)
			<li>{{ $errmsg }}</li>
		@endforeach
		</ul>
@endif
</span>
</div>
<!-- //message --->

<div class="col-md-10">
<form class="form-horizontal" role="form" action="/newpatient" method="post" enctype="multipart/form-data">
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">New Patient Entry</h3>
    </div>
	<div class="box-body">
	        <div class="form-group">
				<label class="col-sm-4 control-label">Patient Name:*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="name" required autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Phone No:*</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="phone" required autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Doctor Referred By:*</label>
				<div class="col-sm-8">
					<select class="form-control" name="doctor_id" required>
					    @foreach ($doctors as $index=>$doctor)
					    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
					    @endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Discount(%):</label>
				<div class="col-sm-8">
					<input type="text" name="discount" class="form-control">
				</div>
			</div>
	</div>
	<div class="box-footer">
		{{ csrf_field() }}
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
</form>
</div>
<div class="clearfix"></div>
@endsection

@section('js')
	@parent
<script src="/bower_components/AdminLTE/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
  $('select[name="doctor_id"]').select2({
  placeholder: "Select Doctor",
  allowClear: true
	});
</script>
@endsection