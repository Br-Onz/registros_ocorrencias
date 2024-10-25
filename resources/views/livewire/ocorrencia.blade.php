<div>
    <div class="app-title">
        <div>
            <h1><i class="bi bi-speedometer"></i> Registros das Ocorrências</h1>
            <p>Listando os Registros das Ocorrências</p>
        </div>
    </div>

    <div class="container mt-4" wire:ignore>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="tile">
                    <table class="table table-bordered table-hover" id="sampleTable">
                        <thead>
                        <tr class="text-center text-uppercase">
                            <th>Usuario</th>
                            <th>Filial</th>
                            <th>Registro</th>
                            <th>Data da Ocorrência</th>
                            <th>Número da Transação</th>
                            <th>Funcionário</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ocorrencias as $index => $item)
                            <tr class="text-center cursor-pointer" wire:click="abrirModal({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#ModalOcorrencia">
                                <td class="text-center">{{ $item->nome_usuario }}</td>
                                <td class="text-center">{{ $item->filial }}</td>
                                <td class="text-center">{{ $item->tipo_registro }}</td>
                                <td class="text-center">{{ $item->data }}</td>
                                <td class="text-center">{{ $item->numero_transacao }}</td>
                                <td class="text-center">{{ $item->nome_func }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div >

    <!-- Modal Ocorrencia -->
    <div class="modal fade" id="ModalOcorrencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhe da Ocorrência</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($ModalOcorrencia)
                        <div class="mb-2">
                            <textarea class="form-control" rows="10">{{ $ModalOcorrencia[0]->descricao }}</textarea>
                        </div>
                        <div class="grid">
                            <span>Data criação: {{ $ModalOcorrencia[0]->data_criacao }}</span>
                            <span>Usuário criação: {{ $ModalOcorrencia[0]->nome_usuario }}</span>
                            <span>Número da Transação: {{ $ModalOcorrencia[0]->numero_transacao }}</span>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</div>
