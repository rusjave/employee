<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  protected $table = 'employees';
  protected $fillable = ['first_name','last_name', 'address', 'created_at'];
  
  public function company()
  {
    return $this->belongsTo(Company::class);
  }

}
