document.addEventListener('DOMContentLoaded', function() {
    const backToTop = document.getElementById('back-to-top');
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTop.style.display = 'block';
        } else {
            backToTop.style.display = 'none';
        }
    });
    
    // Instant scroll to top with no delay
    backToTop.addEventListener('click', function(e) {
        e.preventDefault();
        // Use scrollTo with no smooth behavior for instant scrolling
        window.scrollTo(0, 0);
    });
});