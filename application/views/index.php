<div class="page">
	<div class="page-wrapper">
		<div class="page-header d-print-none">
			<div class="container-xl">
				<div class="row g-2 align-items-center">
					<div class="col">
						<!-- Page pre-title -->
						<div class="page-pretitle">
						Selamat Datang
						</div>
						<h2 class="page-title">
						SIM RPS
						</h2>
					</div>
					<!-- Page title actions -->
					<div class="col-auto ms-auto d-print-none">
						<div class="btn-list">
							<span class="d-inline">
								<a href="<?= base_url('/admin') ?>" class="btn">
									Kelola
								</a>
							</span>

							<a href="javascript:window.print();" class="btn btn-primary d-inline-block" onclick="event.preventDefault();window.print();">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
								Cetak
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="page-body">
			<div class="container-xl">
				<form class="d-print-none d-flex mb-3 gap-2" method="get" action="<?= base_url() ?>">
					<div class="form-floating">
						<select class="form-select" name="program_studi" id="program_studi" aria-label="Program studi">
							<option <?= !isset($_GET['program_studi']) || empty($_GET['program_studi']) ? 'selected' : ''?> value="">Filter program studi</option>
							<?php foreach ($program_studi as $model) { ?>
								<option value="<?= $model->id ?>" <?= isset($_GET['program_studi']) && $model->id == $_GET['program_studi'] ? 'selected' : '' ?>><?= $model->nama ?></option>
							<?php } ?>
						</select>
						<label for="program_studi">Program Studi</label>
					</div>
					<div class="d-flex align-items-center gap-2">
						<button type="submit" class="btn btn-primary">Filter</button>
						<button type="reset" class="btn">Reset</button>
					</div>
				</form>
				<div class="row row-cards">
					<div class="col-12">
						<div class="card">
							<div class="table-responsive">
								<table class="table table-vcenter card-table table-striped">
									<thead>
										<tr>
											<th>Kode</th>
											<th>Mata Kuliah</th>
											<th>SKS</th>
											<th class="d-print-none">Dokumen</th>
										</tr>
									</thead>
									<tbody>
										<?php if (isset($rps) && count($rps) > 0) { ?>
											<?php foreach ($rps as $model) { ?>
												<tr>
													<td><?= $model->kode ?></td>
													<td class="text-secondary"><?= $model->mata_kuliah()->nama ?></td>
													<td class="text-secondary"><?= $model->sks ?></td>
													<td class="text-secondary d-print-none">
														<a href="<?= base_url("public/{$model->dokumen}") ?>" class="text-reset">Unduh</a>
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
		</div>
	</div>
</div>