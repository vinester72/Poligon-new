@php
/** @var \App\Models\BlogCategory $item */
/** @var \Illuminate\Support\Collection $categoryList */
@endphp
<div class="row justify-content-center">
	<div class="col-md-12 mb-4">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="card-title"></div>
				<ul class="nav nav-tabs admin-nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active text-center" data-toggle="tab" href="#maindata" rol="tab">Основные данные</a>
					</li>
				</ul>
				<br>
				<div class="tab-content">
					<div class="tab-pane active" id="maindata" role="tabpanel">
						<div class="form-group">
							<label for="title">Заголовок</label>
							<input type="text"
									 	name="title" 
										value="{{ old('title', $item->title) }}" 
										id="title" 
										class="form-control rounded-0" 
										minlength="3" 
										required="">
						</div>

						<div class="form-group">
							<label for="slug">Идентификатор</label>
							<input type="text" 
										name="slug" 
										value="{{ old('slug', $item->slug) }}" 
										id="slug" 
										class="form-control rounded-0">
						</div>

						<div class="form-group">
							<label for="parent_id">Родитель</label>
							<select name="parent_id" 
										id="parent_id" 
										class="form-control rounded-0 " 
										placeholder="Выберите категорию"
										required>
								@foreach($categoryList as $categoryOption)
									<option value="{{ $categoryOption->id }}"
										@if($categoryOption->id == $item->parent_id) selected @endif>
										{{-- {{ $categoryOption->id }}. {{ $categoryOption->id_title }} --}}
										{{ $categoryOption->id_title }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="form-group form-group-size">
							<label for="description">Описание</label>
							<textarea name="description" 
											id="description" 
											class="form-control rounded-0" 
											rows="3">
							{{ old('description', $item->description) }}
							</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
