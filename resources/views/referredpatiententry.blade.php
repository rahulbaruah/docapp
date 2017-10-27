@extends('AdminLTE.admin_template')

@section('title', 'Referred Patient Entry')

@section('css')
<link rel="stylesheet" href="/css/jquery.datetimepicker.min.css" type="text/css" />
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
	    <div class="row">
	    <p><span class="col-md-4"><strong>Patient Name:</strong></span> {{ $referred->patient->name }}</p>
	    <p><span class="col-md-4"><strong>Doctor Referred By:</strong></span> {{ $referred->doctor->name }}</p>
	    <p><span class="col-md-4"><strong>Discount:</strong></span> {{ $referred->discount }}</p>
	    <p><span class="col-md-4"><strong>Referred Date:</strong></span> {{ ConvertDate($referred->created_at) }}</p>
	    </div>
	</div>
</div>
<form class="form-horizontal" role="form" action="/updatereferred/{{$referred->id}}" method="post" enctype="multipart/form-data">
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Enter Patient Arrival</h3>
    </div>
	<div class="box-body">
	        <div class="form-group">
				<label class="col-sm-4 control-label">Arrival Date & Time:*</label>
				<div class="col-sm-8">
					<input id="datetimepicker" type="text" class="form-control" name="arrived_at" required value="{{$referred->arrived_at}}" autocomplete="off">
				</div>
			</div>
			@section('js')
			<script type="text/javascript" src="/js/jquery.datetimepicker.full.min.js"></script>
			<script type="text/javascript">
			    $(document).ready(function(){
			        jQuery('#datetimepicker').datetimepicker();
			    })
			</script>
			@endsection
	   		<div class="form-group">
				<label class="col-sm-4 control-label">Doctor's Collection (<i class="fa fa-inr"></i>):</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="commission" value="{{$referred->commission}}">
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