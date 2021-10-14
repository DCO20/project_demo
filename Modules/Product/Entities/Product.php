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
        'price'
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
     * Atributos da tabela do banco de dados
     *
     *  @var array $dates
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
     *
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
        $this->attributes['price'] = str_replace(',', '.', str_replace('.', '', $value));
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
     * Relacionamento com categorias
     *
     *
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->orderBy('name', 'ASC')
            ->withTrashed();
    }
}
