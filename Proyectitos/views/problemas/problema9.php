<?php use Src\Utils\Security; ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Problema 9: Cálculo de Potencias (1 al 15)</h3>
        </div>
        <div class="card-body">
            <form method="POST" class="row g-3 align-items-center mb-4">
                <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                <div class="col-auto">
                    <label for="base" class="col-form-label">Ingrese una base (1 al 9):</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="base" name="base" min="1" max="9" class="form-control" value="<?php echo isset($base) && $base !== null ? Security::sanitize($base) : ''; ?>" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark">Calcular Potencias</button>
                </div>
            </form>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo Security::sanitize($error); ?></div>
            <?php endif; ?>

            <?php if (!empty($potencias)): ?>
                <h4 class="mb-3">Primeras 15 potencias de la base: <?php echo Security::sanitize($base ?? ''); ?></h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover border">
                        <thead class="table-dark">
                            <tr>
                                <th>Exponente</th>
                                <th>Operación</th>
                                <th>Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($potencias as $exp => $resultado): ?>
                                <tr>
                                    <td><strong>^<?php echo $exp; ?></strong></td>
                                    <td><?php echo Security::sanitize($base ?? '') . " <sup>" . $exp . "</sup>"; ?></td>
                                    <td><?php echo number_format($resultado); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <a href="../index.php" class="btn btn-secondary">Volver al Menú</a>
        </div>
    </div>
</div>