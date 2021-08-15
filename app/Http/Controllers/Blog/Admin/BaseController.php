<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController as GuestBaseController;
use Illuminate\Http\Request;

/**
 * Базовый контроллер для всехконтроллеров управления
 * блогом в панели управления
 * Должен быть родителем всех контроллеров управления блогом
 */
abstract class BaseController extends GuestBaseController
{
    /**
    * BaseController constructor
    */
    public function __construct()
    {
      //Инициализация общих моментов для админки
    }
}
