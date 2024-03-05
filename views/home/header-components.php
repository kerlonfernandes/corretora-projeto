<div class="d-flex justify-content-center">
    <form class="d-flex filtro flex-column flex-md-row text-center" id="filtro" role="search">
        <div class="input-group">
            <input class="form-control me-2 mb-2 imovel-nome"  type="search" placeholder="Pesquisar pelo imóvel" name="imovel_name" aria-label="Search">
        
            <div class="btn-group d-flex flex-wrap" role="group" aria-label="Search Categories">
                    <div class="mb-2">
                <button class="btn btn-outline-danger" style="border-radius: 1px;" id="clean-filter" type="button">Limpar Filtro</button>
            </div>
                <input type="radio" class="btn-check" name="category" id="alugar" value="Aluguel" autocomplete="off" style="border-radius: 1px">
                <label class="btn btn-outline-secondary mb-2" for="alugar">Alugar</label>

                <input type="radio" class="btn-check" name="category" id="temporada" value="Temporada" autocomplete="off">
                <label class="btn btn-outline-secondary mb-2" for="temporada">Temporada</label>

                <input type="radio" class="btn-check" name="category" id="diaria" value="Diária" autocomplete="off">
                <label class="btn btn-outline-secondary mb-2" for="diaria">Diária</label>

                <input type="radio" class="btn-check" name="category" id="comprar" value="Venda" autocomplete="off">
                <label class="btn btn-outline-secondary mb-2" for="comprar">Comprar</label>
            </div>
        </div>
        <div class="mb-2">
            <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
