<?php

class Product extends \Eloquent {
    protected $fillable = [];
    protected $table = 'products';
    public $timestamps = false;
    public function category(){
        return $this->belongsTo('Category','category_id','id');

    }
}