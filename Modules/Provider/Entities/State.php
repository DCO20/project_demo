<?php

namespace Modules\Provider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = "states";

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'name',
        'abbr'
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
     * Relacionamento com as cidades
     *
     *  @var array
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
