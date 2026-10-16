<?php
// Escapa todo dato antes de insertarlo en HTML, incluidos los valores de formularios.
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
// La búsqueda combina texto, material y alcaldía sobre el directorio en memoria.
function filtrarPuntos(array $puntos, string $q, string $material, string $alcaldia): array {
    return array_values(array_filter($puntos, function ($p) use ($q, $material, $alcaldia) {
        return ($q === '' || stripos($p['nombre'].' '.$p['alcaldia'].' '.implode(' ', $p['materiales']), $q) !== false)
            && ($material === '' || in_array($material, $p['materiales'], true))
            && ($alcaldia === '' || $alcaldia === $p['alcaldia']);
    }));
}
// Las listas permitidas evitan aceptar opciones inventadas desde el navegador.
function validarAportacion(array $datos, array $materiales): array {
    $errores = [];
    if (strlen($datos['nombre']) < 2 || strlen($datos['nombre']) > 80) $errores['nombre'] = 'Escribe un nombre de 2 a 80 caracteres.';
    if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL) || strlen($datos['email']) > 160) $errores['email'] = 'Escribe un correo electrónico válido.';
    if (!in_array($datos['material'], $materiales, true)) $errores['material'] = 'Selecciona un material de la lista.';
    if (strlen($datos['mensaje']) < 20 || strlen($datos['mensaje']) > 1500) $errores['mensaje'] = 'Tu experiencia debe tener entre 20 y 1,500 caracteres.';
    return $errores;
}
