function navigatePage(direction) {
    let currentPage = parseInt(document.getElementById('pageNumber').innerText);
    if (direction === 'next') {
        currentPage += 1;
    } else if (direction === 'prev') {
        currentPage -= 1;
    }
    window.location.search = `?page=${currentPage}`;
}