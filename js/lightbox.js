/**
 * Project Gallery Lightbox
 * 
 * Adds lightbox functionality to project gallery images
 */

document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on a project single page and have a gallery
    const gallerySlider = document.querySelector('.project-gallery-slider');
    if (!gallerySlider) return;

    const slides = gallerySlider.querySelectorAll('.swiper-slide img');
    if (slides.length === 0) return;

    // Create lightbox elements
    const overlay = document.createElement('div');
    overlay.className = 'lightbox-overlay';

    const lightboxContent = document.createElement('div');
    lightboxContent.className = 'lightbox-content';

    const lightboxImage = document.createElement('img');
    lightboxImage.className = 'lightbox-image';

    const loadingIndicator = document.createElement('div');
    loadingIndicator.className = 'lightbox-loading';

    const caption = document.createElement('div');
    caption.className = 'lightbox-caption';

    const closeBtn = document.createElement('div');
    closeBtn.className = 'lightbox-close';
    closeBtn.innerHTML = '&times;';

    const prevBtn = document.createElement('div');
    prevBtn.className = 'lightbox-nav lightbox-prev';
    prevBtn.innerHTML = '&#10094;';

    const nextBtn = document.createElement('div');
    nextBtn.className = 'lightbox-nav lightbox-next';
    nextBtn.innerHTML = '&#10095;';

    // Build lightbox structure
    lightboxContent.appendChild(loadingIndicator);
    lightboxContent.appendChild(lightboxImage);
    lightboxContent.appendChild(caption);
    lightboxContent.appendChild(closeBtn);
    lightboxContent.appendChild(prevBtn);
    lightboxContent.appendChild(nextBtn);
    overlay.appendChild(lightboxContent);
    document.body.appendChild(overlay);

    let currentIndex = 0;
    const images = [];

    // Collect all gallery images
    slides.forEach((img, index) => {
        images.push({
            src: img.src,
            alt: img.alt || 'Project Image ' + (index + 1)
        });

        // Add click handler to each image
        img.addEventListener('click', function(e) {
            e.preventDefault();
            openLightbox(index);
        });

        // Add cursor style to indicate clickability
        img.style.cursor = 'zoom-in';
    });

    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function updateLightbox() {
        // Show loading indicator
        loadingIndicator.style.display = 'block';
        lightboxImage.style.display = 'none';

        // Set image source
        lightboxImage.src = images[currentIndex].src;
        lightboxImage.alt = images[currentIndex].alt;
        caption.textContent = images[currentIndex].alt;

        // Handle image load
        lightboxImage.onload = function() {
            loadingIndicator.style.display = 'none';
            lightboxImage.style.display = 'block';
        };

        lightboxImage.onerror = function() {
            loadingIndicator.style.display = 'none';
            lightboxImage.style.display = 'block';
            lightboxImage.src = 'https://placehold.co/800x600?text=Image+Not+Found';
        };
    }

    function closeLightbox() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    function showNext() {
        currentIndex = (currentIndex + 1) % images.length;
        updateLightbox();
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateLightbox();
    }

    // Event listeners
    closeBtn.addEventListener('click', closeLightbox);
    nextBtn.addEventListener('click', showNext);
    prevBtn.addEventListener('click', showPrev);

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!overlay.classList.contains('active')) return;

        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowRight':
                showNext();
                break;
            case 'ArrowLeft':
                showPrev();
                break;
        }
    });

    // Close on overlay click
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            closeLightbox();
        }
    });

    // Add toggle button to enable/disable lightbox
    const galleryHeader = document.querySelector('.project-gallery-slider');
    if (galleryHeader) {
        const toggleContainer = document.createElement('div');
        toggleContainer.style.textAlign = 'right';
        toggleContainer.style.marginBottom = '10px';

        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'btn btn-secondary btn-small';
        toggleBtn.textContent = 'Enable Lightbox';
        toggleBtn.style.fontSize = '14px';
        toggleBtn.style.padding = '5px 10px';

        let lightboxEnabled = true;

        toggleBtn.addEventListener('click', function() {
            lightboxEnabled = !lightboxEnabled;
            toggleBtn.textContent = lightboxEnabled ? 'Disable Lightbox' : 'Enable Lightbox';

            slides.forEach(img => {
                if (lightboxEnabled) {
                    img.style.cursor = 'zoom-in';
                    img.addEventListener('click', function(e) {
                        e.preventDefault();
                        const index = Array.from(slides).indexOf(img);
                        openLightbox(index);
                    });
                } else {
                    img.style.cursor = '';
                    img.removeEventListener('click', function(e) {
                        e.preventDefault();
                        const index = Array.from(slides).indexOf(img);
                        openLightbox(index);
                    });
                }
            });
        });

        // Insert toggle button before the gallery
        gallerySlider.parentNode.insertBefore(toggleContainer, gallerySlider);
        toggleContainer.appendChild(toggleBtn);
    }
});