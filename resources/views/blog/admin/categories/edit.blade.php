@extends('blog.admin.layouts.app', [ 'activePage' => 'categories'])
@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('blog.admin.categories.index') }}">Категории</a></li>
	 @if(Route::currentRouteName()=='blog.admin.categories.edit' )
	   <li class="breadcrumb-item active" aria-current="page">Страница редактирования</li>
	 @elseif(Route::currentRouteName()=='blog.admin.categories.create')
	 <li class="breadcrumb-item active" aria-current="page">Страница создания</li>
	 @endif  
	

@endsection
@section('content')
	
	<div class="container-fluid">
		@php /** @var \App\Models\BlogCategory $item */ @endphp

		@if($item->exists)
		<form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}">
			@method('PATCH')
			{{-- <h2 class="">
				Страница редактирования
			</h2> --}}
		@else
		<form method="POST" action="{{ route('blog.admin.categories.store') }}">
			{{-- <h2 class="">
				Страница создания
			</h2> --}}
		@endif
			@csrf
		@php
			/** @var \Illuminate\Support\ViewErrorBag $errors */
		@endphp
			@if($errors->any())
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="alert alert-danger rounded-0" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">x</span>
							</button>
							{{ $errors->first() }}
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
			<div class="row justify-content-center pt-3">
				<div class="col-lg-8">
					@include('blog.admin.categories.includes.item_edit_main_col')
				</div>
				<div class="col-lg-4 ">
					@include('blog.admin.categories.includes.item_edit_add_col')
				</div>
			</div>
		</form>
	</div>
@endsection