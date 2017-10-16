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
<div class="box box-info">
	
	<div class="box-body">
		
		<div class="panel panel-default">
			<form class="form-horizontal" role="form" action="/searchpatientform" method="get">
			<div class="panel-heading"><h3>Search Referred Patients</h3></div>
			<div class="panel-body">
			    <div class="form-group">
					<label class="col-sm-3 control-label">Patient:</label>
					<div class="col-sm-9">
						<select name="patient_id" class="form-control select2" style="width: 100%;">
							<option value="" selected="selected">Select</option>
						    @foreach ($patients as $patient)
						    <option value="{{$patient->id}}">{{ $patient->name }}</option>
						    @endforeach
						</select>
					</div>
				</div>
				
				<div class="form-group">
						<label class="col-sm-3 control-label">Doctor Referred By:</label>
						<div class="col-sm-9">
							<select name="doctor_id" class="form-control select2" style="width: 100%;">
							    <option value="" selected="selected">Select</option>
							    @foreach ($doctors as $doctor)
							    <option value="{{$doctor->id}}">{{ $doctor->name }}</option>
							    @endforeach
							</select>
						</div>
				</div>
			
    			<div class="box-footer">
    			<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
    			</div>
			</div>
			</form>
		</div>
	</div>
</div>
</div>
<div class="clearfix"></div>
@endsection

@section('js')
	@parent
<script src="/bower_components/AdminLTE/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
  $('select[name="patient_id"]').select2({
  placeholder: "Select Patient",
  allowClear: true
	});
	
	$('select[name="doctor_id"]').select2({
  placeholder: "Select Doctor Referred by",
  allowClear: true
	});
</script>
@endsection