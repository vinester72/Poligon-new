@extends('blog.admin.layouts.app', [ 'activePage' => 'posts'] )
@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('blog.admin.posts.index') }}">Статьи</a></li>
	 @if(Route::currentRouteName()=='blog.admin.posts.edit')
	 <li class="breadcrumb-item active">Страница редактирования</li>
	 @elseif(Route::currentRouteName()=='blog.admin.posts.create')
	 <li class="breadcrumb-item active">Страница создания</li>
	 @endif
@endsection
@section('content')
	@php /** @var \App\Models\BlogPost $item */ @endphp
	<div class="container-fluid">
		
		@if($item->exists)
		<form method="POST" action="{{ route('blog.admin.posts.update', $item->id) }}">
			@method('PATCH')
			{{-- <h2 class="">
				Страница редактирования
			</h2> --}}
		@else
		<form method="POST" action="{{ route('blog.admin.posts.store') }}">
			{{-- <h2 class="">
				Страница создания
			</h2> --}}
		@endif
			@csrf
		@php
			/** @var \Illuminate\Support\ViewErrorBag $errors */
			@endphp
			@include('blog.admin.posts.includes.result_messages')
			<div class="row justify-content-center pt-3">
				<div class="col-lg-8">
					@include('blog.admin.posts.includes.post_edit_main_col')
				</div>
				<div class="col-lg-4 ">
					@include('blog.admin.posts.includes.post_edit_add_col')
				</div>
			</div>
		</form>
		@if($item->exists)	
		<form method="POST" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
			@method('DELETE')
			@csrf
			<div class="row justify-content-end ">
				<div class="col-lg-4">
					@if($item->deleted_at ) 
						
						<a href="{{ route('blog.admin.posts.restore', $item->id) }}" title="Восстановить статью" class="btn btn-primary info-btn rounded-0 btn-block py-2 ">
							Восстановить
							<i class="fas fa-window-restore  ml-2"></i>
						</a>
						
					@elseif($item->name != 'Admin' )
					<button type="submit"
						href=""
						data-toggle="modal"
						data-target=""
						class="btn btn-primary info-btn rounded-0 btn-block py-2 ">
						Удалить
						{{-- <i class="fas fa-trash-alt"></i> --}}
						<i class="far fa-trash-alt ml-2"></i>
					</button>
					@endif
				</div>
			</div>	
		</form>
		@endif							
	</div>
@endsection