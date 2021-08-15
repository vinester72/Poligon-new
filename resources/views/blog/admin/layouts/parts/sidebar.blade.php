<nav id="sidebar" class="sidebar pb-4 px-0">
	<nav class="navbar navbar-expand-lg px-0  mb-4">
		<div class="container-fluid ">
			<a href="/" class="main-link text-center ">
				<h3 class="text-white ml-3 ml-xl-0 mb-0">Poligon-Blog</h3>
			</a>
			 <button type="button" id="sidebarCollapse" class="navbar-btn ml-auto border-0" title="Скрыть sitebar">
				  <span></span>
				  <span></span>
				  <span></span>
		  </button>
		</div>
  </nav>
  	{{-- <a href="/" class="main-link text-center">
		<h3 class="text-white  mb-4">Poligon-Blog</h3>
	</a> --}}
	<div class="sidebar-header mx-3">
		<div class="d-flex">
			<div class="admin-upload-photo px-0 mx-0">
				<div class="admin-foto d-flex justify-content-center mx-auto ">
					 <div type="submit" class="admin-foto-person  w-100 ">
						  <label class=" mx-auto w-100 h-100">
								{{-- <img src="{{ asset("/img/avatar-user.svg") }}" class=" page-photo-person w-100 h-100"> --}}
						  </label>
					 </div>
				</div>
		  </div>
		  <div class="font-weight-bold my-auto ml-4">
			  {{ Auth::user()->name }}
		 	</div>
		</div>
		 
		 <div class="font-weight-bold mt-2">
			  {{ Auth::user()->email }}
		 </div>
	</div>
	<ul class="nav list-unstyled components px-3">
		 @include('blog.admin.layouts.parts.menu')
	</ul>
</nav> 