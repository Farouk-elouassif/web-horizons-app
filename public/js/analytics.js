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



