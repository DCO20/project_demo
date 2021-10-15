<?php

namespace Modules\Purveyor\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Purveyor\Presenter\PurveyorPresenter;

class Purveyor extends Model
{
    use SoftDeletes,
        Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = PurveyorPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'purveyors';

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'cnpj',
        'active'

    ];

    /**
     * Trativa da tabela do banco de dados
     *
     * @var array $casts
     */
    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Atributos da tabela do banco de dados
     *
     * @var array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /*
	|--------------------------------------------------------------------------
	| Accessors
	|--------------------------------------------------------------------------
	|
	| Definição dos métodos GET desta entidade.
	| Estes métodos permitem formatar os atributos Eloquent obtidos do banco de dados.
	|
	*/

    /**
     * Retorna sim ou não
     */
    public function getFormattedActiveAttribute()
    {
        return $this->active ? "Sim" : "Não";
    }
}
