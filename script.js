// 1. UBAH FOTO BERANDA DAN INFORMASI LOKASI DI SINI
const pengaturan = {
  fotoHero: "images/Tampilan Awal.png",
  fotoKedai: "images/View Luar.png",
  alamat: "Jl. Mesjid Raya Syekh Yusuf",
  jamBuka: "07:00–23:59",
  linkMaps: "https://maps.app.goo.gl/2pUgfX8778wCb4pq8",
};

// 2. DATA MENU (Dengan folder images/ dan nama file sesuai foldermu)
const dataMenu = [
  // --- COFFEE ---
  { id: 1, nama: "Rappokopi Aren", kategori: "Kopi", harga: 13000, foto: "images/Rappokopi Aren.png", deskripsi: "Kopi susu dengan gula aren khas Rappokopi." },
  { id: 2, nama: "Butterscotch Aren", kategori: "Kopi", harga: 18000, foto: "images/Butterscotch Aren.png", deskripsi: "Paduan kopi aren dengan manisnya butterscotch." },
  { id: 3, nama: "Pandan Aren", kategori: "Kopi", harga: 18000, foto: "images/Pandan Aren.png", deskripsi: "Kopi aren dengan aroma pandan yang wangi." },
  { id: 4, nama: "Hazelnut Aren", kategori: "Kopi", harga: 18000, foto: "images/Hazelnut Aren.png", deskripsi: "Kopi susu aren dengan rasa hazelnut." },
  { id: 5, nama: "Caramel Aren", kategori: "Kopi", harga: 18000, foto: "images/Caramel Aren.png", deskripsi: "Kopi susu aren dengan sirup karamel." },
  { id: 6, nama: "Ice Kopi Susu", kategori: "Kopi", harga: 20000, foto: "images/Ice Kopi Susu.png", deskripsi: "Es kopi susu segar untuk menemani harimu." },
  { id: 7, nama: "Ice Kopi Pandan", kategori: "Kopi", harga: 20000, foto: "images/Ice Kopi Pandan.png", deskripsi: "Es kopi susu dengan kesegaran pandan." },
  { id: 8, nama: "Hot Kopi Susu", kategori: "Kopi", harga: 16000, foto: "images/Hot Kopi Susu.png", deskripsi: "Kopi susu panas yang menenangkan." },

  // --- NON COFFEE ---
  { id: 9, nama: "Pink Boy", kategori: "Nonkopi", harga: 18000, foto: "images/Pink Boy.png", deskripsi: "Minuman segar non-kopi andalan kami." },
  { id: 10, nama: "Yoghurt Mango", kategori: "Nonkopi", harga: 18000, foto: "images/Yoghurt Mango.png", deskripsi: "Kesegaran yoghurt berpadu dengan rasa mangga." },
  { id: 11, nama: "Yoghurt Lecy", kategori: "Nonkopi", harga: 18000, foto: "images/Yoghurt Lecy.png", deskripsi: "Yoghurt manis asam dengan kesegaran leci." },
  { id: 12, nama: "Ice Chocolate", kategori: "Nonkopi", harga: 18000, foto: "images/Ice Chocolate.png", deskripsi: "Minuman cokelat dingin yang manis dan pekat." },
  { id: 13, nama: "Ice Greentea", kategori: "Nonkopi", harga: 18000, foto: "images/Ice Greentea.png", deskripsi: "Es teh hijau manis yang menyegarkan." },
  { id: 14, nama: "Ice Thaitea", kategori: "Nonkopi", harga: 18000, foto: "images/Ice Thaitea.png", deskripsi: "Es teh khas Thailand dengan perpaduan susu pekat." },
  { id: 15, nama: "Ice Lemon Tea", kategori: "Nonkopi", harga: 15000, foto: "images/Ice Lemon Tea.png", deskripsi: "Es teh dengan perasan lemon murni yang segar." },
  { id: 16, nama: "Hot Chocolate", kategori: "Nonkopi", harga: 16000, foto: "images/Hot Chocolate.png", deskripsi: "Cokelat panas yang lembut dan menghangatkan." },
  { id: 17, nama: "Hot Lemon Tea", kategori: "Nonkopi", harga: 16000, foto: "images/Hot Lemon Tea.png", deskripsi: "Teh lemon hangat yang melegakan." },

  // --- CREAMY SERIES ---
  { id: 18, nama: "Creamy Aren", kategori: "Kopi", harga: 18000, foto: "images/Creamy Aren.png", deskripsi: "Kopi susu ekstra creamy dengan sentuhan aren." },
  { id: 19, nama: "Coffee Creamy", kategori: "Kopi", harga: 20000, foto: "images/Coffee Creamy.png", deskripsi: "Kopi dengan tekstur ekstra creamy yang lembut." },
  { id: 20, nama: "Butterscotch Sea Salt", kategori: "Kopi", harga: 22000, foto: "images/Butterscotch Sea Salt.png", deskripsi: "Paduan manis butterscotch dan gurihnya sea salt." },
  { id: 21, nama: "Coffee Creamy Pistachio", kategori: "Kopi", harga: 20000, foto: "images/Coffee Creamy Pistachio.png", deskripsi: "Kopi creamy dengan cita rasa kacang pistachio." },
  { id: 22, nama: "Coffee Creamy Hazelnut", kategori: "Kopi", harga: 20000, foto: "images/Coffee Creamy Hazelnut.png", deskripsi: "Kopi creamy dengan paduan sirup hazelnut." },
  { id: 23, nama: "Coffee Creamy Caramel", kategori: "Kopi", harga: 20000, foto: "images/Coffee Creamy Caramel.png", deskripsi: "Kopi creamy dengan manisnya karamel." },

  // --- AMERICANO SERIES ---
  { id: 24, nama: "Americano Signature", kategori: "Kopi", harga: 18000, foto: "images/Americano Signature.png", deskripsi: "Kopi hitam khas Rappokopi yang berkarakter." },
  { id: 25, nama: "Berry Cano", kategori: "Kopi", harga: 25000, foto: "images/Berry Cano.png", deskripsi: "Kopi hitam segar dengan sentuhan rasa buah beri." },
  { id: 26, nama: "Black Peach", kategori: "Kopi", harga: 25000, foto: "images/Black Peach.png", deskripsi: "Kopi hitam dengan paduan rasa peach yang unik." },
  { id: 27, nama: "Black Sunrise", kategori: "Kopi", harga: 25000, foto: "images/Black Sunrise.png", deskripsi: "Kopi hitam segar untuk mengawali harimu." },
  { id: 28, nama: "Hot Americano", kategori: "Kopi", harga: 16000, foto: "images/Hot Americano.png", deskripsi: "Kopi hitam panas yang klasik dan nikmat." },

  // --- MATCHA SERIES ---
  { id: 29, nama: "Matcha Latte", kategori: "Nonkopi", harga: 20000, foto: "images/Matcha Latte.png", deskripsi: "Rasa matcha pekat dengan susu yang lembut." },
  { id: 30, nama: "Strawberry Matcha", kategori: "Nonkopi", harga: 25000, foto: "images/Strawberry Matcha.png", deskripsi: "Perpaduan unik matcha dengan manisnya stroberi." },
  { id: 31, nama: "Butterscotch Matcha", kategori: "Nonkopi", harga: 25000, foto: "images/Butterscotch Matcha.png", deskripsi: "Matcha yang disajikan dengan butterscotch." },
];

