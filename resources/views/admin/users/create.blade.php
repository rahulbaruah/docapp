@extends('AdminLTE.admin_template')

@section('title', 'New Users')

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

<div class="col-md-8">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">New User Form</h3>
            </div>
						<form class="form-horizontal" role="form" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Name:*</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="name" value="{{old('name')}}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email:*</label>
							<div class="col-sm-9">
							<input type="email" class="form-control" name="email" value="{{old('email')}}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Role:</label>
							<div class="col-sm-9">
							<select name="role" class="form-control">
							    <option value="">None</option>
							    <option value="admin">Admin</option>
							    <option value="operator">Operator</option>
							</select>
							</div>
						</div>
						@section('js')
						    @parent
						<script type="text/javascript">
						    $(document).ready(function(){
						       $('select[name="role"]').val("{{old('role')}}"); 
						    });
						</script>
						@endsection
						<div class="form-group">
							<label class="col-sm-3 control-label">Password:*</label>
							<div class="col-sm-9">
							<input id="my-input-element" type="text" class="form-control" name="password" value="" required>
							<p class="help-block">Store the password in a safe palce</p>
							<a href="#" id="demo">Generate a password</a>
							</div>
						</div>
						@section('js')
						<script src="/js/pGenerator.jquery.js"></script>
						<script type="text/javascript">
						    $(function(){
						        $('#demo').pGenerator({
                                  // Bind an event to #myLink which generate a new password when raised;
                                  'bind': 'click', 
                                
                                  // Selector for the form input which will contain the new generated password;
                                  'passwordElement': '#my-input-element', 
                                
                                  // Selector which will display the new generated password;
                                  //'displayElement': '#my-display-element',
                                
                                  // Length of the generated password.
                                  'passwordLength': 10, 
                                
                                  // Password will contain uppercase letters;
                                  'uppercase': true, 
                                
                                  // Password will contain lowercase letters;
                                  'lowercase': true, 
                                
                                  // Password will contain numerical characters;
                                  'numbers':   true, 
                                
                                  // Password will contain numerical characters;
                                  'specialChars': false, 
                                
                                  // Extra special chars
                                  //'additionalSpecialChars': [],
                                
                                  // Callback function which will be called each time a new password is generated;
                                  'onPasswordGenerated': function(generatedPassword) {
                                    //alert('My new generated password is ' + generatedPassword); 
                                  }
                                  
                                });
						    });
						</script>
						@endsection
			</div>
			<!--<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />-->
			{{ csrf_field() }}
			<div class="box-footer">
			<button name="action" type="submit" value="SUBMIT" class="btn btn-primary">Submit</button>
			</div>
	</form>
</div>
</div>

@endsection