<?php

namespace Modules\Client\Entities;

use App\Traits\Presentable;
use Modules\Suit\Entities\Suit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Client\Presenter\ClientPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
	use SoftDeletes,
		Presentable,
		HasFactory;

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

	/*
	|--------------------------------------------------------------------------
	| Relationship
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos das entidades relacionadas.
	| Estes métodos são responsáveis pelas relações e permitem acessar
	| os atributos Eloquent obtidas das mesmas.
	|
	*/

	/**
	 * Obtêm as clientes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function suits()
	{
		return $this->belongsToMany(Suit::class)->withTrashed();
	}

	/*
	|--------------------------------------------------------------------------
	| Defining a Function
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos complementares a esta entidade.
	| Estes métodos permitem definir as regras de negócio ou demais ações desta entidade.
	|
	*/

	/**
	 * Create a new factory instance for the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Factories\Factory
	 */
	protected static function newFactory()
	{
		return \Modules\Client\Database\factories\ClientFactory::new();
	}
}
