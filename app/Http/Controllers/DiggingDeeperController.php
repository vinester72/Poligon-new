<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DiggingDeeperController extends Controller
{
    /**
     * Базовая информация
     * 
     */
    public function collections()
    {
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();
        // dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        $collection = collect($eloquentCollection->toArray());
        // dd(__METHOD__,
        //     get_class($eloquentCollection),
        //     get_class($collection),
        //     $collection
        // );

        // $result['first'] = $collection->first();
        // $result['last'] = $collection->last();
        // dd($result);

        $result['where']['data'] = $collection
            ->where('category_id', '>=' , 10)
            ->values()
            ->keyBy('id');
      

        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();
       

        // if($result['where']['data']->isNotEmpty()) {
        //     //.....
        // }

        // $result['where_first'] = $collection
        //     ->firstWhere('created_at', '>', '2021-07-18 1:35:11');

        //базовая функция не изменится, просто вернется изменённая версия
        // $result['map']['all'] = $collection->map(function(array $item) {
        //     // dd($item);
        //     $newItem = new \stdClass();
        //     $newItem->item_id = $item['id'];
        //     $newItem->item_name = $item['title'];
        //     $newItem->exists = is_null($item['deleted_at']);

        //     return $newItem;
        // });

        // $result['map']['not_exists'] = $result['map']['all']
        //     ->where('exists', '=', false)
        //     ->values()
        //     ->keyBy('item_id');

        // dd($result);

        $collection->transform(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return  $newItem;
        });
        // dd($collection);

        // $newItem = new \stdClass();
        // $newItem->id = 9999;

        // $newItem2 = new \stdClass();
        // $newItem2->id = 8888;

        // dd($newItem, $newItem2);
        // $newItemFirst = $collection->prepend($newItem);
        // $newItemLast = $collection->push($newItem2);
        // dd($collection, $newItemFirst, $newItemLast);
        //Установить элемент на начало коллекции
        // $newItemFirst = $collection->prepend($newItem)->first();
        // $newItemLast = $collection->push($newItem2)->last();
        // $pulledItem = $collection->pull(10);
        
        // dd(compact('collection', 'newItemFirst', 'newItemLast', 'pulledItem'));

        //фильтрация , замена orWhere()
        // $filtered = $collection->filter(function ($item) {
        //     $byDay = $item->created_at->isFriday();
        //     $byDate = $item->created_at->day == 16;

        //     $result =  $byDay && $byDate;

        //     return $result;
        // });
        //     dd(compact('filtered'));

        $sortedSimpleCollection = collect([5, 3, 1, 2, 4])->sort()->values();
        $sortedAscCollection = $collection->sortBy('created_at')->keyBy('item_id');
        $sortedDescCollection = $collection->sortByDesc('item_id')->values();

        // dd(compact('sortedSimpleCollection', 'sortedAscCollection', 'sortedDescCollection'));

    }
}
