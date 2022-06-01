<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
use Spatie\Translatable\HasTranslations;

class Blogsources extends Model
{
    use HasFactory;

     use HasFactory, HasTranslations;
    protected $table = 'sources';
    protected $fillable = ['title','status'];
    public $translatable = ['title'];
}
