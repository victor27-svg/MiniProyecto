# Universidad Tecnológica de Panamá
### Facultad de Ingeniería de Sistemas Computacionales
### Licenciatura en Desarrollo de Software / Ingeniería de Software

---

##  Información del Proyecto y Entrega

* **Curso:** [Desarrollo de Software VII]
* **Fecha de Realización:** Junio de 2026
* **Estudiantes:**
  * Victor Rivas
  * Maryennis Deans
  * Eric De León

---

## 📝 Introducción
El vertiginoso desarrollo de ecosistemas web modernos exige soluciones que no solo resuelvan problemas de lógica de negocio, sino que garanticen la escalabilidad del código y la seguridad de la información. Este proyecto académico presenta una plataforma web centralizada orientada al procesamiento seguro de módulos lógico-matemáticos y de gestión demográfica y financiera. 

El sistema ha sido diseñado adoptando la arquitectura arquitectónica **Modelo-Vista-Controlador (MVC)**, el estándar de diseño **DRY (Don't Repeat Yourself)** y las directrices globales de mitigación de vulnerabilidades de **OWASP**. El principal objetivo es demostrar la viabilidad de acoplar una interfaz dinámica (utilizando JavaScript del lado del cliente) con un motor de backend robusto en **PHP 8+** capaz de validar, sanitizar y computar datos de manera infalible.

---

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP 8+ (Programación Orientada a Objetos, Control de Espacios de Nombres y Autocarga).
* **Frontend:** HTML5 semántico, CSS3 para el diseño de interfaces responsivas y JavaScript (ES6) para la manipulación dinámica del DOM y validaciones perimetrales en los navegadores de los usuarios.
* **Estándares del Entorno:** **PSR-4** para la carga automática de clases en el servidor y arquitecturas limpias de enrutamiento web.

---

## 🏛️ Fundamentos de Programación (POO y Métodos Estáticos)

El núcleo de la aplicación se fundamenta firmemente en la **Programación Orientada a Objetos (POO)**. Para optimizar el rendimiento y la gestión de recursos del servidor, se ha evitado la instanciación innecesaria de objetos a través del operador `new`. En su lugar, el sistema explota el uso de **Métodos Estáticos** mediante el operador de resolución de ámbito (`::`).

Las ventajas técnicas implementadas son:
1. **Cohesión:** Clases como `Utilidades` y `Security` actúan como cajas de herramientas globales organizadas bajo su propio espacio de nombres (`namespace Src\Utils`).
2. **Eficiencia en Memoria:** Los métodos estáticos permiten invocar lógica algorítmica y defensiva de forma directa (Ej: `Security::hashPassword()`), eliminando la sobrecarga que produce la creación y destrucción constante de objetos en el ciclo de vida de la petición HTTP.

---

##  Documentación de Funciones Matemáticas

Para resolver los problemas lógico-matemáticos de la plataforma (tales como estadísticas descriptivas, distribución presupuestaria y cálculo de potencias), se implementó una capa de abstracción en el backend que aprovecha funciones nativas de PHP y formulaciones estructuradas:

* **`sqrt($num)` (Raíz Cuadrada):** Utilizada de forma crítica en el módulo de Estadísticas Descriptivas para calcular la **desviación estándar muestral**. Tras calcular la varianza dividiendo la suma de cuadrados entre $N-1$, se aplica `sqrt` para obtener la dispersión en las unidades originales.
* **`pow($base, $exp)` / Operador `**` (Potenciación):** Implementado en el generador de la Tabla de Potencias y en el cálculo de varianzas para elevar las diferencias respecto a la media aritmética al cuadrado. Asegura una precisión flotante óptima.
* **`number_format($monto, 2, '.', ',')`:** Utilizada en los módulos financieros (como la distribución del capital hospitalario) para formatear variables numéricas brutas en cadenas legibles con delimitadores decimales y de miles bajo estándares contables.

---

##  Funciones de Validación y Sanitización (Estándar OWASP)

Para proteger el sistema contra la manipulación maliciosa de datos y asegurar el cumplimiento de las normativas de seguridad web, se desarrollaron componentes dedicados exclusivamente a la defensa perimetral:

### 1. Funciones de Sanitización (Prevención de XSS - OWASP Top 10)
* **`htmlspecialchars($string, ENT_QUOTES, 'UTF-8')`:** Integrada de forma transversal en los métodos de salida. Convierte caracteres especiales en entidades HTML, neutralizando cualquier intento de inyección de scripts maliciosos (**Cross-Site Scripting**) si un atacante intenta ingresar código javascript en los formularios.

### 2. Funciones de Validación (Defensa contra Inyecciones de Parámetros)
* **`filter_var($dato, FILTER_VALIDATE_INT)` / `FILTER_VALIDATE_FLOAT`:** Rechaza de inmediato cualquier entrada que no corresponda al tipo de dato estrictamente esperado por la lógica del negocio.
* **Validación por Listas Blancas y Rangos:** Métodos encapsulados en el servidor que evalúan que los números provistos cumplan límites de frontera (ej. notas estrictamente entre `0` y `100`, o bases numéricas restringidas del `1` al `9`). Si los parámetros son alterados desde el inspector web, el servidor detecta la anomalía y detiene el proceso.

### 3. Mitigación de Falsificación de Peticiones en Sitios Cruzados (CSRF)
* **`hash_equals($_SESSION['csrf_token'], $tokenPost)`:** Compara en tiempo constante hashes criptográficos generados aleatoriamente en el backend contra los inputs ocultos de los formularios, garantizando la legitimidad de las peticiones `POST`.

---

##  Estructura de Archivos del Proyecto

La arquitectura se encuentra distribuida fielmente conforme al árbol de directorios del entorno de desarrollo:

```text
├── core/
│   └── Autoloader.php        # Mecanismo de carga automática de clases (PSR-4)
├── src/
│   ├── Controllers/
│   │   ├── problema5.js      # Validaciones y dinámicas del lado del cliente
│   │   ├── problema7.js      # Control de inputs dinámicos para el gestor de notas
│   │   └── Problemas.php     # Controlador principal (Lógica y seguridad de módulos)
│   └── Utils/
│       ├── Security.php      # Filtros perimetrales y funciones criptográficas OWASP
│       └── Utilidades.php    # Clase utilitaria estática (formatos, NVL, matemáticas)
├── views/
│   ├── layouts/              # Componentes visuales globales compartidos
│   │   └── footer.php        # Pie de página común de la plataforma
│   ├── problemas/            # Directorio de interfaces individuales (Vistas 1 al 9)
│   └── inicio.php            # Vista de la página de inicio / Menú principal
├── estilos.css               # Diseño y estilos visuales globales del ecosistema
├── index.php                 # Enrutador principal y Front Controller del sistema
└── Problemas.php             # Script de control en la raíz del proyecto
