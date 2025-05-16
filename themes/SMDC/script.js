document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('menu').classList.toggle('active');
});

document.getElementById('customSearchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const input = document.getElementById('customSearchInput').value.trim();

    if (input) {
        // Create a URL-friendly slug
        const slug = input.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');

        // Redirect to the expected slug-based URL (adjust based on your permalink structure)
        window.location.href = `/${slug}`;
    }
});

function showTabContent(tab, index) {
    const tabs = document.querySelectorAll('.tab-title');
    const contents = document.querySelectorAll('.tab-content');
    tabs.forEach(t => t.classList.remove('active'));
    contents.forEach(c => c.classList.remove('active'));

    tab.classList.add('active');
    contents[index].classList.add('active');
}

function changePage(button, direction) {
    const tabContent = button.closest('.tab-content');
    const awardContainers = tabContent.querySelectorAll('.award-container');
    const currentPageIndex = Array.from(awardContainers).findIndex(container => container.style.display !== 'none');

    let newPageIndex = currentPageIndex + direction;

    // Ensure the new page index is within bounds
    if (newPageIndex < 0 || newPageIndex >= awardContainers.length) {
        return;
    }

    // Add fade-out animation to the current page
    const currentContainer = awardContainers[currentPageIndex];
    currentContainer.classList.add('fade-out');

    // Wait for the fade-out animation to complete before switching pages
    currentContainer.addEventListener('animationend', function handleFadeOut() {
        currentContainer.style.display = 'none';
        currentContainer.classList.remove('fade-out');
        currentContainer.removeEventListener('animationend', handleFadeOut);

        // Show the new page with a fade-in animation
        const newContainer = awardContainers[newPageIndex];
        newContainer.style.display = 'grid';
        newContainer.classList.add('fade-in');

        // Remove the fade-in class after the animation completes
        newContainer.addEventListener('animationend', function handleFadeIn() {
            newContainer.classList.remove('fade-in');
            newContainer.removeEventListener('animationend', handleFadeIn);
        });
    });

    // Enable/disable pagination buttons
    const prevButton = tabContent.querySelector('.prev-page');
    const nextButton = tabContent.querySelector('.next-page');
    prevButton.disabled = newPageIndex === 0;
    nextButton.disabled = newPageIndex === awardContainers.length - 1;
}

document.addEventListener('DOMContentLoaded', () => {
    const animatedItems = document.querySelectorAll('.animate-on-scroll-left, .animate-on-scroll-right, .animate-on-scroll-up, .animate-on-scroll-down');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate'); // Add animation class
                observer.unobserve(entry.target); // Stop observing once animated
            }
        });
    }, {
        threshold: 0.2 // Trigger when 20% of the element is visible
    });

    animatedItems.forEach(item => observer.observe(item));
});

document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.news-carousel-track');
    const prevBtn = document.querySelector('.carousel-nav.prev');
    const nextBtn = document.querySelector('.carousel-nav.next');
    const cards = document.querySelectorAll('.news-card');
    const cardWidth = cards[0].offsetWidth + 55; // width + gap
    let currentIndex = 0;
    const maxIndex = cards.length - 3; // 3 visible at a time

    function updateCarousel() {
        track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    nextBtn.addEventListener('click', () => {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateCarousel();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });
});
