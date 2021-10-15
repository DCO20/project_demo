<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Purveyor\Entities\Purveyor;

class CategoryPurveyor extends Model
{
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
}
