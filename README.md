# ReciclaCDMX
Portal académico para explorar la separación de residuos y opciones de reciclaje en Ciudad de México. Incluye un directorio **de demostración**, materiales, guía y aportaciones simuladas.

## Versión
0.4.0 — cierre técnico de la Fase 1.

## Tecnologías
PHP 8.2, Astro 7.4, HTML5 y CSS3. Sin base de datos ni JavaScript obligatorio en el navegador. Las tipografías de Google Fonts son opcionales: si no hay conexión, se usa sans-serif.

## Requisitos
- XAMPP con Apache y PHP 8.2 o superior para ejecutar las páginas publicadas.
- Node.js 22.12 o superior y npm para recompilar Astro.
- Python 3 para ejecutar la verificación opcional.

## Ejecución
1. Conserva la carpeta `reciclaCDMX` dentro de `htdocs`.
2. Inicia Apache desde XAMPP.
3. Abre **http://localhost/reciclaCDMX/**.

Los PHP y estilos compilados están incluidos: **no hace falta instalar Node para visitar el portal**.

Para modificar la presentación:
```sh
npm ci
npm run build
```
La compilación de Astro crea archivos intermedios en `.build/`. `scripts/publish.mjs` los publica como `.php` en la raíz y convierte las referencias a CSS en rutas relativas para funcionar dentro de htdocs. Los datos se procesan en PHP en cada solicitud; Astro construye el documento y los estilos. `ob_start()` permite responder con HTTP 404 desde la vista de detalle.

`npm run dev` sirve únicamente para trabajar con Astro: no ejecuta PHP. La vista funcional se revisa siempre en Apache tras `npm run build`.

Alternativa sin Apache, desde esta carpeta:
```sh
/Applications/XAMPP/xamppfiles/bin/php -S 127.0.0.1:8080
```
Abre http://127.0.0.1:8080/.

## Estructura
- `src/pages/`: siete entradas Astro.
- `src/layouts/Layout.astro`: documento compartido.
- `src/styles/global.css`: diseño adaptable e ilustración CSS.
- `includes/nav.php`, `footer.php`: navegación y pie reutilizados con require.
- `includes/functions.php`: tres funciones propias (escape, búsqueda y validación).
- `includes/data.php`: arreglos de puntos, materiales, alcaldías y pasos.
- `includes/card.php`: tarjeta PHP reutilizable.
- `views/`: contenido y lógica PHP de cada pantalla.
- `*.php` y `_astro/`: salida lista para XAMPP; no editar manualmente los PHP de la raíz.
- `scripts/publish.mjs`: publicación local de la compilación.
- `tests/smoke.py`: comprobación HTTP de integración.
- `docs/`: matriz de requisitos y guía para elaborar el escrito académico.

## Funcionalidades actuales
- Inicio con tarjetas generadas mediante foreach.
- Directorio con filtros GET combinables y mensaje sin coincidencias.
- Detalle individual por identificador; devuelve 404 si no existe.
- Seis categorías de materiales con recomendaciones y enlaces al filtro.
- Guía de separación con cuatro pasos generados desde un arreglo.
- Participación mediante POST: nombre, correo, material y experiencia.
- Validación del servidor de campos obligatorios, longitudes, correo y material permitido; conserva los valores en caso de error.
- Escape de datos con htmlspecialchars en todas las salidas de formularios.
- Resumen de aportación validada sin almacenamiento ni publicación.
- Acerca del proyecto, alcance y roles conceptuales.
- Estilos adaptables, formularios etiquetados, foco visible y enlace para saltar al contenido.

## Estado
Primera fase funcional con **datos ficticios identificados como ejemplos**. No existe registro, autenticación, control de roles, moderación ni almacenamiento persistente. El formulario es una demostración y no envía correos. No se requiere CSRF para esta simulación sin acciones persistentes; deberá incorporarse junto con autenticación y escritura en la siguiente fase.

Para usar el directorio como servicio real se deben sustituir los ejemplos por fuentes oficiales, documentar sus fechas de verificación y confirmar condiciones de recepción.

## Verificación
Con Apache activo:
```sh
npm test
```
Para otro servidor:
```sh
RECICLA_URL=http://127.0.0.1:8080/ python3 tests/smoke.py
```
La prueba revisa las páginas y sus enlaces, CSS, filtros, ausencia de resultados, detalle inexistente, formularios válidos e inválidos, parámetros compuestos y escape frente a inyección HTML.

## Historial de versiones
El desarrollo se realizó como una implementación integrada. Esta tabla organiza los requisitos por etapas; no afirma que existieran entregas o commits históricos independientes.

| Versión | Cambios principales correspondientes a cada etapa |
|---------|--------------------------------------------------|
| 0.1.0 | Estructura HTML5/CSS3, navegación y presentación de las pantallas. |
| 0.2.0 | Datos PHP, variables, arreglos, foreach y condicionales. |
| 0.3.0 | Búsqueda GET, formulario POST y validación del servidor. |
| 0.4.0 | Tres funciones, includes compartidos, siete páginas y revisión de integración. |

## Entrega
Incluye código fuente, dependencias declaradas, PHP compilado y recursos. Excluye `node_modules/`, `.build/` y archivos temporales del ZIP. Para recompilar, usa `npm ci`.

El documento de análisis y conclusiones debe completarse con las ideas del alumno; `docs/guia-fase1.md` ofrece la estructura. El nombre del ZIP y del PDF depende del nombre del alumno y debe ajustarse antes de entregarlos.
