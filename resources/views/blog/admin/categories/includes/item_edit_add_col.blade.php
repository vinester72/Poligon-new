@php
	/** @var \App\Models\BlogCategory $item */
	/** @var \Illuminate\Support\Collection $categoryList */
@endphp
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<button type="submit" class="btn btn-primary info-btn rounded-0 btn-block">Сохранить</button>
			</div>
		</div>
	</div>
</div>
<br>
@if($item->exists)
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card rounded-0 shadow">
				<div class="card-body">
					<ul class="list-unstyled">
						<li>ID: {{ $item->id }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card rounded-0 shadow">
				<div class="card-body">
			
				<div class="form-group">
						<label for="title">Создано</label>
						<input type="text" value="{{ $item->created_at }}" class="form-control rounded-0" disabled>
					</div>
			
				<div class="form-group">
						<label for="title">Изменено</label>
						<input type="text" value="{{ $item->updated_at }}" class="form-control rounded-0" disabled>
					</div>
			
				<div class="form-group">
						<label for="title">Удалено</label>
						<input type="text" value="{{ $item->deleted_at }}" class="form-control rounded-0" disabled>
					</div>
				</div>
			</div>
		</div>
	</div><br>

@endif