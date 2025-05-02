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

            // Update URL without reload to reflect active tab
            const index = Array.from(tabs).indexOf(tab);
            const params = new URLSearchParams(window.location.search);
            params.set('tab', index);
            params.set('page', 1); // Reset to page 1 on tab change
            window.history.replaceState({}, '', `${window.location.pathname}?${params.toString()}`);
        });
    });

    // Attach pagination click listeners
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default page reload

            const page = new URL(this.href).searchParams.get('page'); // Get the page number from the URL
            const tabIndex = urlParams.get('tab') || 0; // Get the current tab

            // Send AJAX request to fetch new content
            fetch(`${window.location.pathname}?tab=${tabIndex}&page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'text/html',
                }
            })
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const newDocument = parser.parseFromString(data, 'text/html');
                const newContent = newDocument.querySelector(`.tab-content.active`);
                const currentContent = document.querySelector(`.tab-content.active`);

                if (newContent && currentContent) {
                    currentContent.innerHTML = newContent.innerHTML; // Replace the content dynamically
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            })
            .catch(error => console.error('Error loading page:', error));
        });
    });
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