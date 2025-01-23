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
