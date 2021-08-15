<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Repositories\BlogCategoryRepository;
use App\Observers\BlogCategoryObserver;

class CategoryController extends BaseController
{

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(__METHOD__);
        // $paginator = BlogCategory::withTrashed()->paginate(5);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(10);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(__METHOD__);
        $item = new BlogCategory();
        // $categoryList = BlogCategory::all();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        // dd(__METHOD__);

        // $data = $request->all();
        $data = $request->input();
        /*
       //Ушло в обсервер
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        */


        //певый способ создания
        //Создаст объект, но добавит в БД
        // $item = new BlogCategory($data);
        // $item->save();

        //второй способ
        //Создаст объект и добавит в БД
        $item = (new BlogCategory())->create($data);

        if ($item->exists) {
            return redirect()
                    ->route('blog.admin.categories.edit', [$item->id])
                    ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                    ->withErrors(['msg' => 'Ошибка сохранения'])
                    ->withInput();
        }


    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     dd(__METHOD__);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd(__METHOD__);
        // $categoryRepository = new BlogCategoryRepository();
        // $categoryRepository = app(BlogCategoryRepository::class);

        // $item[] = BlogCategory::find($id);
        // $item[] = BlogCategory::findOrFail($id);
        // $item[] = BlogCategory::where('id', $id)->first();
        // dd($item);

        // $item = BlogCategory::withTrashed()->findOrFail($id);
        // $categoryList = BlogCategory::all();

        $item = $this->blogCategoryRepository->getEdit($id);

        // $v['title_before'] = $item->title;

        // $item->title = 'ASDasdad assssas 1212';

        // $v['title_after'] = $item->title;
        // $v['getAttribute'] = $item->getAttribute('title');
        // $v['attributesToArray'] = $item->attributesToArray();
        // $v['attributes'] = $item->attributes['title'];
        // $v['getAttributeValue'] = $item->getAttributeValue('title');
        // $v['getMutatedAttributes'] = $item->getMutatedAttributes();
        // $v['hasGetMutator for title'] = $item->hasGetMutator('title');
        // $v['toArray'] = $item->toArray();

        // dd($v, $item);

        if(empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        // dd(__METHOD__, $request->all(), $id);

        // $rules = [
        //     'title'       => 'required|min:5|max:200',
        //     'slug'        => 'max:200',
        //     'description' => 'string|max:500|min:3',
        //     'parent_id'   => 'required|integer|exists:blog_categories,id',
        // ];

        // $validatedData = $this->validate($request, $rules);
        // $validatedData = $request->validate($rules);

        // $validator = \Validator::make($request->all(), $rules);
        // $validatedData[] = $validator->passes();
        // $validatedData[] = $validator->validate();
        // $validatedData[] = $validator->valid();
        // $validatedData[] = $validator->failed();
        // $validatedData[] = $validator->errors();
        // $validatedData[] = $validator->fails();


        // dd($validatedData);
           
        // $item = BlogCategory::withTrashed()->find($id);
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Зaпись id=[{$id}] не найдена"])
                ->withInput(); 
        }
        

        $data = $request->all();
        // $data = $request->input();

        /*
        //ушло в обсервер
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        */

        $result = $item->update($data);
        // $result = $item
        //     ->fill($data)
        //     ->save();

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
   
    {

        dd(__METHOD__);
        $item = BlogCategory::find($id)->delete();
      
        return redirect()
            ->route('blog.admin.categories.index')
            ->with(['success' => 'Категория успешно удалена']);        
     
    }

    // public function restoreDeleted($id)
    // {
    //     $item = BlogCategory::withTrashed()->where('id', $id)->first();
    //     $item->restore();
    //     return redirect()
    //         ->route('blog.admin.categories.index')
    //         ->with(['success' => 'Категория успешно восстановвлена']); 
    // }

    // public function deletePermanently($id)
    // {
    //     $item = BlogCategory::where('id', $id)->withTrashed()->first();
    //     $item->forceDelete();
    //     return redirect()
    //         ->route('blog.admin.categories.index')
    //         ->with(['success' => 'Категория успешно удалена из БД']); 
    // }

}
