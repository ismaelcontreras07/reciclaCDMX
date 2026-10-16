"""Pruebas de integración sobre Apache/XAMPP, sin dependencias externas."""
import os, re, urllib.request, urllib.parse, urllib.error
BASE = os.environ.get('RECICLA_URL', 'http://localhost/reciclaCDMX/')
checks = 0
def request(path, data=None):
    global checks
    payload = urllib.parse.urlencode(data).encode() if data is not None else None
    try:
        with urllib.request.urlopen(BASE+path, payload) as r:
            status, html = r.status, r.read().decode()
    except urllib.error.HTTPError as err:
        status, html = err.code, err.read().decode()
    assert not re.search(r'(Warning:|Fatal error:|Parse error:|Notice:)', html), path
    checks += 1
    return status, html
for page in ['index','directorio','materiales','guia','participar','acerca']:
    status, html = request(page+'.php')
    assert status == 200 and '<main' in html and '<footer' in html
    for link in re.findall(r'href="([^"#]+)"', html):
        if not link.startswith(('http','mailto:')):
            assert request(link)[0] == 200, link
assert '1 punto encontrado' in request('directorio.php?material=Pilas')[1]
assert 'No encontramos coincidencias' in request('directorio.php?q=zzzzzz')[1]
assert '1 punto encontrado' in request('directorio.php?'+urllib.parse.urlencode({'q':'Roma','material':'Vidrio','alcaldia':'Cuauhtémoc'}))[1]
assert 'No encontramos coincidencias' in request('directorio.php?material=Inventado')[1]
assert request('detalle.php?id=999')[0] == 404
assert request('detalle.php?id[]=1')[0] == 404
assert request('directorio.php?q[]=x')[0] == 200
assert 'Revisa tu aportación' in request('participar.php', {})[1]
valid = {'nombre':'Persona de prueba','email':'prueba@example.com','material':'Pilas','mensaje':'Separé mis pilas y aprendí a mantenerlas en un recipiente seco.'}
assert 'Aportación validada' in request('participar.php', valid)[1]
invalid = dict(valid, email='incorrecto', material='Inventado', mensaje='corto')
assert 'Aportación validada' not in request('participar.php',invalid)[1]
xss = dict(valid, nombre='<script>alert(1)</script>', mensaje='<img src=x onerror=alert(1)> Una experiencia válida.')
html = request('participar.php', xss)[1]
assert '<script>alert(1)</script>' not in html and '&lt;script&gt;' in html
assert '<img src=x' not in html and '&lt;img' in html
assert request('participar.php',{'nombre[]':'x'})[0] == 200
html = request('directorio.php?'+urllib.parse.urlencode({'q':'"><script>alert(1)</script>'}))[1]
assert '<script>' not in html
print(f'OK: {checks} solicitudes; páginas, enlaces, recursos, GET, POST, 404 y escape HTML verificados.')
