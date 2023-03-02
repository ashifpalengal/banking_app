<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
        'account_type'
    ];

    protected static function booted()
    {
        static::creating(function ($account) {
            $lastAccount = self::orderByDesc('id')->first();
            $lastNumber = $lastAccount ? intval($lastAccount->account_number) : 0;
            $account->account_number = str_pad($lastNumber + 1, 8, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}
