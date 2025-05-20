<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merge PDFs</title>
</head>
<body>
    <h2>Merge PDFs</h2>
    <form action="{{ route('merge.pdfs') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Select First PDF:</label>
        <input type="file" name="pdf1" required>
        <br>
        <label>Select Second PDF:</label>
        <input type="file" name="pdf2" required>
        <br>
        <button type="submit">Merge PDFs</button>
    </form>
</body>
</html>
