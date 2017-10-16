@extends('AdminLTE.admin_template')

@section('title', 'Update Doctor Details')

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
              <h3 class="box-title">Edit User</h3>
            </div>
						<form class="form-horizontal" role="form" action="{{ route('doctors.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Name:</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="name" value="{{$user->name}}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email:</label>
							<div class="col-sm-9">
							<input type="email" class="form-control" name="email" value="{{$user->email}}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Phone:</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="phone" value="{{$user->phone}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Speciality:</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="speciality" value="{{$user->speciality}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Password:</label>
							<div class="col-sm-9">
							<input id="my-input-element" type="text" class="form-control" name="password" value="">
							<p class="help-block">Leave the password field blank if you dont want to change the password</p>
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
			<input type="hidden" name="_method" value="PUT">
			<div class="box-footer">
			<button name="action" type="submit" value="SUBMIT" class="btn btn-primary">Submit</button>
			</div>
	</form>
</div>
</div>

@endsection