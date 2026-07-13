<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Panggilan Antrian (Laravel)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="m-0 fw-bold text-dark">
                <i class="bi bi-person-workspace text-primary"></i> Operator (Layanan {{ $divisi_aktif }})
            </h2>

            <div class="d-flex gap-2">
                <button class="btn btn-success px-4 rounded-pill shadow-sm" id="btn-ambil-langsung"
                    data-divisi="{{ $divisi_aktif }}">
                    <i class="bi bi-plus-circle-fill"></i> Ambil Antrian Baru
                </button>

                <a href="/" class="btn btn-secondary px-4 rounded-pill shadow-sm">
                    <i class="bi bi-box-arrow-left fs-5"></i> Logout
                </a>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card p-3 border-0 shadow-sm text-center">
                    <h1 class="text-warning display-4 fw-bold" id="txt-total">{{ $jumlah_antrian }}</h1>
                    <p class="text-muted mb-0">Jumlah Antrian</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 border-0 shadow-sm text-center">
                    <h1 class="text-info display-4 fw-bold" id="txt-sekarang">{{ $antrian_sekarang }}</h1>
                    <p class="text-muted mb-0">Antrian Sekarang</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 border-0 shadow-sm text-center">
                    <h1 class="text-primary display-4 fw-bold" id="txt-selanjutnya">{{ $antrian_selanjutnya }}</h1>
                    <p class="text-muted mb-0">Antrian Selanjutnya</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 border-0 shadow-sm text-center">
                    <h1 class="text-danger display-4 fw-bold" id="txt-sisa">{{ $sisa_antrian }}</h1>
                    <p class="text-muted mb-0">Sisa Antrian</p>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Nomor Antrian</th>
                        <th>Status</th>
                        <th>Panggil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semua_antrian as $row)
                        <tr
                            class="{{ $row->status == 'selesai' ? 'table-light text-muted text-decoration-line-through' : '' }}">

                            <td class="fw-bold fs-5">
                                @php
                                    $warnaBadge = 'bg-primary';
                                    if (Str::startsWith($row->nomor_antrian, 'P'))
                                        $warnaBadge = 'bg-success';
                                    if (Str::startsWith($row->nomor_antrian, 'I'))
                                        $warnaBadge = 'bg-warning text-dark';
                                    if (Str::startsWith($row->nomor_antrian, 'K'))
                                        $warnaBadge = 'bg-danger'; 
                                @endphp
                                <span class="badge {{ $warnaBadge }} fs-5 px-3 py-2 shadow-sm">
                                    {{ $row->nomor_antrian }}
                                </span>
                            </td>

                            <td>
                                @if($row->status == 'dipanggil')
                                    <span class="badge bg-light text-success border border-success px-3 py-2 fs-6 rounded-pill">
                                        <i class="bi bi-megaphone-fill"></i> Sedang Dipanggil
                                    </span>
                                @elseif($row->status == 'menunggu')
                                    <span class="badge bg-light text-warning border border-warning px-3 py-2 fs-6 rounded-pill">
                                        <i class="bi bi-clock-history"></i> Menunggu
                                    </span>
                                @elseif($row->status == 'dilewati')
                                    <span class="badge bg-light text-danger border border-danger px-3 py-2 fs-6 rounded-pill">
                                        <i class="bi bi-skip-forward-circle-fill"></i> Dilewati
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border border-secondary px-3 py-2 fs-6 rounded-pill">
                                        <i class="bi bi-check-circle-fill"></i> Selesai
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($row->status == 'menunggu')
                                    @if($row->id == $next_id)
                                        <button class="btn btn-success btn-panggil" data-id="{{ $row->id }}"
                                            data-nomor="{{ $row->nomor_antrian }}">
                                            <i class="bi bi-mic-fill"></i> Panggil
                                        </button>
                                    @else
                                        <button class="btn btn-warning text-dark opacity-75" disabled>
                                            <i class="bi bi-lock-fill"></i> Antrian Selanjutnya
                                        </button>
                                    @endif

                                @elseif($row->status == 'dipanggil')
                                    <button class="btn btn-primary btn-panggil" data-id="{{ $row->id }}"
                                        data-nomor="{{ $row->nomor_antrian }}">
                                        <i class="bi bi-arrow-clockwise"></i> Panggil Ulang
                                    </button>
                                    <button class="btn btn-warning btn-skip" data-id="{{ $row->id }}">
                                        <i class="bi bi-skip-forward-fill"></i> Lewati
                                    </button>

                                @elseif($row->status == 'dilewati')
                                    <button class="btn btn-primary btn-panggil" data-id="{{ $row->id }}"
                                        data-nomor="{{ $row->nomor_antrian }}">
                                        <i class="bi bi-arrow-clockwise"></i> Panggil Ulang
                                    </button>

                                @else
                                    <button class="btn btn-secondary" disabled>
                                        <i class="bi bi-check-circle-fill"></i> Selesai
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $semua_antrian->appends(['divisi' => $divisi_aktif])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-panggil').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const id = this.getAttribute('data-id');
                const nomorAntrian = this.getAttribute('data-nomor');

                fetch(`/panggil/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal memperbarui database');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.getElementById('txt-total').innerText = data.jumlah_antrian;
                            document.getElementById('txt-sekarang').innerText = data.antrian_sekarang;
                            document.getElementById('txt-selanjutnya').innerText = data.antrian_selanjutnya;
                            document.getElementById('txt-sisa').innerText = data.sisa_antrian;

                            suarakanAntrian(nomorAntrian);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memanggil antrian, periksa koneksi server.');
                    });
            });
        });

        document.querySelectorAll('.btn-skip').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const id = this.getAttribute('data-id');

                fetch(`/skip/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Server bermasalah saat mengeksekusi skip');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error detail:', error);
                        alert('Gagal melewati antrian, silakan cek log server.');
                    });
            });
        });

        function suarakanAntrian(nomorAntrian) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();

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

                const speech = new SpeechSynthesisUtterance(teksPanggilan);
                speech.lang = 'id-ID';
                speech.rate = 0.9;

                speech.onend = function (event) {
                    window.location.reload();
                };

                window.speechSynthesis.speak(speech);
            } else {
                window.location.reload();
            }
        }

        const btnAmbilLangsung = document.getElementById('btn-ambil-langsung');
        if (btnAmbilLangsung) {
            const divisiTerpilih = btnAmbilLangsung.getAttribute('data-divisi');
            const tombolTextAsli = btnAmbilLangsung.innerHTML;

            btnAmbilLangsung.onclick = function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                if (btnAmbilLangsung.disabled) return;
                btnAmbilLangsung.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...`;
                btnAmbilLangsung.disabled = true;

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
                        if (!response.ok) throw new Error('Gagal menambah antrian');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Antrian Berhasil Dibuat!',
                                html: `
                                    <div class="text-center my-2">
                                        <p class="text-muted mb-1">Nomor Antrian Baru</p>
                                        <h1 class="display-3 fw-bold text-success m-0" style="letter-spacing: 2px;">${data.nomor_baru}</h1>
                                        <p class="mt-2 mb-0 badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fs-6">
                                            <i class="bi bi-layers-half"></i> Layanan ${divisiTerpilih}
                                        </p>
                                    </div>
                                `,
                                icon: 'success',
                                confirmButtonText: '<i class="bi bi-check2-circle"></i> Selesai',
                                confirmButtonColor: '#198754',
                                allowOutsideClick: false,
                                customClass: {
                                    popup: 'rounded-4 shadow-lg border-0'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal membuat nomor antrian baru, silakan coba lagi.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545'
                        });
                        btnAmbilLangsung.innerHTML = tombolTextAsli;
                        btnAmbilLangsung.disabled = false;
                    });
            };
        }
    </script>

</body>

</html>