<?php

namespace Modules\Provider\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = "contacts";

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'provider_id',
        'phone',
        'phone_type',
        'email',
        'email_type'
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
}
