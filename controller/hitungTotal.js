function hitungTotalPembayaran() {
  var hargaTiketElem = document.getElementById("hargaTiket");
  if (!hargaTiketElem) {
      console.error("Element with ID 'hargaTiket' not found.");
      return;
  }
  var hargaTiket = parseFloat(hargaTiketElem.value);

  var hariElem = document.getElementById("hari");
  if (!hariElem) {
      console.error("Element with ID 'hari' not found.");
      return;
  }
  var hari = parseInt(hariElem.value) || 0;

  var pesertaElem = document.getElementById("peserta");
  if (!pesertaElem) {
      console.error("Element with ID 'peserta' not found.");
      return;
  }
  var peserta = parseInt(pesertaElem.value) || 0;

  let totalPembayaran = hargaTiket * hari * peserta;

  var penginapan = document.getElementById("penginapan").checked ? parseFloat(document.getElementById("penginapan").value) : 0;
  var penerbangan = document.getElementById("penerbangan").checked ? parseFloat(document.getElementById("penerbangan").value) : 0;
  var makanMinum = document.getElementById("makan_minum").checked ? parseFloat(document.getElementById("makan_minum").value) : 0;

  totalPembayaran += (penginapan + penerbangan + makanMinum) * hari * peserta;

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
