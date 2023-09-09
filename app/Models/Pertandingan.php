<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertandingan extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'pertandingans';

    public const HASIL_SELECT = [
        'menang' => 'Menang',
        'kalah'  => 'Kalah',
    ];

    public const MEDALI_SELECT = [
        'emas'     => 'Emas',
        'perunggu' => 'Perunggu',
        'perak'    => 'Perak',
    ];

    protected $dates = [
        'tgl_mulai',
        'tgl_selesai',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_id',
        'cabor_id',
        'tgl_mulai',
        'tgl_selesai',
        'venue_id',
        'hasil',
        'medali',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function cabor()
    {
        return $this->belongsTo(Cabor::class, 'cabor_id');
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

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }
}
