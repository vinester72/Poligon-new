@extends('blog.admin.layouts.app' , [ 'activePage' => 'posts'])
@section('breadcrumb-item')
    <li class="breadcrumb-item active">Статьи</li>
@endsection
@section('content')
<div class="container-fluid mx-0">
	<div class="row justify-content-center">
		<div class="col-12">
			{{-- <h2>
				Статьи
			</h2> --}}
			@include('blog.admin.posts.includes.result_messages')
			
			<nav class="col-12 col-lg-3 navbar navbar-toggleable-md navbar-light bg-faded px-0 py-4">
				<a class="btn btn-block btn-lg btn-primary info-btn rounded-0" href="{{ route('blog.admin.posts.create') }}">
					<i class="fas fa-feather-alt text-white mr-2"></i>
					Написать
				</a>
			</nav>
			
			<div class="card  rounded-0 shadow">
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table  table-hover mb-0 ">
							<thead class="thead-blue">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Автор</th>
									<th scope="col">Категория</th>
									<th scope="col">Заголовок</th>
									<th scope="col">Дата публикации</th>
								</tr>
							</thead>
							<tbody>
							   @foreach($paginator as $post)
								@php
								 	/** @var \App\Models\BlogPost $post */
								@endphp
								<tr class="border-bottom"
								@if(!$post->is_published && $post->deleted_at == null) 
									style="background-color: #747dc013"
								@elseif(!$post->is_published && $post->deleted_at)
									style="color:#747dc060; background-color: #747dc013" title="Удалён"
								@elseif($post->is_published && $post->deleted_at)
									style="color:#747dc060" title="Удалён"				
								@endif>
							
									<th scope="row">{{ $post->id }}</th>
									<td scope="row">{{ $post->user->name }}</td>
									<td scope="row">{{ $post->category->title }}</td>
									<td>
										<a class="category-link" href="{{ route('blog.admin.posts.edit', $post->id) }}" @if($post->deleted_at) 
											style=" color: #747dc060;"
									@endif>
											{{ $post->title }}
										</a>
									</td>
									<td>
										{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.m.Y H:i') : '' }}
									</td>
									{{-- <td class="d-flex">
										<form method="POST" action="{{ route('blog.admin.categories.destroy', $item->id) }}">
											@method('DELETE')
											@csrf
											@if($item->deleted_at) 
												<a href="{{ route('restoreDeleted', $item->id) }}" title="Восстановить категорию">
													<i class="fas fa-window-restore text-success  fa-lg ml-2"></i>
											  </a> 
											@else
												<button type="submit" class="btn btn-sm " title="Удалить категорию">
													<i class="fas fa-trash-alt text-danger  fa-lg"></i>
												</button>
											
											@endif
										</form>
									</td> --}}
								</tr>
								@endforeach 
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if($paginator->total() > $paginator->count())
	<br>
	<div class="row justify-content-center">
		<div class="col-md-12 d-flex justify-content-center">
			{{ $paginator->onEachSide(1)->links() }}
		</div>
	</div>
	@endif
</div>


@endsection