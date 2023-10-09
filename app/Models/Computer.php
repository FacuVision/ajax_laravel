<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monitor;

class Computer extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the comments for the Computer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function monitors()
    {
        return $this->hasMany(Monitor::class);
    }

}
