<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stock extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $with=['product'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
