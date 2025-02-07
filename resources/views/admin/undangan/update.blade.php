<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Agenda Nomor Surat Undangan</title>
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/vendor/css/theme-default.css" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/css/demo.css" />
    <link rel="stylesheet" href="{{asset('sneat')}}/assets/vendor/fonts/boxicons.css" />
  </head>
  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('user.layouts.sidebar')
        <div class="layout-page">
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4 text-center">Agenda Nomor Surat Undangan</h4>
              <div class="d-flex justify-content-center">
                <div class="col-md-8">
                  <div class="card shadow-sm">
                    <h5 class="card-header text-center">Form Agenda Surat</h5>
                    <div class="card-body">
                        <form action="{{ route('undangan.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal_surat" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="{{ $surat->tanggal_surat }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="perihal" class="form-label">Perihal</label>
                                <input type="text" class="form-control" id="perihal" name="perihal" value="{{ $surat->perihal }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="kepada" class="form-label">Kepada</label>
                                <textarea class="form-control" id="kepada" name="kepada" rows="2" required>{{ $surat->kepada }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Permohonan Tempat/Aula</label>
                                <select class="form-select" id="permohonan_tempat" name="permohonan_tempat" required>
                                    <option value="tidak" {{ $surat->permohonan_tempat == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                    <option value="ya" {{ $surat->permohonan_tempat == 'ya' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Permohonan Konsumsi</label>
                                <select class="form-select" id="permohonan_konsumsi" name="permohonan_konsumsi" required>
                                    <option value="tidak" {{ $surat->permohonan_konsumsi == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                    <option value="ya" {{ $surat->permohonan_konsumsi == 'ya' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Penyelenggaraan</label>
                                <div class="d-flex gap-2">
                                    <input type="date" class="form-control" id="penyelenggaraan_mulai" name="penyelenggaraan_mulai" value="{{ $surat->penyelenggaraan_mulai }}" required />
                                    <span class="align-self-center">s.d</span>
                                    <input type="date" class="form-control" id="penyelenggaraan_selesai" name="penyelenggaraan_selesai" value="{{ $surat->penyelenggaraan_selesai }}" required />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Klasifikasi</label>
                                <select class="form-select" id="klasifikasi_id" name="klasifikasi_id" required>
                                    <option value="" disabled>Pilih Klasifikasi</option>
                                    @foreach($klasifikasi as $item)
                                        <option value="{{ $item->id }}" {{ $surat->klasifikasi_id == $item->id ? 'selected' : '' }}>{{ $item->nama_klasifikasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Unggah Template Surat</label>
                                <input type="file" class="form-control" id="template_surat" name="template_surat" />
                                @if ($surat->template_surat)
                                    <p class="mt-2">File sebelumnya: <a href="{{ asset('storage/' . $surat->template_surat) }}" target="_blank">Lihat file</a></p>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.undangan.undangan') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{asset('sneat')}}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{asset('sneat')}}/assets/vendor/js/bootstrap.js"></script>
  </body>
</html>
