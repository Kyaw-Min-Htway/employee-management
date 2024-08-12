<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'name', 'email', 'position'];

    // Disable auto-incrementing ID
    public $incrementing = false;

    // Set the primary key type to string
    protected $keyType = 'string';

    // Boot method to generate UUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
