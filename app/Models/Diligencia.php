<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Diligencia.
 *
 * @package namespace App\Models;
 */
class Diligencia extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "diligencias";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
		'origem_id',
		'cidade_id',
        'rota_id',
        'localizacao_id',
        'situacao_id',
        'status',
        'data_hora',
        'nome',
        'creci',
        'telefone',
        'endereco',
        'observacao',
        'nome_denunciante',
        'telefone_denunciante',
	];

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] =  mb_strtoupper($value);
    }
    public function setCreciAttribute($value)
    {
        $this->attributes['creci'] =  mb_strtoupper($value);
    }
    public function setTelefoneAttribute($value)
    {
        $this->attributes['telefone'] =  mb_strtoupper($value);
    }
    public function setEnderecoAttribute($value)
    {
        $this->attributes['endereco'] =  mb_strtoupper($value);
    }
    public function setObservacaoAttribute($value)
    {
        $this->attributes['observacao'] =  mb_strtoupper($value);
    }

    public function ocorrencias()
    {
        return $this->belongsToMany(Ocorrencia::class, 'diligencia_ocorrencia');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function origem()
    {
        return $this->belongsTo(Origem::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
    public function rota()
    {
        return $this->belongsTo(Rota::class);
    }

    public function localizacao()
    {
        return $this->belongsTo(Localizacao::class);
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class);
    }

    public function historico()
    {
        return $this->hasMany(Historico::class);
    }

    public function search(Array $data)
    {
        return $this->where(function ($query) use ($data) {
            if(isset($data['busca']))
                $query->where('id', $data['busca'])
                    ->orWhere('nome', 'LIKE', '%' . $data['busca'] . '%')
                    ->orWhere('telefone', 'LIKE', '%' . $data['busca'] . '%');
        })->paginate(20);
    }

}
