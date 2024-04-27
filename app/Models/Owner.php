<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Owner extends Model
{
    use HasFactory;

    protected $fillable  = ['name' , 'phone'];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
        );
    }

    protected static function booted(): void //this is global scope
    {
        static::addGlobalScope('namer', function (Builder $builder) {
            $builder->where('name','ahmed');
        });
    }
}
