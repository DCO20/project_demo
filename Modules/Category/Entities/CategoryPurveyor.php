<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryPurveyor extends Model
{
	use HasFactory;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'category_purveyor';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'category_id',
		'purveyor_id'
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
	 * Obtém os fornecedor
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function purveyor()
	{
		return $this->belongsTo(Purveyor::class);
	}

	/**
	 * Create a new factory instance for the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Factories\Factory
	 */
	protected static function newFactory()
	{
		return \Modules\Category\Database\factories\CategoryPurveyorFactory::new();
	}
}
