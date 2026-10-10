// =====================================================
// 1. PENGATURAN WEBSITE
// =====================================================

const pengaturan = {
  fotoHero: "images/Tampilan Awal.png",
  fotoKedai: "images/View Luar.png",
  alamat: "Jl. Mesjid Raya Syekh Yusuf",
  jamBuka: "07:00–23:59",
  linkMaps: "https://maps.app.goo.gl/2pUgfX8778wCb4pq8",
};


// =====================================================
// 2. DATA MENU DAN PROMO
// Data diambil dari database melalui API PHP
// =====================================================

let dataMenu = [];
let dataPromo = [];


// =====================================================
// 3. FUNGSI PENDUKUNG
// =====================================================

// Format harga menjadi Rupiah
const rupiah = new Intl.NumberFormat("id-ID", {
  style: "currency",
  currency: "IDR",
  maximumFractionDigits: 0
});


// Gambar pengganti jika foto tidak ditemukan
const gambarPengganti =
  "data:image/svg+xml;charset=UTF-8," +
  encodeURIComponent(`
    <svg xmlns="http://www.w3.org/2000/svg"
         width="800"
         height="600">

      <rect
        width="100%"
        height="100%"
        fill="#ffead8"/>

      <circle
        cx="400"
        cy="240"
        r="90"
        fill="#f45116"/>

      <text
        x="400"
        y="260"
        text-anchor="middle"
        font-family="Arial"
        font-size="45"
        fill="white">
        R
      </text>

      <text
        x="400"
        y="390"
        text-anchor="middle"
        font-family="Arial"
        font-size="28"
        fill="#754329">
        Foto akan ditambahkan
      </text>

    </svg>
  `);


// =====================================================
// 4. FUNGSI MEMASANG FOTO
// =====================================================

function pasangFoto(elemen, sumber, alternatif) {

  if (!elemen) return;

  elemen.alt = alternatif;

  elemen.onerror = function () {
    this.onerror = null;
    this.src = gambarPengganti;
  };

  elemen.src = sumber || gambarPengganti;
}


// =====================================================
// 5. FUNGSI MEMBUAT KARTU MENU / PROMO
// =====================================================

function buatKartu(item, tipe) {

  const kolom = $(
    '<div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600"></div>'
  );

  const kartu = $(
    '<article class="menu-card"></article>'
  );

  const foto = $(
    '<img class="menu-image" loading="lazy">'
  );

  pasangFoto(
    foto[0],
    item.foto,
    item.nama
  );


  const isi = $('<div class="p-4"></div>');


  // Label kategori
  const label =
    tipe === "menu"
      ? item.kategori
      : "Contoh paket";


  isi.append(
    $('<p class="eyebrow mb-2"></p>')
      .text(label)
  );


  // Nama menu / promo
  isi.append(
    $('<h3 class="h4"></h3>')
      .text(item.nama)
  );


  // Deskripsi
  isi.append(
    $('<p class="menu-description"></p>')
      .text(item.deskripsi)
  );


  // Bagian bawah kartu
  const bawah = $(
    '<div class="d-flex justify-content-between align-items-center gap-2"></div>'
  );


  // Harga
  bawah.append(
    $('<span class="price"></span>')
      .text(
        rupiah.format(
          Number(item.harga)
        )
      )
  );


  // Tombol detail
  const tombol = $(
    '<button type="button" class="btn btn-outline-brand detail-btn"></button>'
  )
    .text(
      tipe === "menu"
        ? "Lihat Detail"
        : "Detail Promo"
    )
    .attr(
      "data-id",
      item.id
    )
    .attr(
      "data-tipe",
      tipe
    );


  bawah.append(tombol);

  isi.append(bawah);

  kartu.append(
    foto,
    isi
  );

  kolom.append(kartu);

  return kolom;
}


// =====================================================
// 6. NORMALISASI DATA MENU
// Mengubah id dan harga dari string menjadi number
// =====================================================

function normalisasiMenu(data) {

  return data.map(function (item) {

    return {
      ...item,

      id: Number(item.id),

      harga: Number(item.harga)
    };

  });

}


// =====================================================
// 7. NORMALISASI DATA PROMO
// =====================================================

function normalisasiPromo(data) {

  return data.map(function (item) {

    return {
      ...item,

      id: Number(item.id),

      harga: Number(item.harga)
    };

  });

}


// =====================================================
// 8. PROGRAM UTAMA
// =====================================================

