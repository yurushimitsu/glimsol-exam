let sortDirection = 'asc';

function sortByName() {
    const container = document.getElementById('tasks');
    const cards = Array.from(container.children);

    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';

    const sorted = cards.sort((a, b) => {
        const nameA = a.getAttribute('title').toLowerCase();
        const nameB = b.getAttribute('title').toLowerCase();

        if (sortDirection === 'asc') {
            return nameA.localeCompare(nameB);
        } else {
            return nameB.localeCompare(nameA);
        }
    });

    const icon = document.getElementById('sort-icon');
    icon.style.transform = sortDirection === 'asc' ? 'rotate(0deg)' : 'rotate(180deg)';

    sorted.forEach(card => container.appendChild(card));
}