function handleBackToTopVisibility() {
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    }
}

// Handle scroll event globally to avoid adding multiple listeners
window.addEventListener('scroll', handleBackToTopVisibility);

// Check visibility on load or turbo navigation
document.addEventListener('DOMContentLoaded', handleBackToTopVisibility);
document.addEventListener('turbo:load', handleBackToTopVisibility);

// Use event delegation for the click to handle Turbo replacements smoothly
document.addEventListener('click', function(e) {
    const backToTop = e.target.closest('#back-to-top');
    if (backToTop) {
        e.preventDefault();
        e.stopPropagation(); // Stop the event from reaching jQuery handlers if any
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
});