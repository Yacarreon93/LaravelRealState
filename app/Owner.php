<?php

namespace LaravelRealState;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'owners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'address'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_by', 'updated_by'];
}
