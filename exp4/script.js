// Filter images
function filterImages(category) {
    let images = document.querySelectorAll(".gallery img");

    images.forEach(img => {
        if (category === "all" || img.classList.contains(category)) {
            img.style.display = "block";
        } else {
            img.style.display = "none";
        }
    });
}

// Open modal
function openModal(img) {
    document.getElementById("modal").style.display = "flex";
    document.getElementById("modalImg").src = img.src;
}

// Close modal
function closeModal() {
    document.getElementById("modal").style.display = "none";
}