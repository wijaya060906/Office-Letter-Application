@include('admin.layouts.sidebar')
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('sneat') }}/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat') }}/assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/css/demo.css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="{{ asset('sneat') }}/assets/vendor/js/helpers.js"></script>
    <script src="{{ asset('sneat') }}/assets/js/config.js"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Toast Notification -->
            <div id="toast-notification" class="toast-notification container-xxl align-items-center"
    style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 1000; max-width: 400px; width: 100%; padding: 10px;">
    <div class="card shadow-lg">
        <div class="card-body" style="padding: 15px;">
            <form id="nomorSuratForm" method="POST">
                @csrf
                <input type="hidden" name="undangan_id" id="undangan_id">
                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" required
                    style="width: 100%; max-width: 350px; margin-bottom: 10px;">
                <button type="submit" class="btn btn-success btn-sm mt-2" style="width: 100%; max-width: 120px;">Simpan</button>
                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="closeToast()" style="width: 100%; max-width: 120px;">Tutup</button>
            </form>
        </div>
    </div>
</div>

            
            <div class="layout-page">
              <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables
                        </h4>
                        <div class="card">
                            <h5 class="card-header">Table Basic</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Surat</th>
                                            <th>Perihal</th>
                                            <th>Kepada/Tujuan</th>
                                            <th>Permohonan Tempat</th>
                                            <th>Konsumsi</th>
                                            <th>Tanggal Pelaksanaan</th>
                                            <th>Templete Surat</th>
                                            <th>Nomor Surat</th>
                                            <th>Naskah Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Undangan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tanggal_surat }}</td>
                                                <td>{{ $item->perihal }}</td>
                                                <td> {{ $item->klasifikasi->nama_klasifikasi }} / {{ $item->kepada }}</td>
                                                <td>{{ $item->permohonan_tempat }}</td>
                                                <td>{{ $item->permohonan_konsumsi }}</td>
                                                <td>{{ $item->penyelenggaraan_mulai }} -
                                                    {{ $item->penyelenggaraan_selesai }}</td>
                                                    <td>
                                                      @if ($item->template_surat)
                                                          <a href="{{ route('surat.download', ['id' => $item->id]) }}" class="btn btn-primary">Unduh</a>
                                                      @else
                                                          Nothing
                                                      @endif
                                                  </td>
                                                  
                                                <td>
                                                    @if ($item->nomor_surat)
                                                        {{ $item->nomor_surat }}
                                                    @else
                                                        nothing
                                                    @endif
                                                </td>
                                                <td>
                                                  @if ($item->naskah_surat)
                                                      <span class="text-success">Sudah diunggah</span>
                                                  @else
                                                      <form action="{{ route('surat.uploadNaskah', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                                          @csrf
                                                          <label class="btn btn-primary btn-sm mb-0 me-2">
                                                              Pilih File
                                                              <input type="file" name="naskah_surat" class="d-none" onchange="this.form.submit()">
                                                          </label>
                                                      </form>
                                                  @endif
                                              </td>
                                              
                                                                                            
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                                        onclick="showToast({{ $item->id }}, '{{ route('undangan.nomor', $item->id) }}')">
                                                        Nomor Surat
                                                    </a>
                                                    <a href="" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        
    </div>

    <script src="{{ asset('sneat') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/js/menu.js"></script>
    <script src="{{ asset('sneat') }}/assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        function showToast(id, actionUrl) {
            var toast = document.getElementById('toast-notification');
            toast.style.display = 'block';

            // Set ID undangan dan form action
            document.getElementById('undangan_id').value = id;
            document.getElementById('nomorSuratForm').action = actionUrl;
        }

        function closeToast() {
            document.getElementById('toast-notification').style.display = 'none';
        }
    </script>
</body>

</html>
