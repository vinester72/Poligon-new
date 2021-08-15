@php
/** @var \App\Models\BlogPost $item */
@endphp
<div class="row justify-content-center">
	<div class="col-md-12 mb-4">
		<div class="card rounded-0 shadow">
			<div class="card-header card-header-blue">
				@if($item->is_published)
					Опубликовано 
				@else
					Черновик 
				@endif
			</div>
			<div class="card-body">
				<div class="card-title"></div>
				<ul class="nav nav-tabs admin-nav-tabs" role="tablist">
					<li class=" nav-item">
						<a class="nav-link active text-center" data-toggle="tab" href="#maindata" rol="tab">Основные данные</a>
					</li>
					<li class=" nav-item">
						<a class="nav-link text-center" data-toggle="tab" href="#adddata" rol="tab">Доп. данные</a>
					</li>
				</ul>
				<div class="tab-content mt-3">
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
						<div class="form-group form-group-size edit-page">
							<label for="content_raw">Cтатья</label>
							<textarea name="content_raw" 
											id="content_raw" 
											class="form-control tiny rounded-0" 
											rows="12">
							{{ old('content_raw', $item->content_raw) }}
							</textarea>
						</div>
					</div>
					<div class="tab-pane" id="adddata" role="tabpanel">
						<div class="form-group">
							<label for="category_id">Категория</label>
							<select  name="category_id"  
										id="category_id" 
										class="form-control rounded-0" 
										placeholder="Выберите категорию" 
										required="">
								@foreach($categoryList as $categoryOption)
									<option value="{{ $categoryOption->id }}"
										@if($categoryOption->id == $item->category_id) selected @endif>
										{{ $categoryOption->id_title }}
									</option>
								@endforeach		
							</select>
						</div>
						<div class="form-group">
							<label for="slug">Идентификатор</label>
							<input type="text"
									 	name="slug" 
										value="{{ old('slug', $item->slug) }}" 
										id="slug" 
										class="form-control rounded-0">
						</div>
						<div class="form-group form-group-size">
							<label for="excerpt">Выдержка из статьи</label>
							<textarea name="excerpt" 
											id="excerpt" 
											class="form-control rounded-0" 
											rows="3">
							{{ old('excerpt', $item->excerpt) }}
							</textarea>
						</div>
						
						<div class="form-check ">
							<input   name="is_published"
										type="hidden"
										value="0">
							<input   type="checkbox"
									 	name="is_published" 
										value="1" 
										class="form-check-input rounded-0"
										@if($item->is_published)
										checked="checked"
										@endif>
							<label class="form-check-label" for="is_published">Опубликовано</label>			
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
