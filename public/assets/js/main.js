document.addEventListener("DOMContentLoaded", function () {
  // --- 1. PRÉVISUALISATION DES IMAGES ---
  const imageInput = document.querySelector(".image-input");
  const imagePreview = document.querySelector(".image-preview");

  if (imageInput && imagePreview) {
    imageInput.addEventListener("change", function (event) {
      const [file] = event.target.files;
      if (file) {
        imagePreview.src = URL.createObjectURL(file);
      }
    });
  }

  // --- 2. REDIMENSIONNEMENT DU TEXTAREA ---
  const textarea = document.querySelector(".textarea-auto-resize");

  if (textarea) {
    function autoResize() {
      // 1. On réinitialise la hauteur pour recalculer le scrollHeight réel
      textarea.style.height = "auto";

      // 2. On applique la hauteur du contenu
      textarea.style.height = textarea.scrollHeight + "px";

      // 3. Si la hauteur réelle du contenu dépasse la hauteur d'affichage maximale,
      // l'ascenseur apparaît, sinon il reste masqué.
      if (textarea.scrollHeight > textarea.offsetHeight) {
        textarea.style.overflowY = "auto";
      } else {
        textarea.style.overflowY = "hidden";
      }
    }

    textarea.addEventListener("input", autoResize);

    // Petit fix pour le chargement initial (laisse le temps au DOM de calculer les hauteurs)
    setTimeout(autoResize, 50);
  }
});
