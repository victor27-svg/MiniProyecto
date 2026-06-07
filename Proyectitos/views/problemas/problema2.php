<?php use Src\Utils\Security; ?>
<div class="container my-5">
    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient bg-success text-white text-center py-4">
            <h2 class="fw-bold mb-1">Problema #2</h2>
            <p class="mb-0 opacity-75">Calculadora de Sumas Acumulativas por Rango</p>
        </div>

        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <h4 class="text-dark fw-bold mb-3">Entrada de Rangos</h4>
                        <p class="text-muted small">Ingrese los límites numéricos. Puede introducir desde <strong>1</strong> hasta <strong>1000</strong>.</p>

                        <form method="POST">
                            <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary">Número Inicial:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="inicio" value="<?php echo isset($_POST['inicio']) ? Security::sanitize($_POST['inicio']) : ''; ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary">Número Final:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="fin" value="<?php echo isset($_POST['fin']) ? Security::sanitize($_POST['fin']) : ''; ?>" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100 py-2 fw-bold mt-2">Calcular Sumatoria</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-7">
                    <?php if (!empty($csrfError)): ?>
                        <div class="alert alert-danger"><?php echo Security::sanitize($csrfError); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($errorValidacion)): ?>
                        <div class="alert alert-danger d-flex align-items-center rounded-4 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle-fill fs-3 me-3"></i>
                            <div><strong>Error de Validación:</strong> Asegúrese de ingresar números enteros positivos y que el número final sea mayor o igual al número inicial.</div>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($resultadoFinal) && $resultadoFinal !== null): ?>
                        <div class="p-4 bg-white border rounded-4 shadow-sm text-center">
                            <span class="badge bg-success text-white px-4 py-1.5 rounded-pill mb-3 fw-bold">SUMATORIA CALCULADA</span>
                            <p class="text-muted small">Resultado acumulado desde el número <strong><?php echo Security::sanitize($numInicio ?? ''); ?></strong> hasta el <strong><?php echo Security::sanitize($numFin ?? ''); ?></strong>:</p>
                            <span class="text-success display-2 fw-bold d-block mb-3"><?php echo number_format((float)($resultadoFinal ?? 0)); ?></span>
                        </div>
                    <?php else: ?>
                        <div class="text-center p-5 border border-dashed rounded-4 bg-white d-flex flex-column justify-content-center align-items-center">
                            <h5 class="text-secondary fw-bold">Panel de Resultados</h5>
                            <p class="text-muted small px-4 mb-0">Ingrese los límites en las cajitas de la izquierda para activar el motor de sumas en tiempo real.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-3">
                <a href="../index.php" class="btn btn-secondary">Volver al Menú</a>
            </div>
        </div>
    </div>
</div>
