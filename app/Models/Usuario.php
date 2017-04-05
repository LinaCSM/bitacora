<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	protected $table='users';
	protected $guarder= 'id';
	
	protected $fillable=['identificacion','name','lastname','user_red','password','attempts','state','justificacion','registro','FK_Tipo'];

	protected $hidden = ['password', 'remember_token'];
}
