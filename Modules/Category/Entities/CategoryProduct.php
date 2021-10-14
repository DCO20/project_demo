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
     * Relacionamento com categoria
     *
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relacionamento com produto
     *
     *
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
