<?php

// Fungsi untuk memformat tanggal menjadi format yang diinginkan
function formatTanggal($datetime)
{
    $date = explode(' ', $datetime)[0]; // Mengambil bagian tanggal saja dari datetime
    $bulan = array(
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    );
    $pecahkan = explode('-', $date);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

// Fungsi untuk memformat total pembayaran menjadi format yang diinginkan
function formatRupiah($angka)
{
    return 'Rp. ' . number_format($angka, 0, ',', '.');
}
