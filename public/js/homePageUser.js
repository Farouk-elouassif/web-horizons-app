document.addEventListener('DOMContentLoaded', function() {
    const topicLinks = document.querySelectorAll('.topic-link');
    const articles = document.querySelectorAll('.article');

    topicLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            // Remove active class from all links
            topicLinks.forEach(link => link.classList.remove('active'));
            // Add active class to the clicked link
            this.classList.add('active');

            const selectedTopic = this.getAttribute('data-topic');

            articles.forEach(article => {
                const articleTopic = article.getAttribute('data-topic');

                if (selectedTopic === 'all' || articleTopic === selectedTopic) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        });
    });
});




