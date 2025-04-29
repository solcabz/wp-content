document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('menu').classList.toggle('active');
});

function showTabContent(tab) {
    const tabs = document.querySelectorAll('.tab-title');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(t => t.classList.remove('active'));
    tab.classList.add('active');

    contents.forEach(c => c.classList.remove('active'));

    const index = Array.from(tabs).indexOf(tab);
    if (contents[index]) {
        contents[index].classList.add('active');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Make the correct tab active based on URL
    const urlParams = new URLSearchParams(window.location.search);
    const activeTabIndex = parseInt(urlParams.get('tab')) || 0;
    const tabs = document.querySelectorAll('.tab-title');
    const contents = document.querySelectorAll('.tab-content');

    if (tabs[activeTabIndex]) {
        showTabContent(tabs[activeTabIndex]);
    }

    // Add click event to tabs
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            showTabContent(tab);

            // Optional: Update URL without reload to reflect active tab
            const index = Array.from(tabs).indexOf(tab);
            const params = new URLSearchParams(window.location.search);
            params.set('tab', index);
            params.set('page', 1); // Reset to page 1 on tab change
            window.history.replaceState({}, '', `${window.location.pathname}?${params.toString()}`);
        });
    });

    // Attach pagination click listeners to load the next set of awards via AJAX
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();  // Prevent default page reload

            const page = this.getAttribute('href').split('=')[1];  // Get the page number from the URL
            const tabIndex = urlParams.get('tab') || 0;  // Get the current tab

            // Send AJAX request to fetch new content (you'll need to write a backend handler for this)
            fetch(`${window.location.pathname}?tab=${tabIndex}&page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'text/html',
                }
            })
            .then(response => response.text())
            .then(data => {
                const tabContent = document.querySelector(`.tab-content.active`);
                const newContent = new DOMParser().parseFromString(data, 'text/html').querySelector('.tab-content.active');
                tabContent.innerHTML = newContent.innerHTML; // Replace the content dynamically
                window.scrollTo({ top: 0, behavior: 'smooth' });
            })
            .catch(error => console.error('Error loading page:', error));
        });
    });
});
