const imageInput = document.getElementById("image");
const imagePreview = document.getElementById("book-cover-preview");

if (imageInput && imagePreview) {
  imageInput.addEventListener("change", function (event) {
    const [file] = event.target.files;
    if (file) {
      // Remplace temporairement la source de l'image par le fichier sélectionné
      imagePreview.src = URL.createObjectURL(file);
    }
  });
}
