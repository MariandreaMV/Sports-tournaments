<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
  protected $table = 'registers';

  protected $primaryKey = 'id';

  protected $fillable = ['tournament_id', 'team_id', 'n_participants', 'category'];
}
