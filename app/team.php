<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teams';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['team_name', 'short_name', 'date', 'address', 'email', 'website'];

    
}
