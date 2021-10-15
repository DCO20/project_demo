<?php

namespace Modules\Purveyor\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Purveyor\Presenter\PurveyorPresenter;

class Purveyor extends Model
{
	use SoftDeletes,
		Presentable;

	/**
	 * Presenter
	 *
	 * @var string $presenter
	 */
	protected $presenter = PurveyorPresenter::class;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'purveyors';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'name',
		'cnpj',
		'active'

	];

	/**
	 * Trativa da tabela do banco de dados
	 *
	 * @var array $casts
	 */
	protected $casts = [
		'active' => 'boolean'
	];

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $dates
	 */
	protected $dates = [
		'created_at',
		'updated_at',
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
	public function formatCategoryName()
	{
		 return $this->categories()->pluck('name')->implode(", ");
	}

	/**
	 * Retorna sim ou não
	 */
	public function getFormattedActiveAttribute()
	{
		return $this->active ? "Sim" : "Não";
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
	 * Obtêm as categorias
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function categories()
	{
		return $this->belongsToMany(Category::class)
			->orderBy('name', 'ASC')
			->withTrashed();
	}
}
