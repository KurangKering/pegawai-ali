<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_Pegawai extends Eloquent
{
	protected $table = 'pegawai';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $fillable = [
		'nama',
		'tempat_lahir',
		'tanggal_lahir',
		'email',
		'alamat',
		'no_hp',
		'file_foto'
	];

	
	
}