<?php

namespace Modules\Provider\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Provider\Presenter\ProviderPresenter;

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
        'legal_name',
        'trade_name',
        'active',
        'note'
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

    /**
     * Relacionamento com endereço
     *
     *  @var array
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
