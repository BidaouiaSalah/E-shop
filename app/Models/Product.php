<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Product extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia, Searchable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "name",
    "slug",
    "description",
    "price",
    "stock",
    "category_id",
    "brand_id"
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function brand()
  {
    return $this->belongsTo(Brand::class);
  }

  public function reviews()
  {
    return $this->hasMany('App\Models\Review');
  }

  public static function scopeRelatedProducts($query)
  {
    return  $query->inRandomOrder()->take(4);
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->width(450)
      ->height(250);
    // ->performOnCollections('product');
  }
}
