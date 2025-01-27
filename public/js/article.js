document.addEventListener('DOMContentLoaded', function() {
    const ratings = document.querySelectorAll('.rating');

    ratings.forEach(rating => {
        const stars = rating.querySelectorAll('.star');
        const ratingValue = rating.querySelector('.rating-value');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');

                // Update the stars' appearance
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });

                // Update the rating value display
                ratingValue.textContent = `(${value})`;

                // Here, you can send the rating value to your backend using AJAX
                // Example: sendRating(articleId, value);
            });
        });
    });
});


function sendRating(articleId, rating) {
    fetch('/rate-article', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for Laravel
        },
        body: JSON.stringify({ articleId, rating })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Rating saved:', data);
    })
    .catch(error => {
        console.error('Error saving rating:', error);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const ratings = document.querySelectorAll('.rating');

    ratings.forEach(rating => {
        const form = rating.querySelector('.rating-form');
        const stars = rating.querySelectorAll('.star');
        const ratingInput = rating.querySelector('.rating-input');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingInput.value = value; // Set the selected rating
                form.submit(); // Submit the form
            });
        });
    });
});

// document.addEventListener('DOMContentLoaded', function () {
//     const conversationForm = document.getElementById('conversation-form');
//     const conversationText = document.getElementById('conversation-text');
//     const conversationList = document.getElementById('conversation-list');

//     // Function to create a new comment
//     function createComment(author, content, date) {
//         const commentElement = document.createElement('div');
//         commentElement.classList.add('comment');

//         const commentAuthor = document.createElement('div');
//         commentAuthor.classList.add('comment-author');
//         commentAuthor.textContent = author;

//         const commentDate = document.createElement('div');
//         commentDate.classList.add('comment-date');
//         commentDate.textContent = date;

//         const commentContent = document.createElement('div');
//         commentContent.classList.add('comment-content');
//         commentContent.textContent = content;

//         commentElement.appendChild(commentAuthor);
//         commentElement.appendChild(commentDate);
//         commentElement.appendChild(commentContent);

//         return commentElement;
//     }

//     // Function to create a reply form
//     function createReplyForm() {
//         const replyForm = document.createElement('form');
//         replyForm.classList.add('reply-form');

//         const replyTextarea = document.createElement('textarea');
//         replyTextarea.setAttribute('placeholder', 'Write a reply...');

//         const replyButton = document.createElement('button');
//         replyButton.setAttribute('type', 'submit');
//         replyButton.textContent = 'Reply';

//         replyForm.appendChild(replyTextarea);
//         replyForm.appendChild(replyButton);

//         return replyForm;
//     }

//     // Handle conversation form submission
//     conversationForm.addEventListener('submit', function (e) {
//         e.preventDefault();

//         const content = conversationText.value.trim();

//         if (content) {
//             const thread = document.createElement('div');
//             thread.classList.add('conversation-thread');

//             const comment = createComment('Anonymous', content, new Date().toLocaleDateString());
//             thread.appendChild(comment);

//             const replyForm = createReplyForm();
//             thread.appendChild(replyForm);

//             conversationList.appendChild(thread);

//             conversationText.value = ''; // Clear the textarea
//         }
//     });

//     // Handle reply form submission
//     conversationList.addEventListener('submit', function (e) {
//         if (e.target.classList.contains('reply-form')) {
//             e.preventDefault();

//             const replyTextarea = e.target.querySelector('textarea');
//             const content = replyTextarea.value.trim();

//             if (content) {
//                 const repliesContainer = document.createElement('div');
//                 repliesContainer.classList.add('replies');

//                 const reply = createComment('Anonymous', content, new Date().toLocaleDateString());
//                 repliesContainer.appendChild(reply);

//                 e.target.parentElement.appendChild(repliesContainer);
//                 replyTextarea.value = ''; // Clear the textarea
//             }
//         }
//     });
// });
