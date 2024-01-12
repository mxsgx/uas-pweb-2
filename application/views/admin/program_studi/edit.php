<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Ubah
                </div>
                <h2 class="page-title">
                    Data Program Studi
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="<?= base_url('/admin/program_studi') ?>" class="btn">
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
                <form action="<?= base_url("/admin/program_studi/edit/{$program_studi->id}") ?>" method="post" class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="cth: D3 Teknik Informatika" required value="<?= $program_studi->nama ?>">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>