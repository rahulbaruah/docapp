@extends('AdminLTE.admin_template')

@section('title', 'Doctors')

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
			<th data-col="show">Sl</th>
			<th data-col="show">Name</th>
			<th data-col="show">E-mail</th>
			<th data-col="show">Speciality</th>
			<th data-col="show">Action</th>
		</tr>
	</thead>
	<tbody>
@foreach ($users as $key=>$user)
		<tr>
			<td>{{ ($key+1) }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->speciality }}</td>
			<td>
				<a class="btn btn-default" href="{{ route('doctors.edit', ['id' => $user->id]) }}" role="button" title="Edit">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</a>
				@if ($user->id > 1)
				<a class="delBtn btn btn-danger" href="#" data-href="{{ route('doctors.destroy', ['id' => $user->id]) }}" role="button" title="Delete">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
				@endif
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