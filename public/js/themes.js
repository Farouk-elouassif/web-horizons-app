document.addEventListener('DOMContentLoaded', function () {
    const themeCards = document.querySelectorAll('.theme-card');
    const submitButton = document.getElementById('submit-themes');
    const selectedThemesInput = document.getElementById('selected-themes');
    let selectedThemeIds = [];

    themeCards.forEach(card => {
        card.addEventListener('click', function () {
            const themeId = card.getAttribute('data-theme-id');
            if (selectedThemeIds.includes(themeId)) {
                // Deselect the theme
                selectedThemeIds = selectedThemeIds.filter(id => id !== themeId);
                card.classList.remove('selected');
            } else {
                // Select the theme
                selectedThemeIds.push(themeId);
                card.classList.add('selected');
            }

            // Update the hidden input with the selected theme IDs
            selectedThemesInput.value = selectedThemeIds.join(',');
        });
    });

    submitButton.addEventListener('click', function (event) {
        if (selectedThemeIds.length === 0) {
            event.preventDefault(); // Prevent form submission
            alert('Please select at least one theme.');
        }
    });
});
