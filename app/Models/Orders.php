<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = "orders";

    public function scopeReject($query)
    {
        return $query->where('status', 2);
    }

    public function scopeforRole($query) {
        $role = getRoleId();
        switch ($role) {            
            case 2:
                return $query->whereIn('status', [6, 4])->orderBy('created_at', 'DESC');
                break;

            case 3:
                return $query->whereIn('status', [6])->orderBy('created_at', 'DESC');
                break;

            case 4:
                return $query->whereIn('status', [8])->orderBy('created_at', 'DESC');
                break;

            case 5:
                return $query->whereIn('status', [7])->orderBy('created_at', 'DESC');
                break;
            case 6:
                return $query->whereNot('status', 5)->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC');
                break;
            default:
                return $query->orderBy('created_at', 'DESC');
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function materials()
    {
        return $this->hasMany(MaterialUsed::class, 'order_id');
    }
}
