document.addEventListener('DOMContentLoaded', function() {
    updateVisibleItems();

    document.getElementById('scrollLeft').addEventListener('click', function() {
        document.querySelector('.scroll-content').scrollBy({
            left: -100
        });
    });

    document.getElementById('scrollRight').addEventListener('click', function() {
        document.querySelector('.scroll-content').scrollBy({
            left: 300
        });
    });
});

window.addEventListener('resize', function() {
    updateVisibleItems();
});

function updateVisibleItems() {
    const width = window.innerWidth;
    const items = document.querySelectorAll('.navbar-nav .nav-item');
    if (width <= 1200) {
        items.forEach((item, index) => {
            item.style.display = index < 1 ? 'block' : 'none';
        });
    } else {
        items.forEach(item => {
            item.style.display = 'block';
        });
    }
}
