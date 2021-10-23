<?php

namespace Modules\Suit\Entities;

use App\Traits\Presentable;
use Modules\Client\Entities\Client;
use Illuminate\Database\Eloquent\Model;
use Modules\Suit\Presenter\SuitPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suit extends Model
{
	use SoftDeletes,
		HasFactory,
		Presentable;

	const FINISHED = "Finished";

	const PENDING = "Pending";

	/**
	 * Presenter
	 *
	 * @var string $presenter
	 */
	protected $presenter = SuitPresenter::class;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'suits';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'suit_date',
		'status',
		'note'
	];

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $dates
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'suit_date',
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
	 * Formata o atributo
	 *
	 * @return string
	 */
	public function getFormattedSuitDateAttribute()
	{
		return $this->suit_date->format('d/m/Y');
	}

	/**
	 * Retorna pendente ou finalizado
	 *
	 * @return string
	 */
	public function getFormattedStatusAttribute()
	{
		return $this->status == self::PENDING ? "Pendente" : "Finalizado";
	}

	/**
	 * Formata o atributo
	 *
	 * @return string
	 */
	public function formatClientName()
	{
		return $this->clients->pluck('name')->implode(", ");
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
	public function clients()
	{
		return $this->belongsToMany(Client::class)
			->orderBy('name', 'ASC')
			->withTrashed();
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
		return \Modules\Suit\Database\factories\SuitFactory::new();
	}
}
