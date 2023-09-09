<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atlet extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'atlets';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const KATEGORI_SELECT = [
        'tunggal' => 'Tunggal',
        'regu'    => 'Regu',
    ];

    protected $fillable = [
        'name',
        'kategori',
        'cabor_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function cabor()
    {
        return $this->belongsTo(Cabor::class, 'cabor_id');
    }
}
