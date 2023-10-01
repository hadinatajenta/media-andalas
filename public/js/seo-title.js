document.getElementById("judul_berita").addEventListener("input", function () {
    let title = this.value;
    let url = title
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, "-")
        .replace(/(^-|-$)/g, "");
    document.getElementById("url").value = url;
});
