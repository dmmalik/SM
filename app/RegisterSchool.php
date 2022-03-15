<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegisterSchool extends Model
{
	protected $table = 'sm_schools';
	//public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		' ','school_name','email', 'address','phone','school_type','school_code'
	];

	
}