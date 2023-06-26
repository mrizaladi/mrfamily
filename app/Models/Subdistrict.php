<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;

    protected $fillable =[
        'id','name','district_id'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
