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
        @include('admin.layouts.sidebar')
        <div class="layout-page">
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4 text-center">Agenda Nomor Surat Undangan</h4>
              <div class="d-flex justify-content-center">
                <div class="col-md-8">
                  <div class="card shadow-sm">
                    <h5 class="card-header text-center">Form Agenda Surat</h5>
                    <div class="card-body">
                      <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" id="username" name="username" required />
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" id="email" name="email" required />
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <textarea class="form-control" id="password" name="password" rows="2" required></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                          <button type="reset" class="btn btn-secondary">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
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
