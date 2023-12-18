<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Instrument extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code', 'name', 'price', 'image', 'description',
    ];

    // Specify the table name
    protected $table = 'instrument';

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'instrument_category');
    }

    public function reservation(): HasOne
    {
        return $this->hasOne(Reservation::class);
    }
}
