<p class="text-border w-100 mt-2 mb-0 pb-0">
</p>
{{-- <li class="nav-item py-0 active">
	<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-link w-100 mt-3 pt-2 font-weight-bold" >
		Статьи
	</a> --}}
	<ul class=" list-unstyled" id="homeSubmenu" >
		<li class="nav-item  {{ $activePage == "dashboard" ? 'active' : '' }} py-0 ">
			<a href="{{route("blog.admin.dashboard")}}" class=" sidebar-link d-flex text-black">
				 <div class=" mr-3 px-0">
					  <i class="fas fa-tachometer-alt nav-item-img mr-1"></i>
				 </div>
				 <p class="mb-0 py-0">
					Главная
				 </p>
			</a>
		</li>
		@role('admin')
			<li class="nav-item  {{ $activePage == "users" ? 'active' : '' }} py-0 ">
				<a href="{{route("blog.admin.users.index")}}" class=" sidebar-link d-flex text-black">
					<div class=" mr-3 px-0">
						<i class="fas fa-users nav-item-img mr-1"></i>
					</div>
					<p class="mb-0 py-0">
						Пользователи
					</p>
				</a>
			</li>
		@endrole	
		<li class="nav-item  {{ $activePage == "categories" ? 'active' : '' }} py-0 ">
			<a href="{{route("blog.admin.categories.index")}}" class=" sidebar-link d-flex text-black">
				 <div class=" mr-3 px-0">
					  <i class="fas fa-paste nav-item-img mr-1"></i>
				 </div>
				 <p class="mb-0 py-0">
					Категории статей
				 </p>
			</a>
		</li>
		
		<li class="nav-item  {{ $activePage == "posts" ? 'active' : '' }} py-0 ">
			<a href="{{route("blog.admin.posts.index")}}" class=" sidebar-link d-flex text-black">
				 <div class=" mr-3 px-0">
					  <i class="fas fa-list nav-item-img mr-1"></i>
				 </div>
				 <p class="mb-0 py-0">
					Статьи
				 </p>
			</a>		
		</li>
  </ul>
</li>


<p class="text-border w-100 mt-4">
</p>

<li class="nav-item  py-0 ">
	<a class="sidebar-logout d-flex" href="{{ route('logout') }}" onclick="event.preventDefault();
																	 document.getElementById('logout-form').submit();" class="sidebar-link d-flex">
		 <div class=" mr-3">
			  {{-- <img class="nav-item-img  mt-0 " src="/img/logout.svg"> --}}
			  <i class="fas fa-sign-out-alt"></i>
		 </div>
		 <p class=" mb-0 py-0">
			  Выход
		 </p>
	</a>
{{-- </li> --}}

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
	@csrf
</form>

