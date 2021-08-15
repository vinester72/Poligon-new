<ol class="breadcrumb mb-2">
	<li class="breadcrumb-item {{ Request::is('admin') ? 'active' : ''  }}">
		 @if(Request::is('admin'))
			  Главная
		 @else
			  <a href="{{ route('blog.admin.dashboard') }}">Главная</a>
		 @endif
	</li>
	@yield('breadcrumb-item')
</ol>