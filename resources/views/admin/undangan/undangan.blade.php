@include('admin.layouts.sidebar')
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sneat') }}/assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat') }}/assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/css/demo.css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="{{ asset('sneat') }}/assets/vendor/js/helpers.js"></script>
    <script src="{{ asset('sneat') }}/assets/js/config.js"></script>
  </head>
  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Toast Notification -->
        
        <div class="layout-page">
          <div id="toast-notification" class="toast-notification container-xxl align-items-center" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <label for="nomor_surat">Nomor Surat:</label>
                    <input type="text" id="nomor_surat" class="form-control" />
                    <button type="button" class="btn btn-success btn-sm mt-2" onclick="saveNomorSurat()">Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="closeToast()">X</button>
                </div>
            </div>
        </div>
        
        <script>
            // Fungsi untuk menutup toast notification
            function closeToast() {
                document.getElementById('toast-notification').style.display = 'none';
            }
        
            // Fungsi untuk menyimpan nomor surat
            function saveNomorSurat() {
                var nomorSurat = document.getElementById('nomor_surat').value;
        
                // Cek jika nomor surat kosong
                if (!nomorSurat) {
                    alert('Nomor Surat harus diisi!');
                    return;
                }
        
                // Kirim data menggunakan AJAX
                var formData = new FormData();
                formData.append('nomor_surat', nomorSurat);
        
                fetch("{{ route('undangan.nomor') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Nomor Surat berhasil disimpan!');
                        closeToast();
                    } else {
                        alert('Terjadi kesalahan!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan!');
                });
            }
        </script>
        

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
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
                    <tbody class="table-border-bottom-0">
                      @foreach ($Undangan as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->tanggal_surat }}</td>
                          <td>{{ $item->perihal }}</td>
                          <td> {{ $item->klasifikasi->nama_klasifikasi }} / {{ $item->kepada }}</td>
                          <td>{{ $item->permohonan_tempat }}</td>
                          <td>{{ $item->permohonan_konsumsi }}</td>
                          <td>{{ $item->penyelenggaraan_mulai }} - {{ $item->penyelenggaraan_selesai }}</td>
                          <td>{{ $item->template_surat }}</td>
                          <td>
                            @if ($item->nomor_surat)
                              {{ $item->nomor_surat }}
                            @else
                              nothing
                            @endif
                          </td>
                          <td>
                            @if ($item->naskah_surat)
                              {{ $item->naskah_surat }}
                            @else
                              Waiting
                            @endif
                          </td>
                          <td>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="showToast({{ $item->id }})">Nomor Surat</a>
                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                            <form action="" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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
      <div class="buy-now">
        <a href="{{ route('undangan.create') }}" target="_blank" class="btn btn-danger btn-buy-now">Buat Surat Undangan</a>
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
      function showToast(id) {
        var toast = document.getElementById('toast-notification');
        toast.style.display = 'block';
        // Handle any other logic here for showing the toast, like populating fields if necessary
      }

      function saveNomorSurat() {
        var nomorSurat = document.getElementById('nomor_surat').value;
        if (nomorSurat) {
          alert("Nomor Surat " + nomorSurat + " has been saved!");
          document.getElementById('toast-notification').style.display = 'none';
        } else {
          alert("Please enter a Nomor Surat.");
        }
      }

      // Close the toast notification when the 'X' button is clicked
      function closeToast() {
        document.getElementById('toast-notification').style.display = 'none';
      }
    </script>
  </body>
</html>
