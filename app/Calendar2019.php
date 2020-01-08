<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar2019 extends Model
{
    protected $table = 'calendar2019';

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    //protected $with = ['holidays'];

    /**
     * Get the holidays for the calendar day.
     */
    public function holidays()
    {
        return $this->hasMany('App\Holiday', 'id', 'id'); // calendar2020.date = holidays.id
    }
    /**
     * Get the holidays for the calendar day.
     */
    public function holidaysForUser()
    {
        return $this->hasMany('App\Holiday', 'id', 'id')->where('holidays.user_id', \Auth::user()->id); // calendar2020.date = holidays.id
    }
}
