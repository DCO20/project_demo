<?php

namespace Modules\Product\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Presenter\ProductPresenter;

class Product extends Model
{
    use SoftDeletes,
        Presentable;

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
     *  @var array $fillable
     */
    protected $fillable = [
        'name',
        'active',
        'price',
        'description'
    ];

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /**
     * Trativa da tabela do banco de dados
     *
     *  @var array $casts
     */
    protected $casts = [
        'active' => 'boolean',
        'price' => 'float'
    ];

    /**
     * Retorna sim ou não
     *
     */
    public function getFormattedActiveAttribute()
    {
        return $this->active ? "Sim" : "Não";
    }


    /**
     * Formata o atributo
     *
     * @param string $value
     * @return void
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '.', str_replace('.', '', $value));
    }


    /**
     * Formata o atributo
     *
     * @param string $value
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->attributes['price'], 2, ',', '.');
    }

    /**
     * Formata o atributo
     *
     * @param string $value
     * @return string
     */
    public function formatCategoryName()
    {
        return $this->categories()->pluck('name')->implode(", ");
    }

    /**
     * Relacionamento com categorias
     *
     *  @var array
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }
}
