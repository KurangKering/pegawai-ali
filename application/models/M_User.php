<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_User extends Eloquent
{
	protected $table = 'user';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $fillable = [
		'username',
		'password',
		'role_id',
		'reference_user_id',
	];

	public function role()
	{
		return $this->belongsTo(new M_Role, 'role_id');
	}

	
}