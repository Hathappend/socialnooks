if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        (position) => {
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;
            // Isi nilai latitude dan longitude ke input hidden
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;


        },
        (error) => {
            console.error('Gagal mendapatkan lokasi:', error);
            alert('Aktifkan lokasi Anda untuk menggunakan fitur ini.');
        }
    );
} else {
    alert('Browser Anda tidak mendukung Geolocation.');
}
