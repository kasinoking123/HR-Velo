### **PRD: Sistem Manajemen Internal "IntraHub"**

**Versi:** 1.0

Template yang digunakan: https://github.com/k2so-dev/laravel-nuxt

---

### **1. Pendahuluan**

#### **1.1. Latar Belakang**
Saat ini, proses administrasi kepegawaian Velo seperti manajemen data, pencatatan kehadiran, pengajuan reimbursement, dan proses HR lainnya masih dilakukan secara manual atau terpisah-pisah menggunakan chat, spreadsheet, dan email. Hal ini menyebabkan inefisiensi, risiko kesalahan data (human error), kesulitan dalam pelacakan, dan menghabiskan waktu berharga yang seharusnya bisa dialokasikan untuk pekerjaan strategis.

#### **1.2. Tujuan Produk**
"IntraHub" adalah sebuah sistem manajemen internal terpusat yang bertujuan untuk:
1.  **Mengotomatisasi** proses administrasi HR.
2.  **Meningkatkan efisiensi** operasional bagi pegawai, manajer, dan tim HR.
3.  **Menyediakan sumber data tunggal** (single source of truth) yang akurat dan terpercaya untuk semua data kepegawaian.
4.  **Meningkatkan transparansi dan pengalaman kerja** bagi seluruh pegawai.

#### **1.3. Ruang Lingkup**
PRD versi 1.0 ini mencakup fitur-fitur inti yang terkait dengan data pegawai, manajemen kehadiran, reimbursement, dan fungsi dasar HR. Fitur-fitur yang lebih kompleks seperti manajemen kinerja mendalam atau modul training akan dipertimbangkan untuk versi berikutnya.

#### **1.4. Metrik Keberhasilan**
*   **Efisiensi:** Penurunan waktu yang dihabiskan untuk tugas administrasi HR sebesar 30% dalam 3 bulan setelah peluncuran.
*   **Adopsi:** 95% pegawai aktif menggunakan sistem untuk clock-in/out dan pengajuan izin dalam 1 bulan pertama.
*   **Akurasi Data:** Penurunan kesalahan dalam pemrosesan payroll yang disebabkan oleh data kehadiran sebesar 90%.
*   **Kepuasan Pengguna:** Skor Net Promoter Score (NPS) atau survei kepuasan internal di atas 7/10.

---

### **2. Peran Pengguna dan Izin Akses (User Roles & Permissions)**

Sistem akan memiliki tiga peran utama dengan tingkat akses yang berbeda:

1.  **Pegawai (Employee):**
    *   Melihat dan mengelola profil pribadi (data yang diizinkan).
    *   Melakukan clock in/out.
    *   Mengajukan izin, cuti, dan reimbursement.
    *   Melihat riwayat kehadiran dan pengajuan pribadi.
    *   Melihat slip gaji.
    *   Melihat struktur organisasi.

2.  **Manajer (Manager):**
    *   Memiliki semua hak akses **Pegawai**.
    *   Melihat profil dan data dasar tim yang dipimpinnya.
    *   Menyetujui atau menolak pengajuan izin, cuti, dan reimbursement dari timnya.
    *   Melihat rekap kehadiran tim.
    *   Memberikan feedback kepada anggota tim.

3.  **Admin HR (HR Admin):**
    *   Memiliki hak akses penuh ke seluruh sistem.
    *   Mengelola data semua pegawai (tambah, edit, nonaktifkan).
    *   Mengelola pengaturan sistem (tipe izin, kuota cuti, kategori reimbursement).
    *   Memproses payroll untuk seluruh perusahaan.
    *   Mengelola pengumuman perusahaan.
    *   Mengakses dan membuat laporan dari seluruh data.

---

### **3. Fitur Utama (Core Features)**

#### **3.1. Dashboard Utama**
*   **User Story:** Sebagai pengguna, saya ingin melihat ringkasan informasi penting dan tugas yang perlu saya lakukan saat pertama kali login, agar saya bisa bekerja dengan cepat dan efisien.
*   **Persyaratan:**
    *   **Untuk Pegawai:** Menampilkan status kehadiran hari ini, sisa kuota cuti, status pengajuan terakhir (izin/reimbursement), dan pengumuman terbaru.
    *   **Untuk Manajer:** Menampilkan semua yang ada di dashboard Pegawai, ditambah daftar permintaan yang butuh persetujuan (mis: 3 pengajuan cuti), dan ringkasan kehadiran tim hari ini (siapa yang hadir, izin, atau alpa).
    *   **Untuk Admin HR:** Menampilkan statistik kunci (jumlah total pegawai, pegawai baru bulan ini, jumlah permintaan yang menunggu diproses), dan shortcut ke fungsi admin utama.

#### **3.2. Manajemen Data Pegawai**
*   **User Story:** Sebagai Admin HR, saya ingin dapat mengelola semua data pegawai di satu tempat untuk memastikan data selalu akurat dan up-to-date.
*   **Fitur:**
    *   **Tambah Pegawai Baru:** Form untuk memasukkan data pegawai baru (ID Pegawai, Nama, Departemen, Posisi, Tanggal Bergabung, Info Kontak, Kontak Darurat, Info Rekening Bank).
    *   **Profil Pegawai:** Halaman detail untuk setiap pegawai, berisi:
        *   Informasi Personal & Pekerjaan.
        *   Dokumen (KTP, NPWP, Kontrak Kerja) - hanya bisa diakses oleh Admin HR.
        *   Riwayat Kehadiran.
        *   Riwayat Pengajuan (Cuti, Izin, Reimbursement).
    *   **Pencarian & Filter:** Kemampuan untuk mencari pegawai berdasarkan nama, ID, departemen, atau posisi.
    *   **Struktur Organisasi:** Bagan visual yang menunjukkan hierarki perusahaan, dari CEO hingga staf.

