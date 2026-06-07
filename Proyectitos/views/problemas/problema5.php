<?php 
use Src\Utils\Security; 


if (!isset($edades)) {
    $edades = [];
}

if (!isset($estadistica)) {
    $estadistica = '';
}
?>

<link rel="stylesheet" href="../problema5.css">

<style>
    .kpi-card {
        background: linear-gradient(135deg, #3182ce, #2b6cb0);
        color: white;
        border: none;
        border-radius: 8px;
    }
    .kpi-card-alt {
        background: linear-gradient(135deg, #1a365d, #2a4365);
        color: white;
        border: none;
        border-radius: 8px;
    }
    .section-title {
        color: #2d3748;
        font-size: 1.1rem;
        font-weight: 700;
        border-left: 4px solid #3182ce;
        padding-left: 10px;
    }
    .frecuencia-item {
        background-color: #f7fafc;
        border-left: 4px solid #4299e1 !important;
        border-radius: 6px;
    }
    .custom-progress {
        height: 25px;
        background-color: #edf2f7;
        border-radius: 15px;
    }
    .custom-progress-bar {
        background-color: #2b6cb0;
        border-radius: 15px;
        font-weight: bold;
        padding-left: 15px;
        display: flex;
        align-items: center;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">Problema 5: Clasificación de Edades</h3>
        </div>

        <div class="card-body">
            <form method="POST" class="mb-4">
                <input type="hidden" name="csrf_token" value="<?php echo Security::sanitize($csrfToken ?? ''); ?>">

                <div class="row g-3">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="col-md-2 col-sm-4">
                            <label for="edad<?php echo $i; ?>" class="form-label">Edad <?php echo $i; ?></label>
                            <input type="number" id="edad<?php echo $i; ?>" name="edad<?php echo $i; ?>" min="0" max="120" class="form-control" required value="<?php echo htmlspecialchars($_POST["edad$i"] ?? ''); ?>">
                        </div>
                    <?php endfor; ?>
                </div>

                <button type="submit" class="btn btn-success mt-4">Calcular Estadísticas</button>
            </form>

            <?php if (!empty($csrfError)): ?>
                <div class="alert alert-danger"><?php echo Security::sanitize($csrfError); ?></div>
            <?php endif; ?>

            <?php if (!empty($estadistica) && strpos($estadistica, 'Error') !== false): ?>
                <div class="alert alert-danger"><?php echo Security::sanitize($estadistica); ?></div>
            <?php endif; ?>

            <?php 
            // Ahora la validación es 100% segura porque $edades siempre existe
            $mostrarDashboard = !empty($edades) && count($edades) === 5 && strpos($estadistica, 'Error') === false;

            if ($mostrarDashboard): 
                $totalPersonas = count($edades);
                $promedio = array_sum($edades) / $totalPersonas;
                $edadMaxima = max($edades);
                $edadMinima = min($edades);

                $frecuencias = array_count_values($edades);
                krsort($frecuencias);

                $rangos = ['Niños' => 0, 'Adolescentes' => 0, 'Adultos' => 0, 'Ancianos/Adultos Mayores' => 0];
                foreach ($edades as $edad) {
                    if ($edad >= 0 && $edad <= 12) {
                        $rangos['Niños']++;
                    } elseif ($edad >= 13 && $edad <= 17) {
                        $rangos['Adolescentes']++;
                    } elseif ($edad >= 18 && $edad <= 64) {
                        $rangos['Adultos']++;
                    } else {
                        $rangos['Ancianos/Adultos Mayores']++;
                    }
                }
            ?>
                <div class="border rounded p-4 bg-white shadow-sm mt-4">
                    <h2 class="text-center mb-4" style="color: #1a365d; font-weight: 700;">Resultados Estadísticos</h2>
                    
                    <div class="row g-3 mb-4 text-center">
                        <div class="col-md-3 col-sm-6">
                            <div class="card kpi-card p-3 shadow-sm">
                                <small class="text-uppercase font-weight-bold" style="font-size: 0.85rem;">Total Personas</small>
                                <h2 class="display-6 m-0 font-weight-bold"><?php echo $totalPersonas; ?></h2>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card kpi-card-alt p-3 shadow-sm">
                                <small class="text-uppercase font-weight-bold" style="font-size: 0.85rem;">Promedio</small>
                                <h2 class="display-6 m-0 font-weight-bold"><?php echo number_format($promedio, 1); ?></h2>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card kpi-card p-3 shadow-sm">
                                <small class="text-uppercase font-weight-bold" style="font-size: 0.85rem;">Edad Máxima</small>
                                <h2 class="display-6 m-0 font-weight-bold"><?php echo $edadMaxima; ?></h2>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card kpi-card-alt p-3 shadow-sm">
                                <small class="text-uppercase font-weight-bold" style="font-size: 0.85rem;">Edad Mínima</small>
                                <h2 class="display-6 m-0 font-weight-bold"><?php echo $edadMinima; ?></h2>
                            </div>
                        </div>
                    </div>

                    <h4 class="section-title mb-3">Frecuencia de Edades</h4>
                    <div class="d-flex flex-column gap-2 mb-4">
                        <?php foreach ($frecuencias as $edad => $cantidad): ?>
                            <div class="frecuencia-item d-flex justify-content-between align-items-center p-2 px-3 border border-light shadow-sm">
                                <span class="fw-semibold text-secondary">Edad <?php echo $edad; ?></span>
                                <span class="text-dark fw-bold"><?php echo $cantidad; ?> persona(s)</span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <h4 class="section-title mb-3">Gráfica por Rangos de Edad</h4>
                    <div class="row flex-column gap-3">
                        <?php foreach ($rangos as $rango => $cantidad): 
                            $porcentaje = ($totalPersonas > 0) ? ($cantidad / $totalPersonas) * 100 : 0;
                        ?>
                            <div class="col-12">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold text-dark" style="font-size: 0.95rem;"><?php echo $rango; ?> (<?php echo $cantidad; ?>)</span>
                                </div>
                                <div class="progress custom-progress">
                                    <div class="progress-bar custom-progress-bar" 
                                         role="progressbar" 
                                         style="width: <?php echo $porcentaje; ?>%;" 
                                         aria-valuenow="<?php echo $porcentaje; ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                         <?php if ($cantidad > 0): ?>
                                             <?php echo $cantidad; ?> persona(s)
                                         <?php else: ?>
                                             <span class="text-muted ms-2" style="font-weight: normal;">0</span>
                                         <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (strpos($estadistica, 'Error') === false && !empty($estadistica)): ?>
                     <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="mt-3">
                <a href="../index.php" class="btn btn-secondary mt-4">Volver al Menú</a>
            </div>
        </div>
    </div>
</div>