<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="" class="navbar-brand navbar-brand-autodark">
                <h2><?= $page_title ?? 'SIM RPS' ?></h2>
            </a>
        </div>
        
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Selamat datang</h2>

                <?php if (isset($system_notifications)) { ?>
                    <?php foreach ($system_notifications as $notification) { ?>
                        <div class="alert alert-<?= $notification['type'] ?> alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <?php if ($notification['type'] == 'success') { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                                    <?php } elseif ($notification['type'] == 'danger') { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                                    <?php } ?>
                                </div>
                                <div>
                                    <h4 class="alert-title"><?= $notification['title'] ?></h4>
                                    <div class="text-secondary"><?= $notification['message'] ?></div>
                                </div>
                                <div>
                                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <form action="<?= base_url('/auth/login') ?>" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat surel</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="your@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata sandi</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="your@email.com" required>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>