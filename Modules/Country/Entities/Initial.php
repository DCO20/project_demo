<?php

namespace Modules\Country\Entities;

use Illuminate\Database\Eloquent\Model;

class Initial extends Model
{

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'initials';

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'country_id',
        'initial'
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
     * Relacionamento com país
     *
     *  @var array
     */
    public function country()
    {
        return $this->belongsTo(Country::class)->withTrashed();
    }
}