$(function () {

  // ===================================================
  // AOS
  // ===================================================

  AOS.init({
    once: true,
    offset: 50
  });


  // Kategori aktif
  let kategoriAktif = "Semua";


  // Modal detail
  const modal =
    new bootstrap.Modal(
      document.getElementById("detailModal")
    );


  // ===================================================
  // FOTO BERANDA
  // ===================================================

  pasangFoto(
    $("#fotoHero")[0],
    pengaturan.fotoHero,
    "Minuman Rappokopi"
  );


  // ===================================================
  // FOTO KEDAI
  // ===================================================

  pasangFoto(
    $("#fotoKedai")[0],
    pengaturan.fotoKedai,
    "Kedai Rappokopi"
  );


  // ===================================================
  // INFORMASI LOKASI
  // ===================================================

  $("#alamatKedai")
    .text(pengaturan.alamat);


  $("#jamKedai")
    .text(pengaturan.jamBuka);


  // ===================================================
  // GOOGLE MAPS
  // ===================================================

  try {

    const urlMaps =
      new URL(
        pengaturan.linkMaps
      );


    if (
      ["https:", "http:"]
        .includes(
          urlMaps.protocol
        )
    ) {

      $("#tombolMaps")
        .attr(
          "href",
          urlMaps.href
        )
        .prop(
          "hidden",
          false
        );


      $("#infoMaps")
        .prop(
          "hidden",
          true
        );

    }

  } catch {

    // Tautan lokasi belum diisi

  }


  // ===================================================
  // 9. FUNGSI NAVIGASI HALAMAN
  // ===================================================

  function tampilkanHalaman() {

    const daftarHalaman = [
      "beranda",
      "menu",
      "promo",
      "lokasi"
    ];


    const hash =
      window.location.hash.slice(1);


    const halaman =
      daftarHalaman.includes(hash)
        ? hash
        : "beranda";


    // Sembunyikan semua halaman
    $(".page")
      .prop(
        "hidden",
        true
      );


    // Tampilkan halaman aktif
    $("#" + halaman)
      .prop(
        "hidden",
        false
      );


    // Atur menu navigasi aktif
    $(".nav-link")
      .removeClass("active")
      .removeAttr(
        "aria-current"
      );


    $(
      '.nav-link[href="#' +
      halaman +
      '"]'
    )
      .addClass("active")
      .attr(
        "aria-current",
        "page"
      );


    // Judul browser
    document.title =
      "Rappokopi | " +
      halaman
        .charAt(0)
        .toUpperCase() +
      halaman.slice(1);


    // Tutup menu navbar di HP
    const navigasi =
      document.getElementById(
        "navigasi"
      );


    if (
      navigasi &&
      navigasi.classList.contains(
        "show"
      )
    ) {

      bootstrap.Collapse
        .getOrCreateInstance(
          navigasi
        )
        .hide();

    }


    // Scroll ke atas
    window.scrollTo(
      0,
      0
    );


    // Refresh animasi AOS
    setTimeout(
      function () {

        AOS.refresh();

      },
      100
    );

  }


  // Jalankan ketika hash berubah
  $(window)
    .on(
      "hashchange",
      tampilkanHalaman
    );


  // Jalankan pertama kali
  tampilkanHalaman();


  // ===================================================
  // 10. FUNGSI MENAMPILKAN SEMUA MENU
  // ===================================================

  function tampilkanMenu() {

    const kataKunci =
      $("#cariMenu")
        .val()
        .trim()
        .toLowerCase();


    const hasil =
      dataMenu.filter(
        function (item) {

          const namaCocok =
            item.nama
              .toLowerCase()
              .includes(
                kataKunci
              );


          const kategoriCocok =
            kategoriAktif === "Semua" ||
            item.kategori ===
              kategoriAktif;


          return (
            namaCocok &&
            kategoriCocok
          );

        }
      );


    // Bersihkan daftar menu
    $("#daftarMenu")
      .empty();


    // Tampilkan hasil
    hasil.forEach(
      function (item) {

        $("#daftarMenu")
          .append(
            buatKartu(
              item,
              "menu"
            )
          );

      }
    );


    // Jumlah menu
    $("#jumlahMenu")
      .text(
        hasil.length +
        " menu ditemukan"
      );


    // Pesan jika menu tidak ditemukan
    $("#menuKosong")
      .prop(
        "hidden",
        hasil.length > 0
      );


    // Refresh AOS
    setTimeout(
      function () {

        AOS.refresh();

      },
      100
    );

  }


  // ===================================================
  // 11. AMBIL DATA MENU DARI MYSQL
  // ===================================================

  $.getJSON(
    "api/menu.php",
    function (data) {

      console.log(
        "Data menu berhasil diambil:",
        data
      );


      // Masukkan data ke variabel
      dataMenu =
        normalisasiMenu(data);


      // ================================================
      // Tampilkan 3 menu di BERANDA
      // ================================================

      $("#menuBeranda")
        .empty();


      dataMenu
        .slice(0, 3)
        .forEach(
          function (item) {

            $("#menuBeranda")
              .append(
                buatKartu(
                  item,
                  "menu"
                )
              );

          }
        );


      // ================================================
      // Tampilkan semua menu
      // ================================================

      tampilkanMenu();


      // Refresh AOS
      setTimeout(
        function () {

          AOS.refresh();

        },
        100
      );

    }
  )
  .fail(
    function (
      jqXHR,
      textStatus,
      errorThrown
    ) {

      console.error(
        "Gagal mengambil data menu."
      );

      console.error(
        "Status:",
        textStatus
      );

      console.error(
        "Error:",
        errorThrown
      );


      $("#jumlahMenu")
        .text(
          "Gagal mengambil data menu."
        );

    }
  );


  // ===================================================
  // 12. AMBIL DATA PROMO DARI MYSQL
  // ===================================================

  $.getJSON(
    "api/promo.php",
    function (data) {

      console.log(
        "Data promo berhasil diambil:",
        data
      );


      // Masukkan data promo
      dataPromo =
        normalisasiPromo(data);


      // Bersihkan daftar promo
      $("#daftarPromo")
        .empty();


      // Tampilkan promo
      dataPromo.forEach(
        function (item) {

          $("#daftarPromo")
            .append(
              buatKartu(
                item,
                "promo"
              )
            );

        }
      );


      // Refresh AOS
      setTimeout(
        function () {

          AOS.refresh();

        },
        100
      );

    }
  )
  .fail(
    function (
      jqXHR,
      textStatus,
      errorThrown
    ) {

      console.error(
        "Gagal mengambil data promo."
      );

      console.error(
        "Status:",
        textStatus
      );

      console.error(
        "Error:",
        errorThrown
      );

    }
  );


  // ===================================================
  // 13. PENCARIAN MENU
  // ===================================================

  $("#cariMenu")
    .on(
      "input",
      function () {

        tampilkanMenu();

      }
    );


  // ===================================================
  // 14. FILTER KATEGORI
  // ===================================================

  $(".filter-btn")
    .on(
      "click",
      function () {

        kategoriAktif =
          $(this)
            .attr(
              "data-kategori"
            );


        // Hapus active dari semua tombol
        $(".filter-btn")
          .removeClass("active")
          .attr(
            "aria-pressed",
            "false"
          );


        // Aktifkan tombol yang dipilih
        $(this)
          .addClass("active")
          .attr(
            "aria-pressed",
            "true"
          );


        // Tampilkan hasil filter
        tampilkanMenu();

      }
    );


  // ===================================================
  // 15. RESET FILTER
  // ===================================================

  $("#resetFilter")
    .on(
      "click",
      function () {

        $("#cariMenu")
          .val("");


        $(
          '.filter-btn[data-kategori="Semua"]'
        )
          .trigger(
            "click"
          );

      }
    );


  // ===================================================
  // 16. DETAIL MENU DAN PROMO
  // ===================================================

  $(document)
    .on(
      "click",
      ".detail-btn",
      function () {

        // Ambil ID
        const id =
          Number(
            $(this)
              .attr(
                "data-id"
              )
          );


        // Ambil tipe
        const tipe =
          $(this)
            .attr(
              "data-tipe"
            );


        // Tentukan sumber data
        const sumber =
          tipe === "menu"
            ? dataMenu
            : dataPromo;


        // Cari item
        const item =
          sumber.find(
            function (produk) {

              return (
                Number(
                  produk.id
                ) === id
              );

            }
          );


        // Jika tidak ditemukan
        if (!item) {

          console.error(
            "Data tidak ditemukan:",
            id,
            tipe
          );

          return;

        }


        // =================================================
        // Isi modal detail
        // =================================================

        $("#judulDetail")
          .text(
            item.nama
          );


        $("#kategoriDetail")
          .text(
            tipe === "menu"
              ? item.kategori
              : "Contoh promo"
          );


        $("#deskripsiDetail")
          .text(
            item.deskripsi
          );


        $("#hargaDetail")
          .text(
            rupiah.format(
              Number(
                item.harga
              )
            )
          );


        // Catatan
        $("#catatanDetail")
          .text(
            tipe === "menu"
              ? "Harga dapat berubah sewaktu-waktu tanpa pemberitahuan."
              : item.ketentuan
          );


        // Foto
        pasangFoto(
          $("#fotoDetail")[0],
          item.foto,
          item.nama
        );


        // Tampilkan modal
        modal.show();

      }
    );

});