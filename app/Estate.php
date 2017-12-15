<?php

namespace LaravelRealState;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ref', 'label', 'address', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_by', 'updated_by', 'deleted_by'];
}
