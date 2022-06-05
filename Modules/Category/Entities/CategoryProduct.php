<?php

namespace Modules\Category\Entities;

use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryProduct extends Model
{
	use HasFactory;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'category_product';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'category_id',
		'product_id'
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Obtém as categoria
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	/**
	 * Obtém os produto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo(Product::class);
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
		return \Modules\Category\Database\factories\CategoryProductFactory::new();
	}
}
