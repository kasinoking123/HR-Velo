<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo session('success'); ?></div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo session('error'); ?></div>
        <?php endif; ?>
        <h2>Daftar Pegawai</h2>
        <a href="/pegawai/create" class="btn btn-primary mb-3">Tambah Pegawai</a>
        
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pegawais as $pegawai): ?>
                <tr>
                    <td><?php echo htmlspecialchars($pegawai->nip); ?></td>
                    <td><?php echo htmlspecialchars($pegawai->nama); ?></td>
                    <td><?php echo htmlspecialchars($pegawai->jabatan); ?></td>
                    <td><?php echo htmlspecialchars($pegawai->departemen); ?></td>
                    <td>
                        <a href="/pegawai/<?php echo $pegawai->id; ?>" class="btn btn-info btn-sm">Lihat</a>
                        <a href="/pegawai/<?php echo $pegawai->id; ?>/edit" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/pegawai/<?php echo $pegawai->id; ?>" method="POST" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>