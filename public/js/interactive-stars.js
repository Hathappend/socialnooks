document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("rating");

    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener("click", () => {
            if (selectedRating === star.dataset.value) {
                selectedRating = 0;
            } else {
                selectedRating = star.dataset.value;
            }
            updateStars(selectedRating);
            ratingInput.value = selectedRating;
        });

        star.addEventListener("mouseover", () => {
            updateStars(star.dataset.value);
        });

        star.addEventListener("mouseout", () => {
            updateStars(selectedRating);
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            star.classList.toggle("filled", star.dataset.value <= rating);
        });
    }
});
