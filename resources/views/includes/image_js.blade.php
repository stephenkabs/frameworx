<script>
    document.getElementById('image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the preview image
            };

            reader.readAsDataURL(file); // Convert the image to base64 URL
        } else {
            preview.src = '#';
            preview.style.display = 'none'; // Hide the preview image
        }
    });
    </script>
