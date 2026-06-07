<?php use Src\Utils\Security; ?>
<link rel="stylesheet" href="../Problema7/problema7.css">
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">Problema 7: Notas Seguras</h3>
        </div>
        <div class="card-body">

            <form method="POST" onsubmit="return evitarFallosCantidad()" class="mb-4">
                <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Ingrese la cantidad de notas (2-50):</label>
                    <input type="number" id="cantidad" name="cantidad" min="2" max="50" 
                           class="form-control" required 
                           value="<?php echo htmlspecialchars($_POST['cantidad'] ?? ''); ?>">
                </div>
                <button type="submit" class="btn btn-success">Seleccionar Cantidad</button>
            </form>

            <?php if (!empty($campos)): ?>
            <div id="espacioCampos">
                <form method="POST" onsubmit="return evitarFallosNotas()">
                    <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">
                    <input type="hidden" name="totalNotas" value="<?php echo htmlspecialchars($cantidad ?? ''); ?>">
                    <?php echo $campos; ?>
                </form>
            </div>
            <?php endif; ?>

            <?php if (!empty($resultado ?? '')): ?>
                <div class="mt-3">
                    <?php echo $resultado ?? ''; ?>
                </div>
            <?php endif; ?>

            <div class="mt-3">
                <a href="../index.php" class="btn btn-secondary">Volver al Menú</a>
            </div>
        </div>
    </div>
</div>

<script src="../../Problema7/problema7.js"></script>