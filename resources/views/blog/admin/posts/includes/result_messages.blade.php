@if($errors->any())
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="alert alert-danger rounded-0" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				{{-- {{ $errors->first() }} --}}
				@foreach ($errors->all() as $errorTxt)
					 <li>{{ $errorTxt}}</li>
				@endforeach
			</div>
		</div>
	</div>
	@endif

	@if(session('success'))
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="alert alert-success rounded-0" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				{{ session()->get('success') }}
			</div>
		</div>
	</div>
@endif