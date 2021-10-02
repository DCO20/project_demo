<?php

namespace Modules\Country\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Country\Presenter\CountryPresenter;
use Modules\Location\Entities\Location;

class Country extends Model
{
    use SoftDeletes, Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
    */
    protected $presenter = CountryPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'countries';

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
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
     * Relacionamento com localização
     *
     *  @var array
     */
    public function location()
    {
        return $this->hasOne(Location::class);
    }

    /**
     * Relacionamento com sigla
     *
     *  @var array
     */
    public function initial()
    {
        return $this->hasOne(Initial::class);
    }
}
