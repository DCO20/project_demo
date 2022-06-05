<?php

namespace Modules\Product\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Presenter\ProductPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use SoftDeletes,
		Presentable,
		HasFactory;

	/**
	 * Presenter
	 *
	 * @var string $presenter
	 */
	protected $presenter = ProductPresenter::class;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'products';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'name',
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
	public function formatCategoryName()
	{
		return $this->categories()->pluck('name')->implode(", ");
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
		return \Modules\Product\Database\factories\ProductFactory::new();
	}
}
