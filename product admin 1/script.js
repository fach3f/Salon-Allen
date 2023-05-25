// Scroll smooth pada menu navigasi
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Slider gambar pada bagian galeri
const galleryImages = document.querySelectorAll('#gallery .gallery-images img');
let currentIndex = 0;

function showNextImage() {
    galleryImages[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + 1) % galleryImages.length;
    galleryImages[currentIndex].classList.add('active');
}

setInterval(showNextImage, 3000); // Ubah gambar setiap 3 detik