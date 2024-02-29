var quill;

function hideOverlay() {
    $("#overlay").fadeOut('slow', function() {
        $("#loader-container").hide();
        $("#custom-loader").hide();
    
      });
    }

document.addEventListener('DOMContentLoaded', function () {

    function LoadImoveisTable() {
        Helpers.ajax({
            method: 'GET',
            url: `../../views/admins/imoves-list.php`,
            dataType: 'html',

            beforeSend: function (xhr) {
                console.log("enviando...")
            },
            success: function (data) {
                Dom.setHtml(".imoveis", data)
                document.querySelector(".spinner").style.display = "none"
                
                document.querySelector(".imoveis-qtd-div").innerHTML = document.querySelector(".imoveis-qtd").value
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
            console.log("mobile")
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
                url: 'https://localhost/projeto-corretora/cadastra/imovel', // Substitua pelo URL correto
                type: 'POST',
                data: data ,
                success: function (response) {
                    response = JSON.parse(response)
                    
                    if(response.status == "success") {
                        formData.imovel_id = response.imovel_id
                        $.ajax({
                            url: 'https://localhost/projeto-corretora/processa/imovel-imagens', 
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log(formData)
                                console.log(response)
                            },
                            error: function (error) {
                                console.error('Erro na requisição Ajax:', error);
                            }
                        });
                    }
                },
                error: function (error) {
                    console.error(error);
                }
            });

        });

    }

    main();
    sendImovelCadastroForm()
    hideOverlay()
});