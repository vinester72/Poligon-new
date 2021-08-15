<?php

namespace App\Repositories;

use Illuminate\Database\Eloguent\Model; 
/**
 * Репозиторий работы с сущностью
 * Может выдавать наборы данных
 * Не может создавать/изменять сущности
 */
abstract class CoreRepository
{
    // use Repository;

    /**
     * The model being queried.
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Don't forget to update the model's name
        $this->model = app($this->getModelClass());
    }
    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
