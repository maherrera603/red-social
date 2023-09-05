let add = document.querySelector(".add-publication");
let overlay = document.querySelector(".overlay");

let close = document.querySelector(".close i");

add.addEventListener("click", () => {
    overlay.classList.add("active")
})

close.addEventListener("click", () => {
    overlay.classList.remove("active")
})