// 3. DATA PROMO
const dataPromo = [
  { id: 1, nama: "Sebotol Gembira (1 Botol)", harga: 85000, foto: "images/Sebotol Gembira.png", deskripsi: "Satu botol ukuran literan untuk stok kesegaranmu di rumah.", ketentuan: "Berlaku periode 7–31 September 2026." },
  { id: 2, nama: "Sebotol Gembira (2 Botol)", harga: 150000, foto: "images/Sebotol Gembira2.png", deskripsi: "Dua botol ukuran literan, lebih hemat dan seru untuk dinikmati bersama.", ketentuan: "Berlaku periode 7–31 September 2026." },
  { id: 3, nama: "Stengah Liter / Semini", harga: 50000, foto: "images/Sebotol Gembira3.png", deskripsi: "Tersedia juga ukuran Stengah Liter (50K) dan Semini (25K) dengan harga normal.", ketentuan: "Harga normal di luar promo Sebotol Gembira." },
  { id: 4, nama: "Paket Cheerful 1", harga: 30000, foto: "images/Paket Cheerful 1.png", deskripsi: "Paket seru berisi 2 pilihan minuman nikmat untuk menemani harimu.", ketentuan: "Berlaku untuk varian tertentu." },
  { id: 5, nama: "Paket Cheerful 2", harga: 40000, foto: "images/Paket Cheerful 2.png", deskripsi: "Paket spesial berisi 2 varian minuman favorit pilihan.", ketentuan: "Berlaku untuk varian tertentu." },
  { id: 6, nama: "Paket Cheerful 3", harga: 30000, foto: "images/Paket Cheerful 3.png", deskripsi: "Nikmati kombinasi 2 gelas minuman lezat dengan harga lebih hemat.", ketentuan: "Berlaku untuk varian tertentu." }
];

// 4. FUNGSI PENDUKUNG
const rupiah = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", maximumFractionDigits: 0 });
const gambarPengganti = "data:image/svg+xml;charset=UTF-8," + encodeURIComponent(`<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600"><rect width="100%" height="100%" fill="#ffead8"/><circle cx="400" cy="240" r="90" fill="#f45116"/><text x="400" y="260" text-anchor="middle" font-family="Arial" font-size="45" fill="white">R</text><text x="400" y="390" text-anchor="middle" font-family="Arial" font-size="28" fill="#754329">Foto akan ditambahkan</text></svg>`);

function pasangFoto(elemen, sumber, alternatif) {
  elemen.alt = alternatif;
  elemen.onerror = function () { this.onerror = null; this.src = gambarPengganti; };
  elemen.src = sumber || gambarPengganti;
}

