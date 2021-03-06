<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    public $timestamps = false;

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
        return $this->hasMany('App\Holiday', 'id', 'id'); // calendar.date = holidays.id
    }

    /**
     * Get the holidays for the calendar day.
     */
    public function holidaysForUser()
    {
        return $this->hasMany('App\Holiday', 'id', 'id')->where('holidays.user_id', \Auth::user()->id); // calendar.date = holidays.id
    }

    public function holidaysForUsers()
    {
        return $this->hasMany('App\Holiday', 'id', 'id'); // calendar.date = holidays.id
    }
}
