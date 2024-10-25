<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PDO;
use Illuminate\Support\Facades\Crypt;

class Ocorrencias extends Component
{
    use LivewireAlert;
    public $ocorrencias = [];
    public $ModalOcorrencia;

    public function mount()
    {
        $this->ocorrencias = DB::select('SELECT   ro.id,
         pc_usuario.nome AS nome_usuario,
         tp.descricao as tipo_registro,
         to_char(ro.data, \'DD/MM/YYYY\') AS data,
         ro.filial,
         pc_func.nome AS nome_func,
         to_char(ro.data_criacao, \'DD/MM/YYYY HH24:MI:SS\') AS data_criacao,
         ro.descricao
  FROM               bdc_registros_ocorrencias@dbl200 ro
                 INNER JOIN
                     bdc_registros_tipos@dbl200 tp
                 ON ro.tipo_registro = tp.codtipo
             LEFT JOIN
                 pcempr pc_usuario
             ON pc_usuario.matricula = ro.codusuario
         LEFT JOIN
             pcempr pc_func
         ON pc_func.matricula = ro.codfunc');
    }

    public function abrirModal($id)
    {
        $ocorrencia = DB::select('SELECT   ro.id,
         pc_usuario.nome AS nome_usuario,
         tp.descricao as tipo_registro,
         to_char(ro.data, \'DD/MM/YYYY\') AS data,
         ro.filial,
         pc_func.nome AS nome_func,
         to_char(ro.data_criacao, \'DD/MM/YYYY HH24:MI:SS\') AS data_criacao,
         ro.descricao
  FROM               bdc_registros_ocorrencias@dbl200 ro
                 INNER JOIN
                     bdc_registros_tipos@dbl200 tp
                 ON ro.tipo_registro = tp.codtipo
             LEFT JOIN
                 pcempr pc_usuario
             ON pc_usuario.matricula = ro.codusuario
         LEFT JOIN
             pcempr pc_func
         ON pc_func.matricula = ro.codfunc
    WHERE ro.id = ?', [$id]);
        $this->ModalOcorrencia = $ocorrencia;
        $this->dispatch('abrirModalOcorrencia', $ocorrencia);
    }

    public function render()
    {
        return view('livewire.ocorrencia')->layout('layouts.home-layout');
    }
}
