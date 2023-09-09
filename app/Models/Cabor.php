<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cabor extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'cabors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function caborPertandingans()
    {
        return $this->hasMany(Pertandingan::class, 'cabor_id', 'id');
    }

    public function caborAtlets()
    {
        return $this->hasMany(Atlet::class, 'cabor_id', 'id');
    }

    public function caborEvents()
    {
        return $this->belongsToMany(Event::class);
    }
    
    public function medaliEmas()
    {
        return $this->hasMany(Pertandingan::class, 'cabor_id')->where('medali', 'emas')->count();
    }

    public function medaliPerak()
    {
        return $this->hasMany(Pertandingan::class, 'cabor_id')->where('medali', 'perak')->count();
    }

    public function medaliPerunggu()
    {
        return $this->hasMany(Pertandingan::class, 'cabor_id')->where('medali', 'perunggu')->count();
    }

    public function totalMedali()
    {
        return $this->medaliEmas() + $this->medaliPerak() + $this->medaliPerunggu();
    }

}
