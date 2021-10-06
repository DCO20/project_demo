<?php

namespace Modules\Provider\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Presenter\ProviderPresenter;

class Provider extends Model
{
    use SoftDeletes,
        Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = ProviderPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'providers';

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'cnpj',
        'corporate_name',
        'fantasy_name',
        'active'
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
    ];

    /**
     * Formata o atributo
     *
     * @param string $value
     * @return boolean
     */
    public function getFormattedActiveAttribute()
    {
        return $this->active ? "Sim" : "Não";
    }
}
