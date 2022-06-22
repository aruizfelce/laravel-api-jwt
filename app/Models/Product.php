<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['description','unit','image'];

    public function categories()
    {
      return $this->belongsTo(Category::class,'id_category');
    }
}
