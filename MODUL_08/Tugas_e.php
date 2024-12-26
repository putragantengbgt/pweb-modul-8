<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Alumni</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Tracer Alumni</h2>
        <form id="alumniForm" class="mb-4">
            <div class="mb-3">
                <label for="Nama" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="Nama" name="Nama" required>
            </div>
            <div class="mb-3">
                <label for="TahunLulus" class="form-label">Tahun Lulus:</label>
                <input type="number" class="form-control" id="TahunLulus" name="TahunLulus" required>
            </div>
            <div class="mb-3">
                <label for="Pekerjaan" class="form-label">Pekerjaan:</label>
                <input type="text" class="form-control" id="Pekerjaan" name="Pekerjaan" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Alumni</button>
        </form>

        <h4>Daftar Alumni</h4>
        <input type="text" id="search" class="form-control mb-3" placeholder="Cari Nama Alumni...">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tahun Lulus</th>
                    <th>Pekerjaan</th>
                </tr>
            </thead>
            <tbody id="alumniList"></tbody>
        </table>
    </div>

    <script>
    $(document).ready(function() {
        function loadAlumni(query = "") {
            $.ajax({
                url: 'tugas_proses.php',
                type: 'GET',
                data: {
                    action: 'read',
                    query: query
                },
                success: function(response) {
                    $('#alumniList').html(response);
                }
            });
        }

        $('#alumniForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize() + '&action=add';
            $.post('tugas_proses.php', formData, function(response) {
                alert(response);
                $('#alumniForm')[0].reset();
                loadAlumni();
            });
        });

        $('#search').on('input', function() {
            const query = $(this).val();
            loadAlumni(query);
        });

        loadAlumni();
    });
    </script>
</body>

</html>