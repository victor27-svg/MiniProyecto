<?php use Src\Utils\Security; ?>
<div class="container my-5">
    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient bg-primary text-white text-center py-4">
            <h2 class="fw-bold mb-1">Problema #1</h2>
            <p class="mb-0 opacity-75">Calculadora de Media, Desviación Estándar, Mínimo y Máximo</p>
        </div>

        <div class="card-body p-5">
            <div class="row">
                <div class="col-xl-5 mb-4 mb-xl-0">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <h4 class="text-dark fw-bold mb-3">Entrada de Datos</h4>
                        <p class="text-muted small">Por favor, introduzca 5 números enteros o decimales positivos:</p>

                        <form method="POST">
                            <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold text-secondary">Número <?php echo $i; ?>:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="num[]" value="<?php echo isset($_POST['num'][$i-1]) ? Security::sanitize($_POST['num'][$i-1]) : ''; ?>" placeholder="Ej. 12.5" required>
                                    </div>
                                </div>
                            <?php endfor; ?>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mt-2">Procesar Estadísticas</button>
                        </form>
                    </div>
                </div>

                <div class="col-xl-7">
                    <?php if (!empty($csrfError)): ?>
                        <div class="alert alert-danger"><?php echo Security::sanitize($csrfError); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($errorValidacion)): ?>
                        <div class="alert alert-danger d-flex align-items-center rounded-4 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle-fill fs-3 me-3"></i>
                            <div><strong>Error de Validación:</strong> Todos los campos deben contener números positivos válidos (enteros o decimales). Evite usar letras o símbolos especiales.</div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($numerosValidados) && count($numerosValidados) === 5): ?>
                        <div class="p-4 bg-white border rounded-4 shadow-sm h-100">
                            <h4 class="text-success fw-bold mb-4">Métricas Consolidadas</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle bg-white mb-0">
                                    <thead class="table-dark text-center"><tr><th>Métrica Estadística</th><th>Valor Calculado</th></tr></thead>
                                    <tbody>
                                    <tr><td class="fw-semibold text-secondary">Media Muestral (x̄)</td><td class="text-center fw-bold fs-5 text-primary"><?php echo number_format((float)($media ?? 0), 4); ?></td></tr>
                                    <tr><td class="fw-semibold text-secondary">Desviación Estándar (s)</td><td class="text-center fw-bold fs-5 text-primary"><?php echo number_format((float)($desviacion ?? 0), 4); ?></td></tr>
                                    <tr><td class="fw-semibold text-secondary">Valor Mínimo</td><td class="text-center"><span class="badge bg-danger fs-6 px-3"><?php echo number_format((float)($minimo ?? 0), 2); ?></span></td></tr>
                                    <tr><td class="fw-semibold text-secondary">Valor Máximo</td><td class="text-center"><span class="badge bg-success fs-6 px-3"><?php echo number_format((float)($maximo ?? 0), 2); ?></span></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 p-3 bg-light rounded-3 border text-center">
                                <span class="text-muted small d-block mb-2 text-uppercase fw-bold">Muestra Evaluada</span>
                                <?php foreach ($numerosValidados as $num): ?>
                                    <span class="badge bg-secondary mx-1 fs-6 px-2.5 py-1.5"><?php echo Security::sanitize($num); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center p-5 border border-dashed rounded-4 bg-white h-100 d-flex flex-column justify-content-center align-items-center">
                            <h5 class="text-secondary fw-bold">Panel de Resultados</h5>
                            <p class="text-muted small px-4 mb-0">Ingrese los 5 valores numéricos en el formulario de la izquierda y presione el botón para ver los análisis en tiempo real.</p>
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
