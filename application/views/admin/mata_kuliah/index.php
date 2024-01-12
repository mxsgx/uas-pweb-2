<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Kelola
                </div>
                <h2 class="page-title">
                    Data Mata Kuliah
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#create-modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Mata kuliah baru
                    </a>
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
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($mata_kuliah) > 0) { ?>
                                <?php foreach ($mata_kuliah as $model) { ?>
                                    <tr>
                                        <td data-label="Mata Kuliah">
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium"><?= $model->nama ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="<?= base_url("/admin/mata_kuliah/edit/{$model->id}") ?>" class="btn">
                                                    Ubah
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Kelola
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <a class="dropdown-item" href="<?= base_url("/admin/mata_kuliah/delete/{$model->id}") ?>">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="2" class="text-center">Mata kuliah kosong</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="create-modal" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url('/admin/mata_kuliah/create') ?>" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah mata kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <label class="form-label" for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>