<?php use Src\Utils\Security; ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">Problema 6: Presupuesto Hospitalario</h3>
        </div>
        <div class="card-body">
            <form method="POST" class="mb-4">
                <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                <div class="mb-3">
                    <label for="presupuesto" class="form-label">Monto del Presupuesto Anual ($):</label>
                    <input type="number" step="0.01" id="presupuesto" name="presupuesto" class="form-control" placeholder="Ej. 500000" required>
                </div>
                <button type="submit" class="btn btn-info text-white">Distribuir Presupuesto</button>
            </form>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo Security::sanitize($error); ?></div>
            <?php endif; ?>

            <?php if (!empty($resultados)): ?>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Desglose de Distribución</h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ginecología (40%)
                                <span class="badge bg-primary rounded-pill">$<?php echo number_format($resultados['ginecologia'], 2); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Traumatología (35%)
                                <span class="badge bg-warning text-dark rounded-pill">$<?php echo number_format($resultados['traumatologia'], 2); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pediatría (25%)
                                <span class="badge bg-success rounded-pill">$<?php echo number_format($resultados['pediatria'], 2); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary fw-bold">
                                Total Asignado
                                <span>$<?php echo number_format($resultados['total'], 2); ?></span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-6 text-center">
                        <h4 class="mb-3">Grafica</h4>
                        <div style="max-width: 320px; margin: 0 auto;">
                            <canvas id="chartPresupuesto"></canvas>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('chartPresupuesto').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Ginecología (40%)', 'Traumatología (35%)', 'Pediatría (25%)'],
                            datasets: [{
                                data: [
                                    <?php echo isset($resultados['ginecologia']) ? (float)$resultados['ginecologia'] : 0; ?>, 
                                    <?php echo isset($resultados['traumatologia']) ? (float)$resultados['traumatologia'] : 0; ?>, 
                                    <?php echo isset($resultados['pediatria']) ? (float)$resultados['pediatria'] : 0; ?>
                                ],
                                backgroundColor: ['#0d6efd', '#ffc107', '#198754']
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        }
                    });
                </script>
            <?php endif; ?>
            
            <div class="mt-3">
                <a href="../index.php" class="btn btn-secondary">Volver al Menú</a>
            </div>
        </div>
    </div>
</div>