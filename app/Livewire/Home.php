<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Home extends Component
{
    use LivewireAlert;

    public $Tipo_ocorrencias = [];
    public $Filiais = [];
    public $data_ocorrencia;
    public $tipo_ocorrencia;
    public $filial;
    public $matricula;
    public $numero_transacao;
    public $observacoes;
    public $search;
    public $func= [];

    public function mount()
    {
        $Tipo_ocorrencias = DB::select('select codtipo, descricao from bdc_registros_tipos@dbl200 order by codtipo');
        $this->Tipo_ocorrencias = $Tipo_ocorrencias;

        $Filiais = DB::select('SELECT   pc.codigo AS codfil, pc.contato AS nomfil
                                      FROM       pcfilial pc
                                             INNER JOIN
                                                 r030fil@dblsenior fil
                                             ON pc.codigo = fil.codfil and pc.codigo <> 11');
        $this->Filiais = $Filiais;
    }

    public function cadastrar()
    {

         if(empty($this->data_ocorrencia) || empty($this->tipo_ocorrencia) || empty($this->matricula) || empty($this->filial) || empty($this->observacoes)){
            $this->alert('error','Preencha todos os campos!');
            return;
        }


        $data_ocorrencia = $this->data_ocorrencia;
        $tipo_ocorrencia = $this->tipo_ocorrencia;
        $matricula = $this->matricula;
        $numero_transacao = $this->numero_transacao;
        $filial = $this->filial;
        $observacoes = $this->observacoes;

        $matricula = DB::select('select matricula from pcempr where matricula = ?', [$matricula]);
        if (empty($matricula)) {
            $this->alert('error','Matrícula do funcionário não encontrado!');
            return;
        }

        $matricula = $matricula[0]->matricula;


        DB::insert('insert into bdc_registros_ocorrencias@dbl200 (id, codusuario, tipo_registro, data, filial, codfunc, data_criacao, descricao, numero_transacao)
            values (seq_reg_ocorrencias_id.NEXTVAL@dbl200, ?, ?, ?, ?, ?, SYSDATE, ?, ?)',
            [auth()->user()->matricula, $tipo_ocorrencia, $data_ocorrencia, $filial, $matricula, $observacoes, $numero_transacao]);


        $this->data_ocorrencia = null;
        $this->tipo_ocorrencia = null;
        $this->matricula = null;
        $this->numero_transacao = null;
        $this->filial = null;
        $this->observacoes = null;
        $this->alert('success','Registro cadastrado com sucesso!');
    }

    public function matriculas()
    {
        if (empty($this->search)) {
            $this->func = [];
            return;
        }
        $mat = DB::select("select matricula|| ' - '  || nome AS nome, matricula from pcempr where ( matricula like ? or upper(nome) like upper(?) ) and rownum <= 5", [$this->search.'%', $this->search.'%']);
        $this->func = $mat;
    }

    public function selectUser($nome, $matricula)
    {
        $this->search = $nome;
        $this->matricula = $matricula;
        $this->func = [];
    }

    public function render()
    {
        return view('livewire.home')->layout('layouts.home-layout');
    }
}
