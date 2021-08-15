<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use SoftDeletes;
    // use HasFactory;

    /**
     *Id корня 
     */
    const ROOT = 1;

    protected $fillable
    = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * Получить родительскую категорию
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Пример аксессуара (Accessor)
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title 
            ?? ($this->isRoot()
                ? 'Корень'
                : '???');
                
        return $title;        
    }

    /**
     * Является ли текущий объект корневым
     */
    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }

    /**
     * Пример аксессуара
     */

    //  public function getTitleAttribute($valueFromObject)
    //  {
    //      return mb_strtoupper($valueFromObject);
    //  }

     /**
      * Пример мутатора
      */
     public function setTitleAttribute($incomingValue)
     {
         $this->attributes['title'] = mb_strtolower($incomingValue);
     }

}
