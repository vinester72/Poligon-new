@extends('blog.admin.layouts.app' , [ 'activePage' => 'users'])
@section('breadcrumb-item')
    <li class="breadcrumb-item active">Пользователи</li>
@endsection
@section('content')
<div class="container-fluid mx-0">
	<div class="row justify-content-center">
		<div class="col-12">
			@include('blog.admin.users.includes.result_messages')
			
			<nav class="col-12 col-lg-3 navbar navbar-toggleable-md navbar-light bg-faded px-0 py-4">
				<a class="btn btn-block btn-lg btn-primary info-btn rounded-0" href="{{ route('blog.admin.users.create') }}">
					Добавить 
					<i class="fas fa-plus ml-2 "></i>
				</a>
			</nav>
			<div class="card border-0" style="background: transparent">
				<div class="card-body table-full-width table-responsive  strpied-tabled-with-hover px-0">
					<table class="table table-hover mb-0 bg-white" id="dataTable" width="100%" cellspacing="0">
						<thead class="thead-blue">
						<tr class="admin-tr-red">
		
								<th>Имя</th>
								<th>Email</th>
								<th>Роль</th>
								<th>Блокировка</th>
								<th>Опции</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($users as $user)
								<tr>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									
									@if($user->role_id == null)
										<td>No Group</td>
									@elseif ( $user->role_id == 1)
										<td>администратор</td>
									@elseif ($user->role_id == 2)
										<td>менеджер</td>
									@elseif ($user->role_id == 3)
										<td>пользователь</td>			
									@endif
									<td>
										@if($user->is_blocked == 0)
												<p>Разблокований</p>
										@else
												<p>Заблокований</p>
										@endif
									</td>
									<td>
		
										<a href="" title="Показать">
												<i class="fas fa-eye"></i>
										</a>
		
										<a href="" title="Редактировать">
												<i class="fas fa-edit"></i>
										</a>
		
										<a data-toggle="modal" id="smallButton" data-target="#smallModal"
											{{-- data-attr="{{ route ('admin.users.modal.ajax.delete', $user->id) }}" --}}
											data-id="{{$user->id}}"
											title="Удалить">
												<i class="fas fa-trash text-danger"></i>
										</a>
		
									</td>
								</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>		
</div>	

@endsection