let edit = document.querySelector("#edit");
let overlay = document.querySelector(".overlay");

let close = document.querySelector(".close i");

edit.addEventListener("click", () => {
    overlay.classList.add("active")
})

close.addEventListener("click", () => {
    overlay.classList.remove("active")
})
