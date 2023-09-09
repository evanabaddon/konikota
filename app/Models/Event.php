<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'events';

    protected $dates = [
        'tgl_mulai',
        'tgl_selesai',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'tgl_mulai',
        'tgl_selesai',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function eventPertandingans()
    {
        return $this->hasMany(Pertandingan::class, 'event_id', 'id');
    }

    public function getTglMulaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglMulaiAttribute($value)
    {
        $this->attributes['tgl_mulai'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTglSelesaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglSelesaiAttribute($value)
    {
        $this->attributes['tgl_selesai'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }

    public function cabors()
    {
        return $this->belongsToMany(Cabor::class);
    }
}
