<main class="painel card p-3 m-3" style="height: 1000px;">
  
    <div class="container text-center xl-2">
    <div class="h2 mb-3">Seus Imóveis Cadastrados</div>
        <div class="row">
            <div class="col btn card p-3" type="button" data-bs-toggle="modal" data-bs-target="#cadastrar-imovel">
                <i class="fa-solid fa-house-flag"></i>
                Cadastrar novo imóvel

            </div>
            <div class="col card p-3 btn mostrar-desarquivados">
                <i class="fa-solid fa-building"></i>
                Imóveis Cadastrados
                <div class="h3 imoveis-qtd-div">0</div>
            </div>
            <div class="col card p-3 btn mostrar-arquivados">
            <i class="fa-solid fa-box-archive"></i>
                Mostrar Arquivados
                <div class="h3 imoveis-arquivados-qtd-div">0</div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="row">

            <div class="col-xl card">

                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">ID</th>
                                <th scope="col">Nome do Imóvel</th>
                                <th scope="col">Descrição Básica</th>
                                <th scope="col">Localidade</th>
                                <th scope="col">Proprietário</th>
                                <th scope="col">Cadastrado em</th>
                                <div class="d-flex justify-content-center mt-5">
                                    <div class="spinner page-preload"></div>
                                </div>

                            </tr>
                        </thead>
                        <tbody class="imoveis">

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
    <div class="mt-4 message-info">
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100 mt-5">
            <div class="toast-container p-3" id="toastPlacement">
                <div class="toast">
                    <div class="toast-header">
                        <img src="..." class="rounded me-2" alt="...">
                        <strong class="me-auto">Sistema info.</strong>
                        <small>Informação</small>
                    </div>
                    <div class="toast-body">
                        Clique na seta ao topo para acessar as outras áreas do painel
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

