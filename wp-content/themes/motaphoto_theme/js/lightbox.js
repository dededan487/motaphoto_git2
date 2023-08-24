jQuery(document).ready(function(jQuery) {
    var lightboxOpen = false;
    var currentImageIndex = 0;

    var images = [];

    jQuery('.lightbox-icon').each(function() {
        images.push(jQuery(this).siblings('img').attr('src'));
    });

    jQuery('.lightbox-icon').click(function(e) {
        e.preventDefault();
        var imageUrl = jQuery(this).siblings('img').attr('src');
        var imageTitle = jQuery(this).siblings('img').attr('title');

        currentImageIndex = images.indexOf(imageUrl);

        if (!lightboxOpen) {
            jQuery('.lightbox-image').attr('src', imageUrl);
            jQuery('.photo-title').text(imageTitle);
            jQuery('.lightbox-overlay, .lightbox').fadeIn();
            lightboxOpen = true;
        }
    });

    jQuery('.close-lightbox').click(function() {
        closeLightbox();
    });

    // Navigation précédent/suivant
    jQuery('.previous-photo').click(function() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        updateLightboxImage();
    });

    jQuery('.next-photo').click(function() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        updateLightboxImage();
    });

    jQuery('.lightbox-overlay').click(function() {
        closeLightbox();
    });

    function updateLightboxImage() {
        var imageUrl = images[currentImageIndex];
        jQuery('.lightbox-image').attr('src', imageUrl);
        jQuery('.photo-title').text(jQuery('.lightbox-icon').eq(currentImageIndex).siblings('img').attr('title'));
    }

    function closeLightbox() {
        jQuery('.lightbox-overlay, .lightbox').fadeOut();
        lightboxOpen = false;
    }
});
