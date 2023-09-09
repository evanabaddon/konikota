<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'venues';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'alamat',
        'provinsi',
        'kota',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function venuePertandingans()
    {
        return $this->hasMany(Pertandingan::class, 'venue_id', 'id');
    }

    public function venueEvents()
    {
        return $this->belongsToMany(Event::class);
    }
}
