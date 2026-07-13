<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Nomor Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f1f3f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container-box {
            max-width: 1100px;
            margin: 0 auto;
        }

        .btn-ambil {
            height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
            border: none;
        }

        .btn-ambil:active {
            transform: scale(0.96);
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-dark m-0">SILAKAN AMBIL NOMOR ANTRIAN</h1>
            <p class="text-muted fs-5">Pengadilan Militer IV-15 Banjarmasin</p>
        </div>

        <div class="container-box">
            <div class="row g-4 justify-content-center">

                <div class="col-md-6 col-lg-3">
                    <button class="btn btn-danger w-100 p-4 fs-4 rounded-4 btn-ambil" data-divisi="Kesekretariatan">
                        <i class="bi bi-pen fs-1 mb-3"></i>
                        <span>KESEKRETARIATAN</span>
                    </button>
                </div>

                <div class="col-md-6 col-lg-3">
                    <button class="btn btn-success w-100 p-4 fs-4 rounded-4 btn-ambil" data-divisi="Kepaniteraan">
                        <i class="bi bi-book fs-1 mb-3"></i>
                        <span>KEPANITERAAN</span>
                    </button>
                </div>

                <div class="col-md-6 col-lg-3">
                    <button class="btn btn-primary w-100 p-4 fs-4 rounded-4 btn-ambil" data-divisi="Informasi">
                        <i class="bi bi-info-circle fs-1 mb-3"></i>
                        <span>INFORMASI (PTSP)</span>
                    </button>
                </div>

                <div class="col-md-6 col-lg-3">
                    <button class="btn btn-warning text-dark w-100 p-4 fs-4 rounded-4 btn-ambil"
                        data-divisi="Konsultasi dan Pengaduan">
                        <i class="bi bi-chat-square-text fs-1 mb-3"></i>
                        <span style="font-size: 0.95rem; line-height: 1.2;">KONSULTASI & PENGADUAN</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-ambil').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const divisiTerpilih = this.getAttribute('data-divisi');
                const tombolAsli = this.innerHTML;

                this.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...`;
                this.disabled = true;

                fetch('/simpan-antrian', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ divisi: divisiTerpilih })
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal mengambil antrian');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {

                            const jamCetak = data.waktu || new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                            alert(
                                `===================================\n` +
                                `     PENGADILAN MILITER IV-15 \n` +
                                `          BANJARMASIN \n` +
                                `===================================\n\n` +
                                ` NOMOR ANDA : ${data.nomor_baru}\n` +
                                ` LAYANAN    : ${divisiTerpilih.toUpperCase()}\n` +
                                ` WAKTU      : ${jamCetak} WITA\n\n` +
                                `===================================\n` +
                                `   Silakan duduk di ruang tunggu.`
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Mohon maaf, sistem sedang sibuk. Silakan coba lagi.');
                    })
                    .finally(() => {
                        this.innerHTML = tombolAsli;
                        this.disabled = false;
                    });
            });
        });
    </script>

</body>

</html>