<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    protected $fillable = [
        'content'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
