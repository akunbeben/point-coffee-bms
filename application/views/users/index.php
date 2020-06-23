<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Users</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="float-left">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="<?= base_url('users/add')?>"><i class="fas fa-plus"></i> Create User</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Toko</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->kodetoko . ' - ' . $user->nama_toko; ?></td>
                        <td class="text-center" style="max-width: 50px;">
                            <a class="btn btn-warning btn-sm" href="<?= base_url('users/edit/') . $user->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-danger btn-sm" href="<?= base_url('users/hapus/') . $user->id; ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>