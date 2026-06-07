<?php use Src\Utils\Security; ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h3 class="card-title mb-0">Problema 8: Estación del Año</h3>
        </div>
        <div class="card-body">
            

            <form method="POST" class="mb-4">
                <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                <div class="mb-3">
                    <label for="fecha" class="form-label">Seleccione una fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning">Consultar</button>
            </form>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo Security::sanitize($error); ?></div>
            <?php endif; ?>

            <?php if (!empty($estacion) && empty($error)): ?>
                <div class="alert alert-success">La estación es: <?php echo Security::sanitize($estacion); ?></div>
            <?php endif; ?>
            <div class="mt-3">
                <a href="../index.php" class="btn btn-secondary">Volver al Menú</a>
            </div>
        </div>
    </div>
</div>
