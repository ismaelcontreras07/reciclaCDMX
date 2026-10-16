import { readdir, readFile, writeFile, cp } from 'node:fs/promises';
for (const file of await readdir('.build')) {
  if(file.endsWith('.html')) await writeFile(file.replace('.html','.php'), '<?php ob_start(); ?>' + (await readFile(`.build/${file}`, 'utf8')).replaceAll('href="/_astro/', 'href="./_astro/'));
  else if(file === '_astro') await cp('.build/_astro','_astro',{recursive:true});
}
console.log('Páginas PHP publicadas en la raíz de XAMPP.');
