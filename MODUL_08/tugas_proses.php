<?php
$dataFile = 'tugas.csv';

//fungsi untuk membaca data dari file teks
function readData($file) {
    if (!file_exists($file)) return [];
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return array_map(function($line) {
        return explode('|', $line);
    }, $lines);
}

//fungsi untuk menulis data ke file teks
function writeData($file, $data) {
    $lines = array_map(function($entry) {
        return implode('|', $entry);
    }, $data);
    file_put_contents($file, implode(PHP_EOL, $lines) . PHP_EOL);
}

// menangani permintaan GET untuk membaca data
if (isset($_GET['action']) && $_GET['action'] === 'read') {
    $query = $_GET['query'] ?? '';
    $data = readData($dataFile);

    // filter data berdasarkan nama
    $filteredData = array_filter($data, function($entry) use ($query) {
        return stripos($entry[0], $query) !== false; // Nama ada di indeks ke-0
    });

    // menampilkan data yang difilter
    foreach ($filteredData as $entry) {
        echo "<tr>
                <td>{$entry[0]}</td>
                <td>{$entry[1]}</td>
                <td>{$entry[2]}</td>
            </tr>";
    }
    exit;
}

// menangani permintaan POST untuk menambahkan data
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $data = readData($dataFile);

    $newAlumni = [
        $_POST['Nama'],          
        $_POST['TahunLulus'], 
        $_POST['Pekerjaan']           
    ];

    $data[] = $newAlumni;
    writeData($dataFile, $data);
    echo "Alumni berhasil ditambahkan!";
    exit;
}
?>