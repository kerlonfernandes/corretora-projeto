var quill;

function hideOverlay() {
    $("#overlay").fadeOut('slow', function () {
        $("#loader-container").hide();
        $("#custom-loader").hide();

    });
}

document.addEventListener('DOMContentLoaded', function () {

    function LoadImoveisTable() {

        Helpers.ajax({
            method: 'GET',
            url: `${base_url}/views/admins/imoves-list.php`,
            dataType: 'html',

            beforeSend: function (xhr) {
               
            },
            success: function (data) {
                Dom.setHtml(".imoveis", data)
                document.querySelector(".spinner").style.display = "none"

                document.querySelector(".imoveis-qtd-div").innerHTML = document.querySelector(".imoveis-qtd").value
                document.querySelector(".imoveis-arquivados-qtd-div").innerHTML = document.querySelector(".imoveis-arquivados-qtd").value


            },
            error: function (error) { }
        })
    }

    LoadImoveisTable()

    function main() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl);
        });
        toastList.forEach(function (toast) {
            toast.show();
        });

        let larguraTela = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

        function openNav() {
            $(".message-info").addClass("d-none");
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            let painel = document.querySelector(".painel");

            if (painel) {
                painel.style.right = "125px";
            }
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.querySelector(".painel").style.marginRight = "0";
            let painel = document.querySelector(".painel");

            if (painel) {
                painel.style.right = "0px";
            }
        }
        if (larguraTela <= 767) {
            
        } else {

            openNav()


        }
        document.querySelector(".open-sidebar").addEventListener("click", () => {
            openNav();
        });
        document.querySelector(".closebtn").addEventListener("click", () => {
            closeNav();
        });
        quill = new Quill('#editor', {
            theme: 'snow'
        });

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

            $('#cidadeInput').on('input', function () {
                var nomeCidade = $(this).val();
                buscarSugestoes(nomeCidade);
            });
        });
        $(document).on("click", ".mostrar-desarquivados", () => {
            LoadImoveisTable();
        })
        $(document).ready(function () {
            $('#imagens-imovel').change(function () {
                $('.carousel-inner').empty();
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];

                    const carouselItem = $('<div>').addClass('carousel-item');
                    const image = $('<img>').addClass('d-block w-100').attr('src', URL.createObjectURL(file));

                    carouselItem.append(image);

                    $('.carousel-inner').append(carouselItem);
                }

                $('.carousel-item').first().addClass('active');

                $('#carouselExample').carousel();
            });
        });

        document.querySelector("#imovel-price").addEventListener("input", function (event) {
            var elemento = document.getElementById("imovel-price");
            var valor = elemento.value;

            // Remova qualquer caractere não numérico
            valor = valor.replace(/[^\d]/g, '');

            // Adicione a vírgula para separar os centavos
            valor = valor.replace(/(\d{2})$/g, ",$1");

            // Adicione o ponto para milhares, milhões e bilhões
            if (valor.length > 5) {
                valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            }

            elemento.value = valor;
        });


    }

    function sendImovelCadastroForm() {
        $("#send-form").on("click", function () {
            // Coletar os dados do formulário
            var formData = new FormData($(".formulario-imovel-cadastro")[0]);
            let proprietario = $("#proprietario").val();
            let titulo_imovel = $("#titulo-imovel").val();
            // let images_name = $('[name="imagens[]"]').val();
            let descricao_curta = $("#descricao-curta").val();
            let descricao = quill.root.innerHTML;
            let price = $("#imovel-price").val();
            let localizacao = $("#cidadeInput").val();
            var images = [];
            var fileInput = $('[name="imagens[]"]')[0];
            if (fileInput.files.length > 0) {
                for (var i = 0; i < fileInput.files.length; i++) {
                    images.push(fileInput.files[i].name);
                }
            }

            
            let data = {
                "imovel_name": titulo_imovel,
                "imovel_description": descricao,
                "imovel_locality": localizacao,
                "price": price,
                "short_description": descricao_curta,
                "proprietario": proprietario
            }
            // $(".formulario-imovel-cadastro")[0].reset();
            // quill.root.innerHTML = ""

            $.ajax({
                url: `${base_url}/cadastra/imovel`, // Substitua pelo URL correto
                type: 'POST',
                data: data,
                success: function (response) {
                    response = JSON.parse(response)
                    if (response.status == "success") {
                        showToast("success", response.message)
                        $.ajax({
                            url: `${base_url}/processa/imovel-imagens?id=${response.imovel_id}`,
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                response = JSON.parse(response)
                                if (response.status == "success") {
                                    showToast("success", response.message)
                                }
                                else {
                                    showToast("error", response.message)
                                }
                                LoadImoveisTable()
                            },
                            error: function (error) {
                                console.error('Erro na requisição Ajax:', error);
                            }
                        });
                    }
                    else {
                        showToast("error", response.message)
                    }
                },
                error: function (error) {
                    console.error(error);
                }
            });

        });

    }
    function arquivarImovel() {
        $(document).on("click", ".arquivar", (e) => {
            let id = e.target.dataset.id;
            $.ajax({
                url: `${base_url}/arquivar/imovel`, // Substitua pelo URL correto
                type: 'POST',
                data: {
                    "id": id
                },
                success: function (response) {
                    response = JSON.parse(response)
                    if (response.status == "success") {
                        showToast("success", response.message)
                    }
                    else {
                        showToast("error", response.message)
                    }
                    LoadImoveisTable()
                },
                error: function (error) {
                    console.error(error);
                }
            });
        })

    }
    function desarquivarImovel() {
        $(document).on("click", ".desarquivar", (e) => {
            let id = e.target.dataset.id;
            $.ajax({
                url: `${base_url}/desarquivar/imovel`, // Substitua pelo URL correto
                type: 'POST',
                data: {
                    "id": id
                },
                success: function (response) {
                    response = JSON.parse(response)
                    if (response.status == "success") {
                        showToast("success", response.message)
                    }
                    else {
                        showToast("error", response.message)
                    }
                    mostrarArquivados()
                    
                },
                error: function (error) {
                    console.error(error);
                }
            });
        })

    }
    function mostrarArquivados() {

        $(document).on("click", ".mostrar-arquivados", () => {
            document.querySelector(".spinner").style.display = "block"
            Helpers.ajax({
                method: 'GET',
                url: `${base_url}/views/admins/imoves-arquivados-list.php`,
                dataType: 'html',

                beforeSend: function (xhr) {
                },
                success: function (data) {
                    document.querySelector(".spinner").style.display = "none"
                    Dom.setHtml(".imoveis", data)


                },
                error: function (error) { }
            })
        });
    }
    function apagarImovel() {
        $(document).on("click", ".apagar", (e) => {

            let id = e.target.dataset.id;
            $.ajax({
                url: `${base_url}/apagar/imovel`, // Substitua pelo URL correto
                type: 'POST',
                data: {
                    "id": id
                },
                success: function (response) {
                    response = JSON.parse(response)
                    if (response.status == "success") {
                     
                        showToast(type = "success", message = response.message)
                    }
                    else {
                        showToast("error", message = response.message)
                    }
                    LoadImoveisTable()
                },
                error: function (error) {
                    console.error(error);
                }
            });
        })
    }
    main();
    arquivarImovel()
    desarquivarImovel()
    mostrarArquivados()
    apagarImovel()
    sendImovelCadastroForm()
    hideOverlay()
});