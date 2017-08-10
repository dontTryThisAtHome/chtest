<?php

namespace App\Exceptions;

use Exception;

Class DepartmentsException extends Exception{

	public static function hasPeople()
	{
		return new self('Department has people', 1);
	}
}