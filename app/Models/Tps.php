<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;

    protected $fillable = [
        'regency_id',
        'district_id',
        'subdistrict_id',
        'tps',
        'officer',
        'total_voters',
        'golkars',
        'check',
        'isFastCount',

    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    
    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }
}