#### **3.3. Manajemen Kehadiran**
*   **User Story:** Sebagai pegawai, saya ingin mencatat kehadiran saya dengan mudah dan mengajukan izin secara online agar transparan dan tercatat dengan baik.
*   **Fitur:**
    *   **Clock In / Clock Out:**
        *   Tombol sederhana di dashboard.
        *   Mencatat waktu, tanggal, dan (opsional) lokasi via Geolocation atau IP Address untuk validasi.
        *   Ada fitur untuk mengajukan koreksi jam (jika lupa clock-in/out) yang memerlukan persetujuan Manajer.
    *   **Pengajuan Izin & Cuti:**
        *   Form pengajuan online: pilih tipe (sakit, cuti tahunan, izin khusus), rentang tanggal, dan alasan.
        *   Sistem secara otomatis menghitung dan menampilkan sisa kuota cuti.
        *   Alur persetujuan: Pegawai Mengajukan -> Manajer Menerima Notifikasi -> Manajer Menyetujui/Menolak -> Pegawai & HR Menerima Notifikasi.
    *   **Kalender Tim (Untuk Manajer):** Tampilan kalender yang menunjukkan siapa saja di dalam tim yang sedang cuti atau izin.

#### **3.4. Manajemen Reimbursement**
*   **User Story:** Sebagai pegawai, saya ingin mengajukan klaim penggantian biaya dengan mudah dengan melampirkan bukti, dan melacak statusnya hingga dibayarkan.
*   **Fitur:**
    *   **Form Pengajuan Reimbursement:**
        *   Pilihan kategori (mis: Biaya Transportasi, Pembelian ATK, Bill Kesehatan, Entertain Klien).
        *   Input tanggal, jumlah, dan deskripsi.
        *   **Wajib** mengunggah foto/scan bukti pembayaran (struk/invoice).
    *   **Alur Persetujuan:** Pegawai Mengajukan -> Manajer Menyetujui/Menolak -> Admin HR/Finance Memverifikasi & Memproses Pembayaran.
    *   **Pelacakan Status:** Pegawai dapat melihat status pengajuannya (Menunggu, Disetujui, Ditolak, Telah Dibayar).

#### **3.5. Modul HR**
*   **User Story:** Sebagai Admin HR, saya ingin memproses penggajian secara akurat berdasarkan data kehadiran dan reimbursement, serta memfasilitasi komunikasi di perusahaan.
*   **Fitur:**
    *   **Payroll (Penggajian):**
        *   Sistem secara otomatis menarik data kehadiran (potongan keterlambatan/alpa) dan data reimbursement yang telah disetujui.
        *   Komponen gaji dapat diatur: gaji pokok, tunjangan tetap, tunjangan tidak tetap, bonus, PPh 21, BPJS.
        *   Menghasilkan **Slip Gaji** dalam format PDF yang dapat diunduh oleh setiap pegawai melalui akun mereka.
    *   **Feedback & Apresiasi:**
        *   Fitur sederhana bagi Manajer untuk memberikan feedback (konstruktif atau apresiasi) kepada anggota timnya. Feedback ini tercatat di profil pegawai (hanya dapat dilihat oleh pegawai, manajer, dan HR).
        *   Pegawai juga bisa memberikan feedback kepada rekan kerja atau manajer (opsional, bisa dibuat anonim).
    *   **Pengumuman (Announcements):**
        *   Admin HR dapat membuat dan mempublikasikan pengumuman untuk seluruh perusahaan yang akan muncul di dashboard setiap pengguna.

---

### **4. Fitur Tambahan yang Disarankan (Value-add Features)**

*   **Manajemen Aset:** Modul untuk mencatat aset perusahaan yang dipinjamkan ke pegawai (mis: laptop, ponsel) dan melacak statusnya.
*   **Laporan & Analitik:** Dashboard khusus untuk Admin HR dan Manajemen Senior untuk melihat laporan seperti tingkat turnover, rekap kehadiran per departemen, total biaya reimbursement, dll.
*   **Notifikasi:** Sistem notifikasi otomatis via email atau push notification (jika ada aplikasi mobile) untuk:
    *   Pengingat clock-in/out.
    *   Status pengajuan (disetujui/ditolak).
    *   Pengumuman baru.
    *   Ulang tahun pegawai.

---

### **5. Kebutuhan Non-Fungsional**

*   **Keamanan:**
    *   Data pegawai, terutama yang sensitif, harus dienkripsi.
    *   Penerapan Role-Based Access Control (RBAC) yang ketat.
    *   Login aman dengan password yang kuat, dan opsi Two-Factor Authentication (2FA).
*   **Kinerja:**
    *   Waktu muat halaman tidak lebih dari 3 detik untuk interaksi normal.
*   **Skalabilitas:**
    *   Sistem harus dirancang untuk dapat menangani pertumbuhan jumlah pegawai hingga 5x lipat dari jumlah saat ini.
*   **Usability (Kemudahan Penggunaan):**
    *   Antarmuka harus intuitif, bersih, dan mudah digunakan bahkan oleh pengguna yang tidak terlalu mahir teknologi.
    *   Desain responsif agar dapat diakses dengan baik melalui desktop maupun perangkat mobile (browser).

---
**Catatan:** Dokumen ini adalah dokumen hidup (living document) dan dapat diperbarui seiring dengan perkembangan kebutuhan bisnis dan masukan dari pengguna.