<?php

namespace Modules\Suit\Entities;

use App\Traits\Presentable;
use Modules\Suit\Entities\Suit;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
use Modules\Suit\Presenter\SuitProductPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuitProduct extends Model
{

	use Presentable,
		HasFactory;

	/**
	 * Presenter
	 *
	 * @var string $presenter
	 */
	protected $presenter = SuitProductPresenter::class;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'suit_products';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'category_id',
		'product_id',
		'purveyor_id',
		'suit_id',
		'price',
		'amount'
	];

	/**
	 * Trativa da tabela do banco de dados
	 *
	 * @var array $casts
	 */
	protected $casts = [
		'price' => 'float'
	];

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $dates
	 */
	protected $dates = [
		'created_at',
		'updated_at'
	];

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
	 * Obtém a categoria
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(Category::class)->withTrashed();
	}

	/**
	 * Obtém o produto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo(Product::class)->withTrashed();
	}

	/**
	 * Obtém o fornecedor
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function purveyor()
	{
		return $this->belongsTo(Purveyor::class)->withTrashed();
	}

	/**
	 * Obtém o pedido
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function suit()
	{
		return $this->belongsTo(Suit::class);
	}

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
	public function getFormattedPriceAttribute()
	{
		return "R$ " . number_format($this->attributes['price'], 2, ',', '.');
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
		$formatted_value = preg_replace(
			'/[^A-Za-z0-9.\-]/',
			'',
			str_replace(',', '.', str_replace(
				'.',
				'',
				str_replace('R', '', $value)
			))
		);

		$this->attributes['price'] = $formatted_value;
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
		return \Modules\Suit\Database\factories\SuitProductFactory::new();
	}
}
