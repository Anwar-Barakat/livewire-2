<div>
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div><!-- /.container-fluid -->
    </section>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Website Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" wire:submit.prevent="updateSettings">
                <div class="card-body">
                    <div class="form-group">
                        <label for="siteName">Site Name</label>
                        <input wire:model.defer="state.site_name" type="text" class="form-control" id="siteName"
                            placeholder="Enter Site Name">
                    </div>
                    <div class="form-group">
                        <label for="siteEmail">Site Email</label>
                        <input wire:model.defer="state.site_email" type="email" class="form-control" id="siteEmail"
                            placeholder="Enter Site Email">
                    </div>
                    <div class="form-group">
                        <label for="siteTitle">Site Title</label>
                        <input wire:model.defer="state.site_title" type="text" class="form-control" id="siteTitle"
                            placeholder="Enter Site Title">
                    </div>
                    <div class="form-group">
                        <label for="footer">Footer</label>
                        <input wire:model.defer="state.footer" type="text" class="form-control" id="footer"
                            placeholder="Enter Footer Text">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input wire:model.defer="state.sidebar_coll" type="checkbox" class="custom-control-input"
                                id="sitebar_collapse">
                            <label class="custom-control-label" for="sitebar_collapse">Side Bar Collapse</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#sitebar_collapse').on('change', () => {
            $('body').toggleClass('sidebar-collapse');
        });
    </script>
@endpush
