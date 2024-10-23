<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Tipos extends Component
{
    use LivewireAlert;
    public $ocorrencia;
    public $ocorrencias = [];
    public $codtipo;
    public $descricao;

    public function mount()
    {
        $ocorrencias = DB::select('select codtipo, descricao from bdc_registros_tipos@dbl200 order by codtipo');
        $this->ocorrencias = $ocorrencias;

    }

    public function cadastro()
    {
        try {
            $this->validate([
                'ocorrencia' => 'required',
            ]);
            $codtipo = DB::select('select nvl(max(codtipo), 0) + 1 as codtipo from bdc_registros_tipos@dbl200');
            $codtipo = $codtipo[0]->codtipo;
            DB::insert('insert into bdc_registros_tipos@dbl200 (codtipo, descricao) values (:codtipo, upper(:descricao))', ['codtipo' => $codtipo, 'descricao' => $this->ocorrencia]);
            $this->ocorrencia = '';
            $this->alert('success', 'Cadastro realizado com sucesso!');
            $this->mount();
            $this->dispatch('FecharModalCadastro');
        } catch (\Exception $e) {
            $this->alert('error', 'Erro ao cadastrar!');
        }
    }

    public function excluir($codtipo)
    {
        try {
            $ocorrencias = DB::select('select count(*) as qtd from bdc_registros_ocorrencias@dbl200 where tipo_registro = :codtipo', ['codtipo' => $codtipo]);

            if($ocorrencias[0]->qtd > 0){
                $this->alert('error', 'Ocorrência não pode ser excluída, pois existem registros vinculados a ela!');
                return;
            }

            DB::delete('delete from bdc_registros_tipos@dbl200 where codtipo = :codtipo', ['codtipo' => $codtipo]);
            $this->alert('success', 'Ocorrência excluída com sucesso!');
            $this->mount();
        } catch (\Exception $e) {
            $this->alert('error', 'Erro ao excluir!');
        }
    }

    public function AbrirModalEdit($codtipo, $descricao)
    {
        $this->codtipo = $codtipo;
        $this->descricao = $descricao;
        $this->dispatch('AbrirModalEditar');
    }

    public function editar()
    {
        try {
            DB::update('update bdc_registros_tipos@dbl200 set descricao = upper(:descricao) where codtipo = :codtipo', ['descricao' => $this->descricao, 'codtipo' => $this->codtipo]);
            $this->alert('success', 'Ocorrência editada com sucesso!');
            $this->mount();
            $this->dispatch('FecharModalEditar');
        } catch (\Exception $e) {
            $this->alert('error', 'Erro ao editar!');
        }
    }

    public function render()
    {
        return view('livewire.tipos')->layout('layouts.home-layout');
    }
}
