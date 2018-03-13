<?php

namespace LaravelRealState;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use SoftDeletes;

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
    protected $fillable = ['ref', 'type', 'label', 'status', 'zone', 'address', 'colony', 'zip', 'price', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_by', 'updated_by', 'deleted_by'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the owner that owns the estate.
     */
    public function owner()
    {
        return $this->belongsTo('LaravelRealState\Owner', 'fk_owner');
    }
}
