<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    /**
     * Handle the BlogCategory "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * @param BlogCategory $blogCategory
     */
    public function creating(BlogCategory $blogCategory) 
    { 
        $this->setSlug($blogCategory);
       
    }

    /**
     * Если поле слаг пустое, то заполняем его конвертацией заголовка
     * 
     * @param BlogCategory $blogCategory
     */
    protected function setSlug(BlogCategory $blogCategory) 
    {
        if (empty($blogCategory->slug)) {
            
            $blogCategory->slug = Str::slug($blogCategory->title);
           
        }
    }

    public function updating(BlogCategory $blogCategory)
    {
    // {dd(__METHOD__,$blogCategory->getDirty());
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the BlogCategory "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the BlogCategory "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the BlogCategory "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the BlogCategory "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
