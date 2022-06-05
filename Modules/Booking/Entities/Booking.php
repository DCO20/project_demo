<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'bookings';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'title',
		'start_date',
		'end_date',
	];

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $dates
	 */
	protected $dates = [
		'start_date',
		'end_date',
		'created_at',
		'updated_at'
	];
}
