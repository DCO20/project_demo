<?php

namespace Modules\Suit\Entities;

use App\Traits\Presentable;
use Modules\Client\Entities\Client;
use Modules\Product\Entities\Product;
use Modules\Suit\Entities\SuitProduct;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
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
		'client_id',
		'date',
		'status',
		'description'
	];

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $dates
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'date',
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
	public function getFormattedDateAttribute()
	{
		return $this->date->format('d/m/Y');
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
	 * Obtém a cliente
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	/**
	 * Obtêm o pedido dos produtos
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function suitProducts()
	{
		return $this->hasMany(SuitProduct::class);
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

	/**
	 * Obtêm os fornecedores
	 *
	 * @return \Illuminate\Database\Eloquent\Collection $item
	 */
	public function filterPurveyor($item)
	{
		return Purveyor::where('id', '!=', $item->purveyor_id)->get();
	}

	/**
	 * Obtêm as categorias
	 *
	 * @return \Illuminate\Database\Eloquent\Collection $item
	 */
	public function filterCategory($item)
	{
		return Category::whereHas('purveyors', function ($q) use ($item) {
			$q->where('id', $item['purveyor_id']);
		})
		->where('id', '!=', $item['category_id'])
		->get();
	}

	/**
	 * Obtêm as produtos
	 *
	 * @return \Illuminate\Database\Eloquent\Collection $item
	 */
	public function filterProduct($item)
	{
		return Product::whereHas('categories', function ($q) use ($item) {
			$q->where('id', $item['category_id']);
		})
		->where('id', '!=', $item['product_id'])
		->get();
	}
}
