<?php

namespace Modules\Provider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = "addresses";

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'provider_id',
        'city_id',
        'zipcode',
        'street',
        'number',
        'complement',
        'district',
        'ref_point'
    ];

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Relacionamento para o fornecedor
     *
     *  @var array
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Relacionamento para o endereço
     *
     *  @var array
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
