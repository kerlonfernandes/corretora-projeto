
const admin_base_url = `../${base_url}/admin`
console.log(admin_base_url)

document.addEventListener('DOMContentLoaded', function () {
    let successMessageElement = document.getElementById("success-message");


    function authAdmin() {
        document.querySelector(".login-form").addEventListener("submit", (e) => {
            e.preventDefault();
            let data = {
                "email": Dom.sel("#user").value,
                "password": Dom.sel("#password").value
            }
            console.log(data)

            var errorMessageElement = Dom.sel("#error-message");

            if (user.value === "" || password.value === "") {
                errorMessageElement.textContent = "Por favor, preencha todos os campos.";
                return false;
            }
            else {
                errorMessageElement.textContent = "";
                $.ajax({
                    method: 'POST',
                    url: `${admin_base_url}/auth`,
                    data: data, // Convertendo os dados para JSON,
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        $("#loading").show()
                    },
                    success: function (data) {
                        $("#loading").hide()
                        if (data.status == "success") {
                            successMessageElement.style.display = "block";
                            $(successMessageElement).fadeIn(1000).delay(3000).fadeOut(1000);
                            location.href = `${admin_base_url}/painel/?area=imoveis`
                        }
                        else if (data.status == "error") {

                            $("#loading").hide()
                            Dom.sel("#password").value = ""
                            let errorMessage = document.querySelector(".alert-danger");
                            errorMessage.style.display = "block";
                            $(errorMessage).fadeIn(1000).delay(3000).fadeOut(1000);
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })

            }
        });
    }
    authAdmin();
});