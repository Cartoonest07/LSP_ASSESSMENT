<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'instrument_id', 'tanggal_peminjaman', 'tanggal_dikembalikan', 'total_price', 'penalty'];

    // Specify the table name
    protected $table = 'reservation';

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setValidToValueAttribute($date)
    {
        $this->attributes['valid_to'] = strtotime($date);
    }

    public function instrument(): BelongsTo
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    public function save(array $options = [])
    {
        if (!$this->user_id) {
            $this->user_id = Auth::id();
        }
        parent::save($options);
    }
}
