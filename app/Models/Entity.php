<?php

namespace App\Models;

use App\Tweets\Entities\EntityDatabaseCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    // use HasFactory;

    protected $fillable = [
        'body',
        'body_plain',
        'start',
        'end',
        'type',
    ];

    public function newCollection(array $models = [])
    {
        return new EntityDatabaseCollection($models);
    }
}
