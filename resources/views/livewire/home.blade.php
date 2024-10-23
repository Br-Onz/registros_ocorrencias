<div>
    <div class="app-title">
        <div>
            <h1><i class="bi bi-speedometer"></i> Registros de Ocorrências</h1>
            <p>Cadastros de ocorrências</p>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="tile">
                    <h3 class="tile-title text-center mb-4">Formulário de Cadastro</h3>
                    <form wire:submit.prevent="cadastrar()">
                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-md mb-3">
                                    <label for="nome">Data de Ocorrência</label>
                                    <input type="date" class="form-control" placeholder="Data de Ocorrência" wire:model="data_ocorrencia">
                                </div>
                                <div class="col-md mb-3">
                                    <label for="nome">Tipo de Ocorrência</label>
                                    <select class="form-select" id="exampleFormControlSelect1" wire:model="tipo_ocorrencia">
                                        <option value="">Selecione um tipo de ocorrência</option>
                                        @foreach ($Tipo_ocorrencias as $index => $item)
                                            <option value="{{ $item->codtipo }}">{{ $item->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md mb-3">
                                    <label for="nome">Filial da Ocorrência</label>
                                    <select class="form-select" id="exampleFormControlSelect1" wire:model="filial">
                                        <option value="">Selecione uma Filial</option>
                                        @foreach ($Filiais as $index => $item)
                                            <option value="{{ $item->codfil }}">{{ $item->nomfil }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md mb-3">
                                    <label for="nome">Número de Transação</label>
                                    <input type="number" class="form-control" wire:model="numero_transacao">
                                </div>
                                <div class="col-md mb-3">
                                    <label for="nome">Funcionário</label>
                                    <input type="text" class="form-control" wire:model="search" wire:input="matriculas" autocomplete="off">
                                    <ul class="list-group mt-2 position-absolute z-40">
                                        @foreach ($func as $index => $item)
                                            <li class="list-group-item cursor-pointer hover:bg-gray-200 rounded-md p-2" wire:click="selectUser('{{ $item->nome }}', {{ $item->matricula }})">
                                                {{ $item->nome }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row flex justify-content-center">
                                <div class="col-md-6 mb-3">
                                    <textarea class="form-control" placeholder="Observações da Ocorrência" wire:model="observacoes" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
