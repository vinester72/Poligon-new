<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Observers\BlogPostObserver;


class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();
// dd($paginator);
        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(__METHOD__);
        $item = new BlogPost();
        $categoryList = $this->blogPostRepository->getForComboBox();
        
        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        //  dd(__METHOD__);
        $data = $request->input();

        //Создаст объект и добавит в БД
        //   $item = (new BlogPost())->create($data);
        $item = BlogPost::create($data);

          if ($item) {
              $job = new BlogPostAfterCreateJob($item);
              $this->dispatch($job);

              return redirect()
                      ->route('blog.admin.posts.edit', [$item->id])
                      ->with(['success' => 'Успешно сохранено']);
          } else {
              return back()
                      ->withErrors(['msg' => 'Ошибка сохранения'])
                      ->withInput();
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  dd(__METHOD__, $id);
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        // dd(__METHOD__, $request->all(), $id);
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Зaпись id=[{$id}] не найдена"])
                ->withInput(); 
        }

        $data = $request->all();
        /*
        //ушло в обсервер
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if (empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }
        */

        $result = $item->update($data);
        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
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
        // dd(__METHOD__, $id);
        
        $result = BlogPost::destroy($id);

        // $result = BlogPost::find($id)->forceDelete();

        if ($result) {
            BlogPostAfterDeleteJob::dispatch($id)->delay(20);

            //варианты запуска:
            // BlogPostAfterDeleteJob::dispatchNow($id);
            // dispatch(new BlogPostAfterDeleteJob($id))->delay(20);
            // dispatch_new(new BlogPostAfterDeleteJob($id));
            // $this->dispatch(new BlogPostAfterDeleteJob($id));
            // $this->dispatch_new(new BlogPostAfterDeleteJob($id));


            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запись id[$id] удалена"]);       
        } else {
            return back()->withErrors(['msg' => "Ошибка удаления"]);
        }
    }

    public function restore($id)
    {
        $result = BlogPost::withTrashed()->find($id);
        $result->restore();
        // dd( $result);
        if ($result) {
        return redirect()
            ->route('blog.admin.posts.index')
            ->with(['success' => "Статья  id[$id] успешно восстановлена"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка восстановления"]);
        }
    }

}
