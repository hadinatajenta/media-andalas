const modal = document.getElementById("myModal");

modal.addEventListener("show.bs.modal", async () => {
    // Wait until the modal has been created
    await modal.classList.add("is-active");

    // Now you can access the classList property
    console.log(modal.classList);
});
