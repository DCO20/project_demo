<?php

namespace Modules\Location\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Country\Entities\Country;
use Modules\Location\Presenter\LocationPresenter;

class Location extends Model
{
    use SoftDeletes, Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = LocationPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'locations';

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'country_id',
        'lat',
        'long'
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
     * Relacionamento para as entidades
     *
     *  @var array
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Retorna o valor formatado para o front
    public function formatCountryName()
    {
        return $this->country->pluck('name')->implode(", ");
    }
}
