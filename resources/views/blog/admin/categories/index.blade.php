@extends('blog.admin.layouts.app' , [ 'activePage' => 'categories'])

@section('breadcrumb-item')
    <li class="breadcrumb-item active">Категории</li>
@endsection
@section('content')

<div class="container-fluid mx-0">
	<div class="row clearfix pt-3">
		<div class="col-12">
			
			<nav class="col-12 col-lg-3 navbar navbar-toggleable-md navbar-light bg-faded px-0 py-4">
				<a class="btn btn-block btn-lg btn-primary info-btn rounded-0" href="{{ route('blog.admin.categories.create') }}">
					Добавить
					<i class="fas fa-plus ml-2 "></i>
				</a>
			</nav>
			
			@if(session('success'))
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">x</span>
						</button>
						{{ session()->get('success') }}
					</div>
				</div>
			</div>
			@endif
			<div class="card strpied-tabled-with-hover rounded-0 shadow">
				<div class="card-body table-full-width table-responsive p-0">
					<div class="table-responsive strpied-tabled-with-hover">
						<table class="table  table-hover mb-0"  width="100%" cellspacing="0">
							<thead class="thead-blue">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Kатегория</th>
									<th scope="col">Родитель</th>
									<th scope="col">Опции</th>
									{{-- <th scope="col">Удалить<br> из БД</th> --}}
								</tr>
							</thead>
							<tbody>
								@foreach($paginator as $item)
								@php /** @var \App\Models\BlogCategory $item */ @endphp
								<tr class="border-bottom">
	
									<th scope="row">{{ $item->id }}</th>
									<td>
										<a class="category-link " href="{{ route('blog.admin.categories.edit', $item->id) }}" title="Редактировать">
											{{ $item->title }}
										</a>
									</td>
									<td @if(in_array($item->parent_id, [0, 1])) style="color: #ccc" @endif>
										{{-- {{ $item->parent_id }} --}}
										{{-- {{ $item->parentCategory->title ?? '?' }} --}}
										{{-- {{ optional($item->parentCategory)->title}} --}}
										{{-- {{
											$item->parentCategory->title
												?? ($item->id === \App\Models\BlogCategory::EP_ROOT
													? 'Корень' : '???')
										}} --}}
										{{-- {{ $item->parent_title }} --}}
										{{ $item->parentTitle }}

									</td>
									<td class="d-flex align-items-center">
										
										<a class="category-link d-flex align-items-center mr-1" href="{{ route('blog.admin.categories.edit', $item->id) }}" title="Редактировать">
											<i class="fas fa-edit"></i>
										</a>
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
									</td>
									{{-- <td>
										
											<a href="{{ route('deletePermanently', $item->id) }}" title="Удалить из базы">
												<i class="fas fa-trash text-danger  fa-lg"></i>
										  </a>
										  
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
			{{ $paginator->links() }}
		</div>
	</div>
	@endif
</div>
@endsection