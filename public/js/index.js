document.addEventListener('DOMContentLoaded', function () {

    function LoadHeaderComponents() {
        Helpers.ajax({
            method: 'GET',
            url: `${views_url}/home/header-components.php`,
            dataType: 'html',
            beforeSend: function (xhr) {
                
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

    

     $(document).on("submit", ".filtro", function (e) {
            e.preventDefault();
        
            var formData = $(this).serialize();
            document.querySelector(".spinner").style.display = "block"

            $.ajax({
                url: `${views_url}/home/list-imoveis.php?${formData}`,
                type: 'GET',
                data: formData,
                dataType: 'html',
                success: function (data) {
                document.querySelector(".spinner").style.display = "none"
                    
                    Dom.setHtml(".all-imoveis", data)
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        Helpers.ajax({
            method: 'GET',
            url: `${views_url}/home/list-imoveis.php`,
            dataType: 'html',

            beforeSend: function (xhr) {
               
            },
            success: function (data) {
                Dom.setHtml(".all-imoveis", data)
                let loadSpinner = document.querySelector(".spinner").style.display = "none"


            },
            error: function (error) { }
        })
        $(document).on("click", ".page-link", function () {
            var pageNumber = $(this).data('page');
                $.ajax({
                url: `${views_url}/home/list-imoveis.php?page=${pageNumber}`,
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                document.querySelector(".spinner").style.display = "none"

                    Dom.setHtml(".all-imoveis", data)
                    document.documentElement.scrollTop = 0;
                    document.body.scrollTop = 0;
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


    
        
    }

    LoadMainItems()



    function popOver() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });
    }
    popOver();

    $(document).ready(function () {
        var datalist = $('#datalistOptions');

        function buscarSugestoes(nomeCidade) {
            datalist.empty();

            $.ajax({
                url: `https://servicodados.ibge.gov.br/api/v1/localidades/municipios?nome=${nomeCidade}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    data.forEach(function (cidade) {
                        datalist.append(`<option value="${cidade.nome}, ${cidade.microrregiao.mesorregiao.UF.sigla}">`);
                    });
                }
            });
        }

        // Adicionar um evento de input ao campo de texto
        $('#cidadeInput').on('input', function () {
            var nomeCidade = $(this).val();
            buscarSugestoes(nomeCidade);
        });
    });


    $(document).on("click", "#clean-filter", function() {
        $("#filtro")[0].reset();
        LoadMainItems()
    });
     
 
    
});
