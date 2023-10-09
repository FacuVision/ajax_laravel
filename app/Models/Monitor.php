<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Computer;

class Monitor extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the Monitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }

}
