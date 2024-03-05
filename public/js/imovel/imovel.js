document.addEventListener('DOMContentLoaded', function () {



    let larguraTela = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (larguraTela <= 767) {
        let preco = document.querySelectorAll(".price");
        preco.forEach(e => {
            e.style.fontSize = '18px'
        });
    }
    else {
        let preco = document.querySelectorAll(".price");
        preco.forEach(e => {
            e.style.fontSize = '64px'
        });
    }
    document.querySelectorAll(".price").forEach(e => {
        e.addEventListener("mouseenter", () => {
            e.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
        });
    
        e.addEventListener("mouseleave", () => {
            e.style.backgroundColor = "";
        });
    
        // Adicionando uma transição suave
        e.style.transition = "background-color 0.3s ease";
    });

    function Contato() {
        $(document).on("submit", "#interessou", function(e) {
            e.preventDefault();
            let form = $(this).serialize();
            console.log(form)
        })
    }
    Contato();
});