document.addEventListener('DOMContentLoaded', function () {
    const gridContainer = document.querySelector('.offers_grid');

    // Fungsi untuk mengurutkan item berdasarkan kriteria
    function sortItems(sortBy, order) {
        const items = Array.from(gridContainer.querySelectorAll('.offers_item'));

        // Tambahkan animasi saat elemen berpindah posisi
        items.forEach(item => {
            item.classList.add('moving'); // Menambahkan kelas untuk animasi
        });

        setTimeout(() => {
            // Mengurutkan item berdasarkan sortBy dan order
            items.sort((a, b) => {
                let aValue, bValue;

                // Mengambil nilai berdasarkan sortBy (rating atau reviews)
                if (sortBy === 'stars') {
                    aValue = parseFloat(a.dataset.rating); // Ambil rating
                    bValue = parseFloat(b.dataset.rating); // Ambil rating
                } else if (sortBy === 'reviews') {
                    aValue = parseInt(a.dataset.reviews); // Ambil reviews
                    bValue = parseInt(b.dataset.reviews); // Ambil reviews
                }

                // Urutkan berdasarkan order (asc atau desc)
                if (order === 'asc') {
                    return aValue - bValue;
                } else {
                    return bValue - aValue;
                }
            });

            // Mengurutkan ulang elemen di DOM
            items.forEach(item => gridContainer.appendChild(item));

            // Hapus kelas moving setelah animasi selesai
            items.forEach(item => {
                item.classList.remove('moving');
            });
        }, 300); // Waktu tunggu sebelum mengubah posisi, sesuai durasi transisi
    }

    // Event listener untuk tombol sort
    const sortButtons = document.querySelectorAll('.sort_btn');
    sortButtons.forEach(button => {
        button.addEventListener('click', function () {
            const sortBy = button.getAttribute('data-sort-by'); // stars atau reviews
            const sortOrder = button.getAttribute('data-sort-order'); // asc atau desc
            sortItems(sortBy, sortOrder);
        });
    });
});
