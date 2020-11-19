@extends('admin.layouts.admin')
@section('content')
	<div class="row">
		<div class="col-12">
			<h1>Dashboard </h1>
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
		
			
							
			<div class="card">
				<div class="card-body">
				<div class="table-responsive"  id="tag_container">
					 
						<h5>Coming Soon...</h5>

				</div>
				</div>
			</div>

		</div>
	</div>
	
	
@section('userJs')
<script src="{{ asset('js/module/user.js')}}"></script>	
@stop
@endsection

	