<?php

namespace Modules\Country\Entities;

use Illuminate\Database\Eloquent\Model;

class Initial extends Model
{
    use SoftDeletes;

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
        'name'
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
     * Relacionamento com país
     *
     *  @var array
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
