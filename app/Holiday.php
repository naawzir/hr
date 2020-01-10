<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $primaryKey = 'holiday_id';

    /**
     * Get the user that "owns" the holiday.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
