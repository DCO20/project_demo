<?php

namespace Modules\Category\Entities;

use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
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
}
