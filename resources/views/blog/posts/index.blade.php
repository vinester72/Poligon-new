@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		  <div class="col-12 col-lg-10 mx-auto py-3">
				<div class="card bg-white shadow rounded-0 p-5">
					<h2>Posts</h2>
					<table>
						@foreach($items as $item)
							<tr>
									<td>{{ $item->id }}</td>
									<td>{{ $item->title }}</td>
									<td>{{ $item->created_at }}</td>
							</tr>
						@endforeach
					</table> 
				</div>
		 </div>
	</div>
</div>
@endsection