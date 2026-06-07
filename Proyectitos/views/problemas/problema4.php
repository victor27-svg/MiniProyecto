<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Problema 4: Suma de Pares e Impares (1 a 200)</h3>
        </div>
        <div class="card-body text-center">
            <p class="lead">Resultados del cálculo automático en el rango establecido:</p>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded">
                        <h4 class="text-success">NÚMEROS PARES</h4>
                        <p class="display-6 fw-bold"><?php echo number_format($sumaPares ?? 0); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light border rounded">
                        <h4 class="text-danger">NÚMEROS IMPARES</h4>
                        <p class="display-6 fw-bold"><?php echo number_format($sumaImpares ?? 0); ?></p>
                    </div>
                </div>
            </div>
            <a href="../index.php" class="btn btn-secondary mt-4">Volver al Menú</a>
        </div>
    </div>
</div>