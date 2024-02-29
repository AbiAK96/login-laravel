<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    use HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'address',
        'email', 
        'email_verified_at',
        'password',
        'role',
        'lms_user_id',
        'dob',
        'nic_no',
        'advanced_level_year',
        'guardian_detail',
        'nic_front',
        'nic_back',
        'photo',
        'vault_id',
        'status',
        'registration_id',
        'district'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscription()
    {
    	return $this->hasMany('App\Models\Subscription', 'student_id', 'id');
    }

    const LOCATION = [
        'Ampara' => 'Ampara',
        'Anuradhapura' => 'Anuradhapura',
        'Badulla' => 'Badulla',
        'Batticaloa' => 'Batticaloa',
        'Colombo' => 'Colombo',

        'Galle' => 'Galle',
        'Gampaha' => 'Gampaha',
        'Hambantota' => 'Hambantota',
        'Jaffna' => 'Jaffna',
        'Kalutara' => 'Kalutara',

        'Kandy' => 'Kandy',
        'Kegalle' => 'Kegalle',
        'Kilinochchi' => 'Kilinochchi',
        'Kurunegala' => 'Kurunegala',
        'Mannar' => 'Mannar',

        'Matale' => 'Matale',
        'Matara' => 'Matara',
        'Monaragala' => 'Monaragala',
        'Mullaitivu' => 'Mullaitivu',
        'Nuwara Eliya' => 'Nuwara Eliya',

        'Polonnaruwa' => 'Polonnaruwa',
        'Puttalam' => 'Puttalam',
        'Ratnapura' => 'Ratnapura',
        'Trincomalee' => 'Trincomalee',
        'Vavuniya' => 'Vavuniya',
    ];
}
