<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Buat
                </div>
                <h2 class="page-title">
                    Pengguna Baru
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="<?= base_url('/admin/user') ?>" class="btn">
                            Kembali
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <form action="<?= base_url('/admin/user/create') ?>" method="post" class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="cth: Masga Satria Wirawan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Alamat surel</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="cth: masga@example.com" required>
                        </div>
                        <label class="form-label">Role</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-12">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="role" value="admin" class="form-selectgroup-input" checked="">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Admin</span>
                                            <span class="d-block text-secondary">Akses penuh pada semua fitur</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Kata sandi</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                            Buat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>