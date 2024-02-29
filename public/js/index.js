document.addEventListener('DOMContentLoaded', function () {

    function LoadHeaderComponents() {
        Helpers.ajax({
            method: 'GET',
            url: `${views_url}/home/header-components.php`,
            dataType: 'html',
            beforeSend: function (xhr) {
                console.log("enviando...")
            },
            success: function (data) {
                Dom.removeClass(".header-components", "loader")
                Dom.setHtml(".header-components", data)

            },
            error: function (error) { }
        })
    }
    LoadHeaderComponents();

    function LoadMainItems() {
        Helpers.ajax({
            method: 'GET',
            url: `${views_url}/home/list-imoveis.php`,
            dataType: 'html',

            beforeSend: function (xhr) {
                console.log("enviando...")
            },
            success: function (data) {
                Dom.setHtml(".all-imoveis", data)
                let loadSpinner = document.querySelector(".spinner").style.display = "none"


            },
            error: function (error) { }
        })
    }

    LoadMainItems()



    var footer = document.getElementById('sticky-footer');
    var isFooterVisible = false;

    window.addEventListener('scroll', function () {
        var scrollPosition = window.scrollY;

        // Se a posição de rolagem for maior que 100, mostra o rodapé
        if (scrollPosition > 100 && !isFooterVisible) {
            footer.classList.add('show');
            isFooterVisible = true;
        }

        // Se a posição de rolagem for menor que 100, esconde o rodapé
        if (scrollPosition <= 100 && isFooterVisible) {
            footer.classList.remove('show');
            isFooterVisible = false;
        }
    });

    function popOver() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });
    }
    popOver();

    $(document).ready(function(){
        var datalist = $('#datalistOptions');
    
        function buscarSugestoes(nomeCidade) {
            datalist.empty();
    
            $.ajax({
                url: `https://servicodados.ibge.gov.br/api/v1/localidades/municipios?nome=${nomeCidade}`,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    data.forEach(function(cidade){
                        datalist.append(`<option value="${cidade.nome}, ${cidade.microrregiao.mesorregiao.UF.sigla}">`);
                    });
                }
            });
        }
    
        // Adicionar um evento de input ao campo de texto
        $('#cidadeInput').on('input', function() {
            var nomeCidade = $(this).val();
            buscarSugestoes(nomeCidade);
        });
    });


});