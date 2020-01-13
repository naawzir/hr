<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->uuid = (string) \Uuid::generate(4);
            $user->name = $user->title . ' ' . $user->firstname . ' ' . $user->surname;
        });
        static::updating(function ($user) {
            $user->name = $user->firstname . ' ' . $user->middlename . ' ' . $user->surname;
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if (\Auth::user()->id === 1) {
            return true;
        }
        return false;
    }

    /**
     * Set the user's full name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $this->attributes['firstname'] . ' ' .$this->attributes['middlename'] . ' ' .$this->attributes['lastname'];
    }

    public function holidays()
    {
        return $this->hasMany('App\Holiday', 'user_id', 'id'); // users.id = holidays.user_id
    }

    /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
