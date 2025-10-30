<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Halaman Sukses -->
                <div id="successPage" class="card shadow">
                    <div class="card-body text-center p-5">
                        <i class="bi bi-check-circle-fill text-success display-1 mb-4"></i>
                        <h2 class="card-title text-success mb-3">Transaksi Berhasil!</h2>
                        <p>Order ID: {{ $order_id }}</p>
                        <p>Status: {{ $status }}</p>
                        <p class="card-text text-muted">
                            Terima kasih telah melakukan transaksi. <br>
                            Nomor referensi: <strong>TRX123456789</strong>
                        </p>
                        <a href="/riwayat" class="btn btn-success mt-4">Lihat Riwayat Ngamal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
