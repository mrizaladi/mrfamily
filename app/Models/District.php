<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id','name','regency_id'
    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class);
    }

}
