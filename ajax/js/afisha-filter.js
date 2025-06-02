document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.afisha-filter');
    const sortSelect = document.querySelector('#sort');
    const loadMoreBtn = document.querySelector('.afisha__load-more');
    const movieList = document.querySelector('#movie-list');

    let currentPage = 1;

    function getFilters() {
        const genre = document.querySelector('#genre').value;
        const dateFrom = document.querySelector('[name="date-from"]').value;
        const dateTo = document.querySelector('[name="date-to"]').value;
        const sort = document.querySelector('#sort').value;

        return {
            genre,
            date_from: dateFrom,
            date_to: dateTo,
            sort,
        };
    }

    async function fetchMovies(reset = false) {
        const filters = getFilters();
        const params = new URLSearchParams({
            ...filters,
            action: 'get_filtered_movies',
            page: currentPage
        });

        const response = await fetch(`${afisha_ajax.url}?${params.toString()}`);
        const data = await response.json();

        if (reset) {
            movieList.innerHTML = data.html;
        } else {
            movieList.insertAdjacentHTML('beforeend', data.html);
        }

        if (!data.has_more) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'block';
        }
    }

    form.querySelector('button[type="submit"]').addEventListener('click', (e) => {
        e.preventDefault();
        currentPage = 1;
        fetchMovies(true);
    });

    sortSelect.addEventListener('change', () => {
        currentPage = 1;
        fetchMovies(true);
    });

    loadMoreBtn.addEventListener('click', () => {
        currentPage++;
        fetchMovies();
    });
});
