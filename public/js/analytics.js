function addTopic() {
    const input = document.getElementById('topicInput');
    const topicName = input.value.trim();

    if (topicName) {
        const topicsList = document.getElementById('topicsList');
        const topicItem = document.createElement('div');
        topicItem.className = 'topic-item';
        topicItem.innerHTML = `
            <span class="topic-name">${topicName}</span>
            <button class="btn-delete" onclick="deleteTopic(this)">
                <i class="fas fa-times"></i>
            </button>
        `;
        topicsList.appendChild(topicItem);
        input.value = '';
        updateTopicCount();
    }
}

function filterArticles() {
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#articlesTableBody tr');

    rows.forEach(row => {
        const statusCell = row.querySelector('td:nth-child(3) .status').textContent.toLowerCase();
        const titleCell = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        const authorCell = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

        const matchesStatus = statusFilter === 'all' || statusCell.includes(statusFilter);
        const matchesSearch = titleCell.includes(searchInput) || authorCell.includes(searchInput);


        if (matchesStatus && matchesSearch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

