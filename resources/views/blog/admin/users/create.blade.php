
@extends('blog.admin.layouts.app' , [ 'activePage' => 'users'])
@section('breadcrumb-item')
<li class="breadcrumb-item"><a href="{{ route('blog.admin.users.index') }}">Пользователи</a></li>	
    <li class="breadcrumb-item ">Добавить пользователя</li>
@endsection
@section('content')
<div class="container-fluid mx-0">
	<div class=" justify-content-center">
    <form method="POST" action="{{ route('blog.admin.users.store') }}">
        @csrf

        <div class="col-12">
        </div>
        <div class="card strpied-tabled-with-hover rounded-0 mb-4">
            <div class="card-body table-full-width table-responsive ">
                <div class="col-sm-12">
                    <label for="inputName" class="col-xs-2 control-label"><strong>Ім'я:</strong></label>
                    <div class="col-xs-8">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Введіть ім'я"
                               value="{{old('name')}}">
                        @error('name')
                        <div class="alert alert-danger">{{ "Помилка! Некоректний формат імені" }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-lg-12 mb-2">
                    <label for="inputEmail" class="col-xs-2 control-label"><strong>Електронна пошта:</strong></label>
							<div class="col-xs-8">
								<input type="text" name="email" class="form-control" id="inputEmail"
										placeholder="Введіть електронну пошту користувача" value="{{old('email')}}">
								@error('email')
								<div class="alert alert-danger">{{ "Помилка! Некоректний формат електронної пошти" }}</div>
								@enderror
							</div>
					</div>
                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="role_id"><strong>Роль:</strong></label>
                <select name="role_id" id="role_id" class="form-control">
                    <option value="">Оберіть роль</option>
                    @foreach($roleList as $roleOption)
                        <option value="{{ $roleOption->id }}">
                            {{ $roleOption->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                <div class="alert alert-danger">{{ "Помилка! Некоректний формат ролі" }}</div>
                @enderror
            </div>
        </div>
                <div class="form-group col-lg-12 mb-2">
            <label for="inputPassword" class="col-xs-2 control-label"><strong>Пароль:</strong></label>
            <div class="col-xs-8">
                <input type="password" name="password" class="form-control" id="inputPassword"
                       placeholder="Введіть пароль">
                @error('password')
                <div class="alert alert-danger">{{ "Помилка! Некоректний формат пароля" }}</div>
                @enderror
            </div>
        </div>
            </div>
        </div>
        <div class="col-12 pl-0 d-sm-flex">
            <div class="mr-4 mb-4 ">
                <a class="btn btn-block btn-lg btn-primary info-btn rounded-0 px-4" href="{{ route('blog.admin.users.index') }}" title="Go back">
                    <small><i class="fas fa-backward  mr-2"></i>Вернуться</small>
                </a>
            </div>
            <div class="form-group pl-0">
                <div class=" pl-0">
                    <button type="submit" class="btn btn-block btn-lg btn-primary info-btn rounded-0 px-5"> <small>Создать
                       
                        </small>
                    </button>
                </div>
            </div>
        </div>
    </form>
	</div>
</div>		 
@endsection

