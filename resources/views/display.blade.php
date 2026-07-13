<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Antrian PTSP - DILMIL I-06 Banjarmasin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">



    <style>
        body {
            background-color: #f1f3f5;
            color: #212529;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .header-panel {
            background-color: #ffffff;
            border-bottom: 6px solid #198754;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.06);
            padding: 25px 20px !important;
        }

        .divisi-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .divisi-header {
            border-radius: 19px 19px 0 0;
            padding: 15px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .number-display {
            font-size: 5rem;
            font-weight: 900;
            line-height: 1.1;
        }

        .sub-box {
            background-color: #f8f9fa;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .skip-section {
            background-color: #ffffff;
            border: 2px solid #ffc107;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .font-monospace {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace !important;
        }
    </style>
</head>

<body>

    <div class="header-panel text-center mb-4">
        <h1 class="fw-black m-0 text-dark mb-1"
            style="font-size: 3.5rem; font-weight: 800; letter-spacing: 3px; line-height: 1.2;">
            MONITOR ANTRIAN DIGITAL
        </h1>
        <h2 class="text-muted m-0 fw-bold fs-2" style="letter-spacing: 1px;">
            Pengadilan Militer IV-15 Banjarmasin
        </h2>
    </div>

    <div class="container-fluid px-4" style="margin-bottom: 140px;">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">

            <div class="col">
                <div class="divisi-card h-100 shadow-sm"
                    style="min-height: 480px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="divisi-header bg-primary text-white text-center fs-4 py-3 fw-bold">
                        <i class="bi bi-pen"></i> Kesekretariatan
                    </div>
                    <div class="p-4 text-center flex-grow-1 d-flex flex-column justify-content-around">
                        <div>
                            <p class="text-muted fw-bold text-uppercase tracking-wider small mb-1">Antrian Sekarang</p>
                            <div id="sekarang-kesekretariatan" class="number-display text-primary my-3"
                                style="font-size: 5.5rem;">-</div>
                        </div>
                        <div>
                            <div
                                class="badge bg-success bg-opacity-10 text-success border border-success px-4 py-2 rounded-pill fs-6 fw-bold mb-4">
                                Silakan Menuju Kesekretariatan
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Selanjutnya</small>
                                    <strong id="selanjutnya-kesekretariatan" class="fs-3 text-dark">-</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Sisa Antrian</small>
                                    <strong id="sisa-kesekretariatan" class="fs-3 text-dark">0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="divisi-card h-100 shadow-sm"
                    style="min-height: 480px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="divisi-header bg-success text-white text-center fs-4 py-3 fw-bold">
                        <i class="bi bi-shield-fill"></i> Kepaniteraan
                    </div>
                    <div class="p-4 text-center flex-grow-1 d-flex flex-column justify-content-around">
                        <div>
                            <p class="text-muted fw-bold text-uppercase tracking-wider small mb-1">Antrian Sekarang</p>
                            <div id="sekarang-kepaniteraan" class="number-display text-success my-3"
                                style="font-size: 5.5rem;">-</div>
                        </div>
                        <div>
                            <div
                                class="badge bg-success bg-opacity-10 text-success border border-success px-4 py-2 rounded-pill fs-6 fw-bold mb-4">
                                Silakan Menuju Kepaniteraan
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Selanjutnya</small>
                                    <strong id="selanjutnya-kepaniteraan" class="fs-3 text-dark">-</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Sisa Antrian</small>
                                    <strong id="sisa-kepaniteraan" class="fs-3 text-dark">0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="divisi-card h-100 shadow-sm"
                    style="min-height: 480px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="divisi-header bg-warning text-white text-center fs-4 py-3 fw-bold">
                        <i class="bi bi-info-circle-fill"></i> Informasi (PTSP)
                    </div>
                    <div class="p-4 text-center flex-grow-1 d-flex flex-column justify-content-around">
                        <div>
                            <p class="text-muted fw-bold text-uppercase tracking-wider small mb-1">Antrian Sekarang</p>
                            <div id="sekarang-informasi" class="number-display text-warning my-3"
                                style="font-size: 5.5rem;">-</div>
                        </div>
                        <div>
                            <div
                                class="badge bg-success bg-opacity-10 text-success border border-success px-4 py-2 rounded-pill fs-6 fw-bold mb-4">
                                Silakan Menuju Meja Informasi
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Selanjutnya</small>
                                    <strong id="selanjutnya-informasi" class="fs-3 text-dark">-</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Sisa Antrian</small>
                                    <strong id="sisa-informasi" class="fs-3 text-dark">0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="divisi-card h-100 shadow-sm"
                    style="min-height: 480px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="divisi-header bg-danger text-dark text-center py-3 fw-bold"
                        style="font-size: 1.15rem; padding-left: 5px; padding-right: 5px;">
                        <i class="bi bi-chat-square-text-fill"></i> Konsultasi & Pengaduan
                    </div>
                    <div class="p-4 text-center flex-grow-1 d-flex flex-column justify-content-around">
                        <div>
                            <p class="text-muted text-dark fw-bold text-uppercase tracking-wider small mb-1">Antrian
                                Sekarang</p>
                            <div id="sekarang-konsultasi" class="number-display text-danger my-3"
                                style="font-size: 5.5rem;">-</div>
                        </div>
                        <div>
                            <div
                                class="badge bg-success bg-opacity-10 text-success border border-success px-4 py-2 rounded-pill fs-6 fw-bold mb-4">
                                Silakan Menuju Ruang Konsultasi
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Selanjutnya</small>
                                    <strong id="selanjutnya-konsultasi" class="fs-3 text-dark">-</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="sub-box p-3">
                                    <small class="text-muted d-block mb-1">Sisa Antrian</small>
                                    <strong id="sisa-konsultasi" class="fs-3 text-dark">0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 1030; background-color: #f1f3f5;">

        <div class="skip-section p-3 bg-white border-start-0 border-end-0 border-bottom-0 mx-0 rounded-0"
            style="border-top: 4px solid #ffc107;">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="me-4 text-warning flex-shrink-0" style="width: 280px;">
                        <h4 class="fw-bold m-0 text-dark text-uppercase">
                            <i class="bi bi-skip-forward-circle-fill text-warning"></i> Antrian Terlewat:
                        </h4>
                        <small class="text-muted fw-semibold">Silakan melapor ke petugas jika nomor Anda ada di
                            samping</small>
                    </div>
                    <div id="all-list-dilewati"
                        class="d-flex flex-wrap gap-3 align-items-center fs-2 fw-bold text-dark ps-4 border-start border-3 border-warning-subtle flex-grow-1">
                        <span class="text-muted fs-5 fw-normal">Tidak ada antrian yang terlewat</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark text-white py-2" style="border-top: 2px solid #343a40;">
            <div class="container-fluid d-flex align-items-center justify-content-between overflow-hidden">

                <div class="flex-grow-1 overflow-hidden me-4">
                    <marquee class="fw-semibold fs-5 m-0 pt-1" behavior="scroll" direction="left" scrollamount="6">
                        Selamat Datang di Pengadilan Militer IV-15 Banjarmasin • Demi Kenyamanan Bersama, Silakan Ambil
                        Nomor Antrean Sesuai Layanan Keperluan Anda dan Duduk di Ruang Tunggu Hingga Dipanggil Petugas.
                    </marquee>
                </div>

                <div class="flex-shrink-0 bg-success bg-gradient px-4 py-1 rounded-3 text-center border border-success-subtle shadow-sm"
                    style="min-width: 260px;">
                    <div id="live-clock" class="fw-bold fs-4 text-white font-monospace" style="line-height: 1.1;">
                        00:00:00</div>
                    <div id="live-date" class="text-white-50 fw-semibold"
                        style="font-size: 0.8rem; letter-spacing: 0.5px;">-</div>
                </div>

            </div>
        </div>

    </div>

    <script>

        function updateLiveClock() {
            const sekarang = new Date();
            const jam = String(sekarang.getHours()).padStart(2, '0');
            const menit = String(sekarang.getMinutes()).padStart(2, '0');
            const detik = String(sekarang.getSeconds()).padStart(2, '0');
            document.getElementById('live-clock').innerText = `${jam}:${menit}:${detik} WITA`;

            const opsiTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('live-date').innerText = sekarang.toLocaleDateString('id-ID', opsiTanggal);
        }
        setInterval(updateLiveClock, 1000);
        window.addEventListener('DOMContentLoaded', updateLiveClock);

        let updateTerakhirKesekretariatan = null;
        let updateTerakhirKepaniteraan = null;
        let updateTerakhirInformasi = null;
        let updateTerakhirKonsultasi = null;

        let antreanSuara = [];
        let sedangBerbicara = false;

        function perbaruiMonitorMaju() {
            fetch('/api/data-monitor')
                .then(response => response.json())
                .then(data => {

                    // --- LAYANAN KESEKRETARIATAN ---
                    if (data.divisi_kesekretariatan) {
                        if (updateTerakhirKesekretariatan === null) {
                            updateTerakhirKesekretariatan = data.divisi_kesekretariatan.waktu_update;
                        } else if (data.divisi_kesekretariatan.sekarang !== '-' && data.divisi_kesekretariatan.waktu_update !== updateTerakhirKesekretariatan) {
                            updateTerakhirKesekretariatan = data.divisi_kesekretariatan.waktu_update;
                            tambahKeAntrean(data.divisi_kesekretariatan.sekarang);
                        }
                        if (document.getElementById('sekarang-kesekretariatan')) {
                            document.getElementById('sekarang-kesekretariatan').innerText = data.divisi_kesekretariatan.sekarang;
                            document.getElementById('selanjutnya-kesekretariatan').innerText = data.divisi_kesekretariatan.selanjutnya;
                            document.getElementById('sisa-kesekretariatan').innerText = data.divisi_kesekretariatan.sisa;
                        }
                    }

                    // --- LAYANAN KEPANITERAAN ---
                    if (data.divisi_kepaniteraan) {
                        if (updateTerakhirKepaniteraan === null) {
                            updateTerakhirKepaniteraan = data.divisi_kepaniteraan.waktu_update;
                        } else if (data.divisi_kepaniteraan.sekarang !== '-' && data.divisi_kepaniteraan.waktu_update !== updateTerakhirKepaniteraan) {
                            updateTerakhirKepaniteraan = data.divisi_kepaniteraan.waktu_update;
                            tambahKeAntrean(data.divisi_kepaniteraan.sekarang);
                        }
                        if (document.getElementById('sekarang-kepaniteraan')) {
                            document.getElementById('sekarang-kepaniteraan').innerText = data.divisi_kepaniteraan.sekarang;
                            document.getElementById('selanjutnya-kepaniteraan').innerText = data.divisi_kepaniteraan.selanjutnya;
                            document.getElementById('sisa-kepaniteraan').innerText = data.divisi_kepaniteraan.sisa;
                        }
                    }

                    // --- LAYANAN INFORMASI ---
                    if (data.divisi_informasi) {
                        if (updateTerakhirInformasi === null) {
                            updateTerakhirInformasi = data.divisi_informasi.waktu_update;
                        } else if (data.divisi_informasi.sekarang !== '-' && data.divisi_informasi.waktu_update !== updateTerakhirInformasi) {
                            updateTerakhirInformasi = data.divisi_informasi.waktu_update;
                            tambahKeAntrean(data.divisi_informasi.sekarang);
                        }
                        if (document.getElementById('sekarang-informasi')) {
                            document.getElementById('sekarang-informasi').innerText = data.divisi_informasi.sekarang;
                            document.getElementById('selanjutnya-informasi').innerText = data.divisi_informasi.selanjutnya;
                            document.getElementById('sisa-informasi').innerText = data.divisi_informasi.sisa;
                        }
                    }

                    // --- LAYANAN KONSULTASI DAN PENGADUAN ---
                    if (data.divisi_konsultasi_dan_pengaduan) {
                        if (updateTerakhirKonsultasi === null) {
                            updateTerakhirKonsultasi = data.divisi_konsultasi_dan_pengaduan.waktu_update;
                        } else if (data.divisi_konsultasi_dan_pengaduan.sekarang !== '-' && data.divisi_konsultasi_dan_pengaduan.waktu_update !== updateTerakhirKonsultasi) {
                            updateTerakhirKonsultasi = data.divisi_konsultasi_dan_pengaduan.waktu_update;
                            tambahKeAntrean(data.divisi_konsultasi_dan_pengaduan.sekarang);
                        }
                        if (document.getElementById('sekarang-konsultasi')) {
                            document.getElementById('sekarang-konsultasi').innerText = data.divisi_konsultasi_dan_pengaduan.sekarang;
                            document.getElementById('selanjutnya-konsultasi').innerText = data.divisi_konsultasi_dan_pengaduan.selanjutnya;
                            document.getElementById('sisa-konsultasi').innerText = data.divisi_konsultasi_dan_pengaduan.sisa;
                        }
                    }

                    const boxDilewati = document.getElementById('all-list-dilewati');
                    if (boxDilewati) {
                        boxDilewati.innerHTML = '';
                        const gabunganDilewati = [
                            ...(data.divisi_kesekretariatan ? data.divisi_kesekretariatan.dilewati : []),
                            ...(data.divisi_kepaniteraan ? data.divisi_kepaniteraan.dilewati : []),
                            ...(data.divisi_informasi ? data.divisi_informasi.dilewati : []),
                            ...(data.divisi_konsultasi_dan_pengaduan ? data.divisi_konsultasi_dan_pengaduan.dilewati : [])
                        ];

                        if (gabunganDilewati.length > 0) {
                            gabunganDilewati.forEach(nomor => {
                                const badge = document.createElement('span');

                                let warnaBadge = 'bg-primary';
                                if (nomor.startsWith('S')) warnaBadge = 'bg-primary';
                                if (nomor.startsWith('P')) warnaBadge = 'bg-success';
                                if (nomor.startsWith('I')) warnaBadge = 'bg-warning text-dark';
                                if (nomor.startsWith('K')) warnaBadge = 'bg-danger';

                                badge.className = `badge ${warnaBadge} px-3 py-2 rounded-2 shadow-sm fs-4 me-2 mb-2`;
                                badge.innerText = nomor;
                                boxDilewati.appendChild(badge);
                            });
                        } else {
                            boxDilewati.innerHTML = '<span class="text-muted fs-5 fw-normal">Tidak ada antrian yang terlewat</span>';
                        }
                    }
                })
                .catch(error => console.error('Gagal memuat data gabungan monitor TV:', error));
        }

        function tambahKeAntrean(nomorAntrian) {
            if ('speechSynthesis' in window) {
                const hurufDivisi = nomorAntrian.charAt(0).toUpperCase();
                const angkaUtuh = parseInt(nomorAntrian.substring(2), 10);

                let teksLayananResmi = "Kesekretariatan";

                if (hurufDivisi === 'S') {
                    teksLayananResmi = "Kesekretariatan";
                } else if (hurufDivisi === 'P') {
                    teksLayananResmi = "Kepaniteraan";
                } else if (hurufDivisi === 'I') {
                    teksLayananResmi = "Informasi";
                } else if (hurufDivisi === 'K') {
                    teksLayananResmi = "Konsultasi dan Pengaduan";
                }

                const teksPanggilan = `Nomor Antrian ${hurufDivisi}, ${angkaUtuh}. Silakan menuju ke Layanan ${teksLayananResmi}`;

                antreanSuara.push(teksPanggilan);

                if (!sedangBerbicara) {
                    prosesAntreanSuara();
                }
            }
        }

        function prosesAntreanSuara() {
            if (antreanSuara.length === 0) {
                sedangBerbicara = false;
                return;
            }

            sedangBerbicara = true;
            const teksBerikutnya = antreanSuara.shift();

            const speech = new SpeechSynthesisUtterance(teksBerikutnya);
            speech.lang = 'id-ID';
            speech.rate = 0.85;

            speech.onend = function () {
                setTimeout(() => {
                    prosesAntreanSuara();
                }, 1000);
            };

            speech.onerror = function () {
                sedangBerbicara = false;
                prosesAntreanSuara();
            };

            window.speechSynthesis.speak(speech);
        }

        setInterval(perbaruiMonitorMaju, 2000);
        perbaruiMonitorMaju();
    </script>

</body>

</html>