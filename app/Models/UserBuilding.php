<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBuilding extends Model
{
    protected $fillable = [
        'user_id',
        'building_id',
        'level'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
