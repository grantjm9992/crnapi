<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ContactType extends Model
{
    protected $table = "contact_type";

    protected $fillable = [
        'company_id',
        'name',
        'active'
    ];
    
    protected $keyType = 'string';

    public $incrementing = false;
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}
