<?php

namespace Modules\Client\Entities;

use Modules\Suit\Entities\Suit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientSuit extends Model
{
	use HasFactory;

	/**
	 * Tabela do banco de dados
	 *
	 * @var string $table
	 */
	protected $table = 'client_suit';

	/**
	 * Atributos da tabela do banco de dados
	 *
	 * @var array $fillable
	 */
	protected $fillable = [
		'client_id',
		'suit_id'
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Obtém as categoria
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	/**
	 * Obtém os produto
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function suit()
	{
		return $this->belongsTo(Suit::class);
	}
}
