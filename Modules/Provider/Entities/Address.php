<?php

namespace Modules\Provider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = "adresses";

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'provider_id',
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
        'updated_at',
        'deleted_at'
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
}
