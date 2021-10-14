<?php

namespace Modules\Category\Entities;

use Modules\Product\Entities\Product;

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
     *  @var array $fillable
     */
    protected $fillable = [
        'category_id',
        'product_id'
    ];

    /**
     * Relacionamento com category
     *
     *  @var array
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relacionamento com product
     *
     *  @var array
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
