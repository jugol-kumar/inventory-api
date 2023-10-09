<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'parent_id', 'slug'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->select(['id', 'parent_id', 'name', 'slug']);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parents(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function childrenRecursive(): HasMany
    {
        return $this->childrens()->with(['childrenRecursive']);
    }
}