function buatKartu(item, tipe) {
  const kolom = $('<div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600"></div>');
  const kartu = $('<article class="menu-card"></article>');
  const foto = $('<img class="menu-image" loading="lazy">');
  pasangFoto(foto[0], item.foto, item.nama);
  const isi = $('<div class="p-4"></div>');
  const label = tipe === "menu" ? item.kategori : "Contoh paket";
  isi.append($('<p class="eyebrow mb-2"></p>').text(label));
  isi.append($('<h3 class="h4"></h3>').text(item.nama));
  isi.append($('<p class="menu-description"></p>').text(item.deskripsi));
  const bawah = $('<div class="d-flex justify-content-between align-items-center gap-2"></div>');
  bawah.append($('<span class="price"></span>').text(rupiah.format(item.harga)));
  const tombol = $('<button type="button" class="btn btn-outline-brand detail-btn"></button>').text(tipe === "menu" ? "Lihat Detail" : "Detail Promo").attr("data-id", item.id).attr("data-tipe", tipe);
  bawah.append(tombol);
  isi.append(bawah);
  kartu.append(foto, isi);
  kolom.append(kartu);
  return kolom;
}

// 5. INTERAKSI WEBSITE DENGAN jQuery
$(function () {
  AOS.init({ once: true, offset: 50 });

  let kategoriAktif = "Semua";
  const modal = new bootstrap.Modal(document.getElementById("detailModal"));
  pasangFoto($("#fotoHero")[0], pengaturan.fotoHero, "Minuman Rappokopi");
  pasangFoto($("#fotoKedai")[0], pengaturan.fotoKedai, "Kedai Rappokopi");
  $("#alamatKedai").text(pengaturan.alamat);
  $("#jamKedai").text(pengaturan.jamBuka);
  
  try {
    const urlMaps = new URL(pengaturan.linkMaps);
    if (["https:", "http:"].includes(urlMaps.protocol)) {
      $("#tombolMaps").attr("href", urlMaps.href).prop("hidden", false);
      $("#infoMaps").prop("hidden", true);
    }
  } catch { /* Tautan lokasi belum diisi. */ }

  function tampilkanHalaman() {
    const daftarHalaman = ["beranda", "menu", "promo", "lokasi"];
    const hash = window.location.hash.slice(1);
    const halaman = daftarHalaman.includes(hash) ? hash : "beranda";
    $(".page").prop("hidden", true);
    $("#" + halaman).prop("hidden", false);
    $(".nav-link").removeClass("active").removeAttr("aria-current");
    $('.nav-link[href="#' + halaman + '"]').addClass("active").attr("aria-current", "page");
    document.title = "Rappokopi | " + halaman.charAt(0).toUpperCase() + halaman.slice(1);
    const navigasi = document.getElementById("navigasi");
    if (navigasi.classList.contains("show")) bootstrap.Collapse.getOrCreateInstance(navigasi).hide();
    window.scrollTo(0, 0);
    setTimeout(() => { AOS.refresh(); }, 100);
  }

  $(window).on("hashchange", tampilkanHalaman);
  tampilkanHalaman();
  
  dataMenu.slice(0, 3).forEach((item) => $("#menuBeranda").append(buatKartu(item, "menu")));
  
  function tampilkanMenu() {
    const kataKunci = $("#cariMenu").val().trim().toLowerCase();
    const hasil = dataMenu.filter((item) => item.nama.toLowerCase().includes(kataKunci) && (kategoriAktif === "Semua" || item.kategori === kategoriAktif));
    $("#daftarMenu").empty();
    hasil.forEach((item) => $("#daftarMenu").append(buatKartu(item, "menu")));
    $("#jumlahMenu").text(hasil.length + " menu ditemukan");
    $("#menuKosong").prop("hidden", hasil.length > 0);
    setTimeout(() => { AOS.refresh(); }, 100);
  }

  $("#cariMenu").on("input", tampilkanMenu);
  
  $(".filter-btn").on("click", function () {
    kategoriAktif = $(this).attr("data-kategori");
    $(".filter-btn").removeClass("active").attr("aria-pressed", "false");
    $(this).addClass("active").attr("aria-pressed", "true");
    tampilkanMenu();
  });
  
  $("#resetFilter").on("click", () => {
    $("#cariMenu").val("");
    $('.filter-btn[data-kategori="Semua"]').trigger("click");
  });
  
  tampilkanMenu();
  dataPromo.forEach((item) => $("#daftarPromo").append(buatKartu(item, "promo")));
  
  $(document).on("click", ".detail-btn", function () {
    const id = Number($(this).attr("data-id"));
    const tipe = $(this).attr("data-tipe");
    const sumber = tipe === "menu" ? dataMenu : dataPromo;
    const item = sumber.find((produk) => produk.id === id);
    if (!item) return;
    $("#judulDetail").text(item.nama);
    $("#kategoriDetail").text(tipe === "menu" ? item.kategori : "Contoh promo");
    $("#deskripsiDetail").text(item.deskripsi);
    $("#hargaDetail").text(rupiah.format(item.harga));
    $("#catatanDetail").text(tipe === "menu" ? "Harga dapat berubah sewaktu-waktu tanpa pemberitahuan." : item.ketentuan);
    pasangFoto($("#fotoDetail")[0], item.foto, item.nama);
    modal.show();
  });
});