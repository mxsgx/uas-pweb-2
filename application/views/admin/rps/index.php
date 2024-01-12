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
                    Data RPS
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="<?= base_url('/admin/rps/create') ?>" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        RPS baru
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
                                <th>Kode</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($rps) > 0) { ?>
                                <?php foreach ($rps as $model) { ?>
                                    <tr>
                                        <td data-label="Kode">
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium"><?= $model->kode ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-secondary" data-label="Mata Kuliah">
                                            <?= $model->mata_kuliah()->nama ?>
                                        </td>
                                        <td class="text-secondary" data-label="SKS">
                                            <?= $model->sks ?>
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="<?= base_url("/admin/rps/edit/{$model->id}") ?>" class="btn">
                                                    Ubah
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Kelola
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <a class="dropdown-item" href="<?= base_url("/admin/rps/delete/{$model->id}") ?>">
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
                                    <td colspan="4" class="text-center">RPS kosong</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>