<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="container mt-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo session('success'); ?></div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo session('error'); ?></div>
        <?php endif; ?>

        <h2>Edit Data Pegawai</h2>
        <form action="/pegawai/<?php echo $pegawai->id; ?>" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?php echo htmlspecialchars($pegawai->nip); ?>" readonly>
            </div>

            <!-- <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="hidden" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo htmlspecialchars($pegawai->nip); ?>" readonly>
            </div> -->
            
            <!-- Field lainnya sama seperti create.php, tapi dengan value -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($pegawai->nama); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L" <?php echo $pegawai->jenis_kelamin == 'L' ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="jk_l">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P" <?php echo $pegawai->jenis_kelamin == 'P' ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="jk_p">Perempuan</label>
                    </div>
                </div>
            </div>
            
            <!-- Lanjutkan untuk field lainnya -->
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/pegawai" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>