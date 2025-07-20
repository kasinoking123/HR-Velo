<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Detail Pegawai</h2>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($pegawai->nama); ?></h5>
                <p class="card-text">
                    <strong>NIP:</strong> <?php echo htmlspecialchars($pegawai->nip); ?><br>
                    <strong>Jenis Kelamin:</strong> <?php echo $pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?><br>
                    <strong>Tempat/Tanggal Lahir:</strong> <?php echo htmlspecialchars($pegawai->tempat_lahir); ?>, <?php echo date('d/m/Y', strtotime($pegawai->tanggal_lahir)); ?><br>
                    <strong>Jabatan:</strong> <?php echo htmlspecialchars($pegawai->jabatan); ?><br>
                    <strong>Departemen:</strong> <?php echo htmlspecialchars($pegawai->departemen); ?><br>
                    <strong>Tanggal Masuk:</strong> <?php echo date('d/m/Y', strtotime($pegawai->tanggal_masuk)); ?><br>
                    <strong>Email:</strong> <?php echo htmlspecialchars($pegawai->email); ?><br>
                    <strong>Telepon:</strong> <?php echo htmlspecialchars($pegawai->telepon); ?><br>
                    <strong>Alamat:</strong><br>
                    <?php echo nl2br(htmlspecialchars($pegawai->alamat)); ?>
                </p>
                
                <a href="/pegawai/<?php echo $pegawai->id; ?>/edit" class="btn btn-warning">Edit</a>
                <form action="/pegawai/<?php echo $pegawai->id; ?>" method="POST" style="display:inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
                <a href="/pegawai" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>