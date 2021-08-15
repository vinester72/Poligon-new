<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloguent\Collection;

class BlogPostRepository extends CoreRepository
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
     * Получить список статей для вывода в списке
     *(Админка)
     * 
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug', 
            'is_published',
            'published_at',
            'user_id',
            'category_id', 
            'deleted_at'
        ];

        $result = $this
            ->startConditions()
            ->withTrashed()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['category', 'user'])
            ->with([
                //можно так
                'category' => function($query) {
                    $query->select(['id', 'title']);
                },
                //или так
                // 'user:id,name',
            ])
            ->paginate(10);
      
        return $result;
    }

    /**
     * Получить модель для редактирования в админке
     * 
     * @param int $id
     * 
     * return Model
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

        $result = $this
            ->startConditions()
            ->withTrashed()
            ->selectRaw($columns)
            ->toBase()
            ->get();
         
        return $result;
    }


}
