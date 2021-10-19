<?php

namespace Modules\Client\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Client\Presenter\ClientPresenter;

class Client extends Model
{
	use SoftDeletes,
		Presentable;

	const FEMALE = "F";

	const MALE = "M";

	/**
	 * Presenter
	 *
	 * @var string $presenter
	 */
	protected $presenter = ClientPresenter::class;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'clients';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'name',
		'date_birthday',
		'genre',
		'active',
		'price'
	];

	/**
	 * Trativa da tabela do banco de dados
	 *
	 * @var array $casts
	 */
	protected $casts = [
		'active' => 'boolean',
		'price' => 'float'
	];

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $dates
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'date_birthday',
		'deleted_at'
	];

	/*
	|--------------------------------------------------------------------------
	| Accessors
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos GET desta entidade.
	| Estes métodos permitem formatar os atributos Eloquent obtidos do banco de dados.
	|
	*/

	/**
	 * Retorna sim ou não
	 *
	 * @return string
	 */
	public function getFormattedActiveAttribute()
	{
		return $this->active ? "Sim" : "Não";
	}

	/**
	 * Formata o atributo
	 *
	 * @return string
	 */
	public function getFormattedPriceAttribute()
	{
		return number_format($this->attributes['price'], 2, ',', '.');
	}

	/**
	 * Formata o atributo
	 *
	 * @return string
	 */
	public function getFormattedDateBirthdayAttribute()
	{
		return $this->date_birthday->format('d/m/Y');
	}

	/**
	 * Retorna feminino ou masculino
	 *
	 * @return string
	 */
	public function getFormattedGenreAttribute()
	{
		return $this->genre == self::FEMALE ? "Feminino" : "Masculino";
	}

	/*
	|--------------------------------------------------------------------------
	| Mutators
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos SET desta entidade.
	| Estes métodos permitem formatar os atributos para o banco de dados.
	|
	*/

	/**
	 * Formata o atributo
	 *
	 * @return void
	 */
	public function setPriceAttribute($value)
	{
		$formatted_value = str_replace(',', '.', str_replace('.', '', $value));

		$this->attributes['price'] = $formatted_value;
	}
}
