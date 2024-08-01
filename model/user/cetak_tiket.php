<?php
require('../../controller/fpdf/fpdf.php');
include '../../controller/koneksi.php';
session_start();

class PDF extends FPDF {
    function Header() {
        // Title PDF
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'SATORU DESTINATION', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        // Page footer
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function TicketDetails($data) {
        $this->SetFont('Arial', '', 12);
        
        // Lebar kolom kunci dan nilai
        $keyWidth = 50;
        $valueWidth = 140;
    
        foreach ($data as $key => $value) {
            // Mencetak nama atribut dan titik dua di kolom yang lebih kecil
            $this->Cell($keyWidth, 10, $key, 0, 0, 'L'); // Rata kiri untuk nama atribut
            $this->Cell(10, 10, ':', 0, 0, 'C'); // Rata tengah untuk titik dua
            
            // Menangani deskripsi wisata yang mungkin panjang menggunakan MultiCell
            if ($key === 'Deskripsi Wisata') {
                $this->MultiCell($valueWidth, 10, $value, 0, 'L'); // Rata kiri untuk nilai
            } else {
                // Menambahkan nilai atribut dalam satu baris
                $this->Cell($valueWidth, 10, $value, 0, 1, 'L'); // Rata kiri untuk nilai
            }
        }
    }
    
    
    
    // mencetak penjelasan tiket, termasuk informasi resmi dan tanda tangan, pada dokumen PDF dengan format yang telah ditentukan.
    function TicketExplanation() {
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Penjelasan Tiket:', 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, "Tiket ini merupakan bukti pemesanan resmi dari Satoru Destination. Harap membawa tiket ini saat mengunjungi lokasi wisata. Terima kasih telah mempercayai layanan kami.");

        $this->Ln(20);
        $this->Cell(0, 10, 'Sign:', 0, 1, 'R');
        $this->Ln(20);
        $this->Cell(0, 10, 'Satoru Destination', 0, 1, 'R');
    }
}

// Query untuk mengambil data tiket wisata
if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    // Fetch data tiket wisata
    $sql = "SELECT tbl_wisata.nama, tbl_wisata.deskripsi, tiket_wisata.total_pembayaran, tiket_wisata.peserta, tiket_wisata.hari
            FROM tbl_wisata
            JOIN tiket_wisata ON tiket_wisata.id_wisata = tbl_wisata.id
            WHERE tiket_wisata.id_transaksi = $id_transaksi and tiket_wisata.id_users = " . $_SESSION['user_id'];
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->TicketDetails([
        'Nama Wisata' => $data['nama'],
        'Deskripsi Wisata' => $data['deskripsi'],
        'Total Peserta' => $data['peserta'].' Orang',
        'Waktu Berwisata' => $data['hari']. ' Hari',
        'Total Biaya' => 'Rp.'.$data['total_pembayaran']
    ]);
    $pdf->TicketExplanation();
    $pdf->Output();
} else {
    echo "ID Transaksi tidak ditemukan.";
}
?>
