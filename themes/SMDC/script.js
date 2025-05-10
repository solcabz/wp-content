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

    // Hide the current page and show the new page
    awardContainers[currentPageIndex].style.display = 'none';
    awardContainers[newPageIndex].style.display = 'grid';

    // Enable/disable pagination buttons
    const prevButton = tabContent.querySelector('.prev-page');
    const nextButton = tabContent.querySelector('.next-page');
    prevButton.disabled = newPageIndex === 0;
    nextButton.disabled = newPageIndex === awardContainers.length - 1;
}