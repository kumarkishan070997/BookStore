<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Review;
use App\Models\Category;
use App\Models\BookAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','price','category_id'];
    protected $table = "books";

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function authors()
    {
        return $this->hasManyThrough(Author::class, BookAuthor::class,'author_id','id','id','book_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class,'book_id','id');
    }
}
