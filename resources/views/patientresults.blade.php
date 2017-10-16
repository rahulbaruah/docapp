@extends('AdminLTE.admin_template')

@section('title', 'Referred Patients')

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

<div class="box">
	<div class="box-header">
        <!--<h3 class="box-title">Hover Data Table</h3>-->
    </div>
    <div class="box-body">
<div class="table-responsive">
<table id="allDataTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Sl</th>
			<th>Patient Name</th>
			<th>Phone</th>
			<th>Doctor Referred By</th>
			<th>Referred Date</th>
			<th>Arrival Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
@foreach ($referred as $key=>$refer)
		<tr>
			<td>{{ ($key+1) }}</td>
			<td>{{ $refer->patient->name }}</td>
			<td>{{ $refer->patient->phone }}</td>
			<td>{{ $refer->doctor->name }}</td>
			<td>{{ ConvertDate2($refer->created_at) }}</td>
			<td>{{ $refer->arrived_at ? ConvertDate2($refer->arrived_at) : 'N/A' }}</td>
			<td>
				<a class="btn btn-default" href="/showreferred/{{$refer->id}}" role="button" title="Referred Patient Entry">
					<i class="fa fa-caret-right" aria-hidden="true"></i>
				</a>
			</td>
		</tr>
@endforeach
	</tbody>
</table>
</div>
</div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="/js/jquery.confirm.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.delBtn', function(event){
			event.preventDefault();
			var url = $(this).data("href");
			$.confirm({
				text: "Confirm deletion",
			    confirm: function() {
			        $.ajax({
					    url: url,
					    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
					    type: 'DELETE',
					    success: function(result) {
					        window.location.reload();
					    }
					});
			    },
			    cancel: function() {
			        // nothing to do
			    },
			    confirmButton: "Yes",
			    cancelButton: "No",
			    post: true,
			    confirmButtonClass: "btn-danger",
			    cancelButtonClass: "btn-default",
			    dialogClass: "modal-dialog modal-sm"
			});
		});
		
		var table = $('#allDataTable').DataTable({
		"aaSorting": [[ 0, "desc" ]],
	});
	
	});
</script>
@endsection