<?php use Src\Utils\Security; ?>
<div class="container my-5">
    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient text-white text-center py-4" style="background-color: #593196;">
            <h2 class="fw-bold mb-1">Problema #3</h2>
            <p class="mb-0 opacity-75">Generador Avanzado de Múltiplos de 4</p>
        </div>

        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="p-4 bg-white border rounded-4 shadow-sm">
                        <h4 class="text-dark fw-bold mb-3">Entrada por Teclado</h4>
                        <p class="text-muted small">Ingrese la cantidad de múltiplos de 4 (N) que desea calcular e imprimir en la tabla.</p>

                        <form method="POST">
                            <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary">Valor de N:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cantidad" value="<?php echo isset($_POST['cantidad']) ? Security::sanitize($_POST['cantidad']) : ''; ?>" required>
                                </div>
                            </div>
                            <button type="submit" class="btn text-white w-100 py-2 fw-bold" style="background-color: #593196;">Calcular Múltiplos</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-7">
                    <?php if (!empty($csrfError)): ?>
                        <div class="alert alert-danger"><?php echo Security::sanitize($csrfError); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger rounded-4 shadow-sm" role="alert">
                            <i class="bi bi-shield-slash-fill fs-3 me-3"></i>
                            <div><strong>Error:</strong> <?php echo Security::sanitize($error); ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($miArregloResultados)): ?>
                        <div class="p-4 bg-white border rounded-4 shadow-sm">
                            <div class="alert alert-info py-2 small mb-3"><strong>Evaluación Switch:</strong> <?php echo Security::sanitize($mensajeAnalisis ?? ''); ?></div>
                            <h4 class="fw-bold mb-3" style="color: #593196;">Resultados en Arreglo:</h4>
                            <div class="table-responsive"><table class="table table-striped table-hover text-center border align-middle">
                                <thead class="table-dark"><tr><th>Índice (Key)</th><th>Operación</th><th>Valor (Value)</th></tr></thead>
                                <tbody>
                                <?php foreach ($miArregloResultados as $posicion => $valorMultiplo): ?>
                                    <tr>
                                        <td><span class="badge bg-secondary"><?php echo Security::sanitize($posicion); ?></span></td>
                                        <td class="text-muted fw-semibold">4 &times; <?php echo Security::sanitize($posicion); ?></td>
                                        <td><span class="badge text-white fs-6 px-3 py-1.5" style="background-color: #593196;"><?php echo $valorMultiplo; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table></div>
                            <p class="text-success small mb-0 mt-3">Estructuras For, Foreach y While ejecutadas y auditadas con éxito.</p>
                        </div>
                    <?php else: ?>
                        <div class="text-center p-5 border border-dashed rounded-4 bg-white">
                            <p class="text-secondary mt-3 mb-0">Esperando que ingrese un valor de N para activar los arreglos y ciclos en tiempo real.</p>
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
