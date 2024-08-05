function hitungTotalPembayaran() {
  var hargaTiket = parseFloat(document.getElementById("hargaTiket").value);
  var hari = parseInt(document.getElementById("hari").value);
  var peserta = parseInt(document.getElementById("peserta").value);
  var pelayanan = document.getElementById("pelayanan").value;

  let totalPembayaran = hargaTiket * hari * peserta;

  if (pelayanan === "VIP") {
    totalPembayaran *= 1.5; // Tambahkan 50% untuk pelayanan VIP
  }

  document.getElementById("totalPembayaran").innerText =
    "Total Pembayaran: Rp " +
    totalPembayaran.toLocaleString("id-ID", {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });
}

function applyDiscount() {
  var hargaTiketElem = document.getElementById("hargaTiket");
  var discount = hargaTiketElem.getAttribute("data-discount");
  let hargaTiket = parseFloat(hargaTiketElem.value);

  if (discount === "true") {
    hargaTiket *= 0.8;
  }

  hargaTiketElem.value = hargaTiket;
  hitungTotalPembayaran();
}
