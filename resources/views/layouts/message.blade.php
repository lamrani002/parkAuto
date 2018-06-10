@if(session()->has('success'))

				<div class="row bod">
					<div class="alert alert-success col-md-8 col-md-offset-2">
						{{session()->get('success')}}
					</div>
				</div>
@endif

@if(session()->has('danger'))

				<div class="row bod">
					<div class="alert alert-danger col-md-8 col-md-offset-2">
						{{session()->get('danger')}}
					</div>
				</div>
@endif
