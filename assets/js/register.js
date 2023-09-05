let form = document.querySelector("body form");
let url = "http://localhost/redSocial/";
form.addEventListener("submit", e => {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: `${url}user/create`,
        dataType: "text",
        data: new FormData($(form)[0]),
        processData: false,
        contentType: false,
        beforeSend: () => {
            alert("Espere un momento los datos se estan procesando");
        },
        success: data =>{
            console.log(data)
        }
    });
})