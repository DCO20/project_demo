<?php

namespace Modules\Category\Entities;

use App\Traits\Presentable;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Presenter\CategoryPresenter;

class Category extends Model
{
	use SoftDeletes,
		Presentable;

	/**
	 * Presenter
	 *
	 * @var string $presenter
	 */
	protected $presenter = CategoryPresenter::class;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'categories';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'name',
		'active'
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

	/**
	 * Trativa da tabela do banco de dados
	 *
	 * @var array $casts
	 */
	protected $casts = [
		'active' => 'boolean'
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
	 * Obtêm os produtos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function products()
	{
		return $this->belongsToMany(Product::class)->withTrashed();
	}
}
