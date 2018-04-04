@if(Session::has('success_add_cat'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_add_cat')}}</strong>
</div>
@endif

@if(count($errors)>0)
    @foreach($errors->all() as $err)
        <div class="alert alert-danger">
            {{$err}}<br>
        </div>
    @endforeach
@endif
@if(Session::has('success_del_cat'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_del_cat')}}</strong>
</div>
@endif
@if(Session::has('success_edit_cat'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_edit_cat')}}</strong>
</div>
@endif
@if(Session::has('success_add_pro'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_add_pro')}}</strong>
</div>
@endif
@if(Session::has('success_edit_pro'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_edit_pro')}}</strong>
</div>
@endif
@if(Session::has('success_del_pro'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_del_pro')}}</strong>
</div>
@endif
@if(Session::has('error_login'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('error_login')}}</strong>
</div>
@endif
@if(Session::has('error_level'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('error_level')}}</strong>
</div>
@endif
@if(Session::has('success_login'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_login')}}</strong>
</div>
@endif
@if(Session::has('success_post'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_post')}}</strong>
</div>
@endif
@if(Session::has('success_signup'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success_signup')}}</strong>
</div>
@endif