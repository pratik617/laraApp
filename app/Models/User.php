<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const FILE_UPLOAD_DIR = 'uploads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'picture', 'confirmed'
    ];

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

    public function getFirstNameAttribute($value) {
  		return ucfirst($value);
  	}

  	public function getLastNameAttribute($value) {
  		return ucfirst($value);
  	}

  	public function getFullNameAttribute() {
  		return ucfirst("{$this->first_name}").' '.ucfirst("{$this->last_name}");
  	}

    public function getCreatedAtAttribute($value) {
  		return Carbon::parse($value)->format('d/m/Y H:i:s');
  	}

    public function getUpdatedAtAttribute($value) {
  		return Carbon::parse($value)->format('d/m/Y H:i:s');
  	}
}
