<?php

namespace Modules\Category\Entities;

use App\Traits\Presentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Presenter\CategoryPresenter;

class Category extends Model
{
    use SoftDeletes,  Presentable;

    /**
     * Presenter
     *
     * @var string $presenter
     */
    protected $presenter = CategoryPresenter::class;

    /**
     * Tabela do banco de dados
     *
     * @var string $table
     */
    protected $table = 'categories';

    /**
     * Atributos da tabela do banco de dados
     *
     *  @var array $fillable
     */
    protected $fillable = [
        'name',
        'active',
        'description'
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
     * Trativa da tabela do banco de dados
     *
     *  @var array $casts
     */
    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * Retorna sim ou não
     *
     */
    public function getFormattedActiveAttribute()
    {
        return $this->active ? "Sim" : "Não";
    }
}
