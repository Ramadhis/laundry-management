<?php

namespace App\Helpers;

use App\User;
use Auth;

class UserHelper
{
	public function ifAdmin(){
		if(Auth::user()->role == 'admin')
		{
			return true;
		}else{
			return false;
		}
	}
	
	public function ifKasir(){
		if(Auth::user()->role == 'kasir')
		{
			return true;
		}else{
			return false;
		}
	}

	public function ifOwner(){
		if(Auth::user()->role == 'owner')
		{
			return true;
		}else{
			return false;
		}
	}


	public function outletID(){
		if (isset(Auth::user()->id_outlet)) {
			return Auth::user()->id_outlet;
		}else{
			return '-';
		}
	}

	public function userID(){
		if (isset(Auth::user()->id)) {
			return Auth::user()->id;
		}else{
			return '-';
		}
	}

	public function image_profile(){
		if (isset(Auth::user()->image_profile)) {
			return Auth::user()->image_profile;
		}else{
			return '-';
		}
	}
	
	
}