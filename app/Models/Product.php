<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'category_id' , 'name','price','description','image_path'
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function(Product $product){
            $product->deleteImage();
        });
    }

    function category(){
        return $this->belongsTo(Category::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    function deleteImage(){
        if(!$this->image_path)
            return;
        unlink(storage_path('app/' . $this->image_path));
    }
}
