<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="{{ asset("style/style.css") }}">
    <link rel="stylesheet" href="{{ asset("style/form.css") }}">
    <link rel="stylesheet" href="{{ asset("style/print.css") }}">
    <link rel="stylesheet" href="{{ asset("style/table.css") }}">
    <link rel="stylesheet" href="{{ asset("style/profile.css") }}">
    <link rel="stylesheet" href="{{ asset("style/fontawesome-free-6.4.0-web/css/all.css") }}">

    <script>
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];

        if (!file) {
            preview.removeAttribute('src');
            preview.style.display = 'none';
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Please select an image file.');
            this.value = '';
            preview.style.display = 'none';
            return;
        }

        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    });
    </script>
</head>