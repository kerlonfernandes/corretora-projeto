<div class="modal fade" id="cadastrar-imovel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar imóvel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="formulario-imovel-cadastro">
                    <div class="mb-3">
                        <label for="proprietario">Proprietário do imóvel</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" id="proprietario" name="proprietario" placeholder="Nome do Proprietário">
                        </div>
                        <div class="mb-3">
                            <label for="imagens-imovel" class="form-label">Adicione as imagens do imóvel:</label>
                            <input class="form-control" type="file" id="imagens-imovel" name="imagens[]" multiple>
                            <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>

                        <label for="titulo-imovel" class="col-form-label">Título do imóvel</label>
                        <input type="text" class="form-control" id="titulo-imovel" name="titulo-imovel">
                    </div>
                    <div class="mb-3">
                        <label for="descricao-curta" class="col-form-label">Dê uma breve descrição do imóvel</label>
                        <textarea type="text" class="form-control" id="descricao-curta" name="short-description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editor">Escreva as características do imóvel</label>
                        <div id="editor" name="caracteristicas">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="imovel-price" class="col-form-label">Preço do Imóvel:</label>
                        <input type="text" class="form-control" id="imovel-price" name="price" pattern="[0-9]+(\.[0-9]+)?" title="Apenas números são permitidos">
                    </div>
                    <div class="mb-3">
                        <label for="cidadeInput" class="form-label">Digite o nome da cidade:</label>
                        <input class="form-control" list="datalistOptions" id="cidadeInput" name="localizacao" placeholder="Ex:.. São Mateus, ES">
                        <datalist id="datalistOptions"></datalist>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" id="send-form" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>