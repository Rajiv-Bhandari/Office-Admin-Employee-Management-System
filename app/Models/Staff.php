<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Staff extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;
    use Notifiable;
    use MustVerifyEmail;

    protected $table = 'staff';

    protected $fillable = [
        'name', 'short_code', 'email', 'dob', 'address', 'password', 'status', 'dept_id', 'session_token',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
