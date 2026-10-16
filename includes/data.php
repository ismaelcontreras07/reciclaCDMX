<?php
// Datos ilustrativos de la Fase 1: no representan centros ni horarios verificados.
$materiales = ['Papel y cartón', 'Plásticos', 'Vidrio', 'Metales', 'Electrónicos', 'Pilas'];
$alcaldias = ['Cuauhtémoc', 'Benito Juárez', 'Coyoacán', 'Miguel Hidalgo'];
$puntos = [
 ['id'=>1,'nombre'=>'Punto Verde Roma','alcaldia'=>'Cuauhtémoc','zona'=>'Zona Roma Norte','tipo'=>'Punto de acopio','horario'=>'Sábados · 09:00 a 14:00','materiales'=>['Papel y cartón','Plásticos','Vidrio'],'icono'=>'↗','color'=>'mint'],
 ['id'=>2,'nombre'=>'Circular Del Valle','alcaldia'=>'Benito Juárez','zona'=>'Zona Del Valle','tipo'=>'Centro de reciclaje','horario'=>'Lunes a viernes · 10:00 a 17:00','materiales'=>['Papel y cartón','Metales','Plásticos'],'icono'=>'♧','color'=>'peach'],
 ['id'=>3,'nombre'=>'Reúso Coyoacán','alcaldia'=>'Coyoacán','zona'=>'Zona del centro de Coyoacán','tipo'=>'Jornada comunitaria','horario'=>'Primer domingo del mes · 10:00 a 14:00','materiales'=>['Electrónicos','Pilas','Metales'],'icono'=>'⌁','color'=>'lavender'],
 ['id'=>4,'nombre'=>'Estación Polanco','alcaldia'=>'Miguel Hidalgo','zona'=>'Zona Polanco','tipo'=>'Punto de acopio','horario'=>'Martes y jueves · 09:00 a 15:00','materiales'=>['Vidrio','Plásticos','Papel y cartón'],'icono'=>'↻','color'=>'yellow']
];
$pasos = ['Separa por material'=>'Evita mezclar los reciclables con residuos sanitarios o restos de comida.', 'Vacía y limpia'=>'Retira los restos de alimentos y deja secar los envases antes de guardarlos.', 'Reduce el volumen'=>'Aplana las cajas y compacta los envases cuando sea posible.', 'Confirma y entrega'=>'Consulta las condiciones del centro antes de llevar tus materiales.'];
