# Mini Proyecto #2: Ecosistema Web de Algoritmos Modulares y Seguros

# Integrantes
* **Victor Rivas
* **Eric De León
* **Maryennis Deans

## 📋 Descripción del Proyecto
Este proyecto consiste en el diseño y desarrollo de una plataforma web modular construida bajo la arquitectura **Modelo-Vista-Controlador (MVC)** en **PHP 8+**. El sistema centraliza la resolución de 9 problemas lógico-matemáticos y de gestión de datos, aplicando rigurosamente los estándares de codificación de la comunidad de PHP (**PSR-1 y PSR-4**), el principio de diseño **DRY (Don't Repeat Yourself)** y las directrices internacionales de seguridad estipuladas por **OWASP** para la mitigación de vulnerabilidades críticas en entornos web.

---

## 🏛️ Arquitectura y Estándares de Diseño

El ecosistema de software se ha estructurado siguiendo un desacoplamiento estricto de responsabilidades:

1. **Controladores (`Src\Controllers`)**: Gobernadores de la lógica de negocio. Interceptan las peticiones HTTP (`GET`/`POST`), invocan los mecanismos de defensa perimetral y delegan los resultados a las vistas.
2. **Vistas (`views/`)**: Capa de presentación visual pura en HTML5/CSS3. Tienen estrictamente prohibido realizar cálculos algorítmicos, validaciones numéricas o tareas de sanitización.
3. **Clases Utilitarias (`Src\Utils\Utilidades`)**: Caja de herramientas centralizada que expone métodos estáticos independientes mediante el operador de resolución de ámbito (`::`). Esto optimiza el consumo de memoria del servidor al evitar instanciaciones redundantes (`new`).
4. **Autocarga Dinámica (Autoloader)**: Implementación nativa orientada al estándar **PSR-4** para el mapeo automático de espacios de nombres (`namespaces`), eliminando la dependencia de `include` o `require` masivos en el código fuente.

---

## 🛡️ Implementación de Seguridad (Estándar OWASP)

Para blindar la aplicación frente a amenazas en entornos de producción, se implementaron de forma transversal los siguientes mecanismos en la capa utilitaria:

* **Mitigación de CSRF (Cross-Site Request Forgery - OWASP A01)**: Cada formulario dinámico genera un token criptográfico único y aleatorio del lado del servidor guardado en `$_SESSION`. Al procesar un `POST`, el método `Utilidades::validarCSRF()` intercepta y compara los hashes mediante `hash_equals()`. Si un tercero malicioso intenta falsificar la petición, el backend bloquea el proceso inmediatamente.
* **Prevención de XSS (Cross-Site Scripting - OWASP XSS)**: Todas las entradas del usuario pasan por `Utilidades::limpiarDato()`, utilizando `htmlspecialchars()` para neutralizar cualquier intento de inyección de scripts o etiquetas HTML dañinas en los navegadores de los clientes.
* **Validación de Tipos y Listas Blancas (OWASP A03 - Inyección)**: Se rechaza cualquier dato genérico. Se implementa `filter_var()` con banderas estrictas (`FILTER_VALIDATE_INT`, `FILTER_VALIDATE_FLOAT`), además de controles condicionales que aseguran que los rangos numéricos cumplan estrictamente con las reglas de negocio del problema (ej. bases restringidas exclusivamente del 1 al 9).
* **Defensa contra la Manipulación de Parámetros (OWASP A08 - Integridad)**: En interfaces de renderizado dinámico (como el gestor de notas), el sistema valida límites estrictos en el servidor (`min_range` / `max_range`) para evitar ataques de denegación de servicio (DoS) por inyección masiva de inputs HTML desde el inspector del navegador.

---

## 📂 Directorio de Módulos (Problemas Desarrollados)

La plataforma resuelve y documenta de forma segura los siguientes enunciados:

* **Problema 1: Estadísticas Descriptivas**: Captura un lote de 5 números reales positivos para computar el valor mínimo, máximo, promedio aritmético y la desviación estándar muestral ($N-1$).
* **Problema 2: Acumulador por Rangos**: Estructura iterativa `while` que procesa la suma consecutiva de un intervalo cerrado [$Inicio$, $Fin$] provisto dinámicamente por el usuario.
* **Problema 3: Generador de Múltiplos**: Ciclo `for` que fabrica un arreglo indexado con los primeros $N$ múltiplos de 4, evaluando la magnitud de la petición mediante un bloque condicional `switch(true)`.
* **Problema 4: Sumatoria de Paridad Cerrada**: Algoritmo automatizado en el servidor (*Caja Negra*) que calcula de manera independiente las sumas de los números pares e impares comprendidos estrictamente en el rango del 1 al 200.
* **Problema 5: Clasificador Demográfico**: Vector que recolecta edades y delega su procesamiento a abstracciones lógicas para categorizar de forma segura grupos humanos de 0 a 120 años.
* **Problema 6: Distribución de Capital Hospitalario**: Módulo financiero con sanitización regional (reemplazo de `,` por `.`) que divide un presupuesto general en Ginecología (40%), Traumatología (35%) y Pediatría (25%).
* **Problema 7: Gestor Dinámico de Notas**: Formulario multifase protegido que genera inputs en tiempo real y computa promedios académicos bajo estrictas validaciones de escala (0-100).
* **Problema 8: Analizador Cronológico**: Filtro que valida la existencia y coherencia de una fecha del calendario para determinar su estación astronómica correspondiente.
* **Problema 9: Tabla de Potencias**: Ciclo iterativo que calcula las primeras 15 potencias de una base entera restringida mediante una lista blanca estricta del 1 al 9. Implementa la lógica **NVL (Null Value Logic)** para neutralizar advertencias de variables no inicializadas.

---

## 🛠️ Requisitos e Instalación

### Requisitos del Sistema
* Servidor Local: **WampServer**, **XAMPP** o **Laragon**.
* Motor de PHP: Versión **8.0 o superior** (requerido para soporte de namespaces avanzados y funciones estrateficadas).
* Navegador Web moderno con soporte de cookies de sesión habilitado.

### Pasos para la Ejecución Local
1. Clone este repositorio dentro de la carpeta raíz de su servidor local (`www/` o `htdocs/`):
   ```bash
   git clone [https://github.com/tu-usuario/nombre-del-repositorio.git](https://github.com/tu-usuario/nombre-del-repositorio.git)


# ESTRUCTURA DE ARCHIVOS DEL PROYECTO.
`
├── index.php                 # Enrutador principal y Front Controller
├── src/
│   ├── Controllers/
│   │   └── Problemas.php     # Controlador principal (Módulos 1 al 9)
│   └── Utils/
│       └── Utilidades.php    # Clase Utilitaria Estática (OWASP, NVL, Cálculos)
├── views/
│   ├── layout/
│   │   ├── header.php        # Encabezado común del sistema
│   │   └── footer.php        # Pie de página externo común (Inyección dinámica de fecha)
│   └── problemas/
│       ├── problema1.php     # Interfaces de usuario limpias (Vistas)
│       ├── problema2.php
│       └── [...]             # Vistas consecutivas hasta problema9.php
└── README.md                 # Documentación técnica oficial del proyecto `
  
