document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('menu').classList.toggle('active');
});

function showTabContent(tab) {
    const tabs = document.querySelectorAll('.tab-title');
    const contents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(t => t.classList.remove('active'));
    contents.forEach(c => c.style.display = 'none');
    
    tab.classList.add('active');
    const index = Array.from(tabs).indexOf(tab);
    contents[index].style.display = 'block';
}

// Show the first tab by default
document.addEventListener('DOMContentLoaded', () => {
    const firstTab = document.querySelector('.tab-title');
    if (firstTab) {
        showTabContent(firstTab);
    }
});