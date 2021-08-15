<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloguent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    // use Repository;

   /**
     * @return string
     */
    protected function getModelClass()
    {
        // Don't forget to update the model's name
        return Model::class;
    }

    /**
     * The model being queried.Получить модель для редактирования в админке.
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->withTrashed()->find($id);
    }

    /**
     * Получить список каткгорий для вывода в выпадающем списке
     *
     * @return Collection
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        // $result[] = $this->startConditions()->all();

        // $result[] = $this
        //     ->startConditions()
        //     ->select('blog_categories.*',
        //         \DB::raw('CONCAT (id, ". ", title) AS id_title'))
        //     ->toBase()
        //     ->get();

        $result = $this
            ->startConditions()
            ->withTrashed()
            ->selectRaw($columns)
            ->toBase()
            ->get();
         
        return $result;
    }

    /**
     * Получить категории для вывода пагинатором
     *
     * @param int|null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id', 'deleted_at'];

        $result = $this
            ->startConditions()
            ->withTrashed()
            ->select($columns)
            ->with(['parentCategory:id,title'])
            ->paginate($perPage);
      
        return $result;
    }

}
