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
                    RPS Baru
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="<?= base_url('/admin/rps') ?>" class="btn">
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
                <form action="<?= base_url('/admin/rps/create') ?>" method="post" class="card" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row row-cards mb-3">
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="kode">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" placeholder="DT170">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="sks">SKS</label>
                                    <input type="number" class="form-control" id="sks" name="sks" placeholder="2">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="program_studi_id">Program Studi</label>
                            <select type="text" name="program_studi_id" id="program_studi_id" class="form-select">
                                <?php foreach ($program_studi as $model) { ?>
                                    <option value="<?= $model->id ?>"><?= $model->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mata_kuliah_id">Mata Kuliah</label>
                            <select type="text" name="mata_kuliah_id" id="mata_kuliah_id" class="form-select">
                                <?php foreach ($mata_kuliah as $model) { ?>
                                    <option value="<?= $model->id ?>"><?= $model->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="file">Dokumen</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".pdf">
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

<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/libs/tom-select/dist/js/tom-select.base.min.js" defer></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
    	var el;
    	window.TomSelect && (new TomSelect(el = document.getElementById('mata_kuliah_id'), {
    		copyClassesToDropdown: false,
    		dropdownParent: 'body',
    		controlInput: '<input>',
    		render:{
    			item: function(data,escape) {
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    			option: function(data,escape){
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    	    },
    	}));

        window.TomSelect && (new TomSelect(el = document.getElementById('program_studi_id'), {
    		copyClassesToDropdown: false,
    		dropdownParent: 'body',
    		controlInput: '<input>',
    		render:{
    			item: function(data,escape) {
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    			option: function(data,escape){
    				if( data.customProperties ){
    					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    		},
    	}));
    });
</script>