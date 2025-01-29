<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{asset('sneat')}}/assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Input Surat Tugas</title>
    <link rel="icon" type="image/x-icon" href="{{asset('sneat')}}/assets/img/favicon/favicon.ico" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/css/demo.css" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="{{asset('sneat')}}/assets/vendor/js/helpers.js"></script>
    <script src="{{asset('sneat')}}/assets/js/config.js"></script>
  </head>
  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('user.layouts.sidebar')
        <div class="layout-page">
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Permohonan /</span> Input Surat Tugas</h4>
              <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-10 col-lg-8 col-xl-6">
                  <div class="card mb-4 shadow-sm">
                    <h5 class="card-header text-center">Form Surat Tugas</h5>
                    <div class="card-body">
                      <form method="POST" action="{{ route('surattugas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="tanggal" class="form-label">Tanggal</label>
                          <input type="date" class="form-control" id="tanggal" name="tanggal" required />
                        </div>
                        <div class="mb-3">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="Masukkan nomor surat" required />
                              <button type="button" class="btn btn-secondary">Generate</button>
                            </div>

                            <script>
                                document.querySelector('.btn-secondary').addEventListener('click', function() {
    const klasifikasiId = document.querySelector('#klasifikasi_id').value;

    // Cek jika klasifikasiId kosong
    if (!klasifikasiId) {
        alert('Pilih klasifikasi terlebih dahulu!');
        return;
    }

    fetch('/surattugas/generate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ klasifikasi_id: klasifikasiId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        document.querySelector('#nomor_surat').value = data.nomor_surat;
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat generate nomor surat.');
    });
});

                            </script>
                          </div>
                          
                        <div class="mb-3">
                          <label for="perihal" class="form-label">Perihal</label>
                          <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Masukkan perihal" required />
                        </div>
                        <div class="mb-3">
                          <label for="kepada" class="form-label">Kepada</label>
                          <input type="text" class="form-control" id="kepada" name="kepada" placeholder="Masukkan nama penerima" required />
                        </div>
                        <div class="mb-3">
                          <label for="tujuan_penugasan" class="form-label">Tujuan Penugasan</label>
                          <textarea class="form-control" id="tujuan_penugasan" name="tujuan_penugasan" rows="3" placeholder="Deskripsikan tujuan penugasan" required></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="klasifikasi_id" class="form-label">Klasifikasi</label>
                          <select class="form-select" id="klasifikasi_id" name="klasifikasi_id" required>
                            <option value="" disabled selected>Pilih Klasifikasi</option>
                            @foreach($klasifikasi as $item)
                              <option value="{{ $item->id }}">{{ $item->nama_klasifikasi }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="file_surat\" class="form-label">Upload File Surat</label>
                          <input type="file" class="form-control" id="file_surat" name="file_surat" />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © <script>document.write(new Date().getFullYear());</script>, made with ❤️ by ThemeSelection
                </div>
              </div>
            </footer>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{asset('sneat')}}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{asset('sneat')}}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{asset('sneat')}}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{asset('sneat')}}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{asset('sneat')}}/assets/vendor/js/menu.js"></script>
    <script src="{{asset('sneat')}}/assets/js/main.js"></script>
  </body>
</html>
