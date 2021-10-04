<?php

namespace Modules\State\Entities;

use App\Traits\Presentable;
use Modules\Country\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Modules\State\Presenter\StatePresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes, Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = StatePresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'states';

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'country_id',
        'name',
        'initial'
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
        return $this->belongsTo(Country::class)->withTrashed();
    }
}
