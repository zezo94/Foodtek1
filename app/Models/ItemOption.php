<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOption extends Model
{
    protected $fillable = ['category_id', 'name_ar', 'name_en', 'is_active'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
