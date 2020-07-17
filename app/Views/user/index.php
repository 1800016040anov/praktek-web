<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/User/create" class="btn btn-primary mt-3">Tambah User</a>
            <h1 class="mt-2">daftar mahluk hidup</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User ID </th>
                        <th scope="col">nama</th>
                        <th scope="col">email</th>
                        <th scope="col">action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($user as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $k['user_id']; ?></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['email']; ?></td>
                            <td><a href="/User/edit/<?= $k['slug']; ?>" class="btn btn-dark"> Edit </a>
                                <form action="/User/<?= $k['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('yakin mau delete?')">Delete</button>

                                </form>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>