@echo off
:: sass.bat - Versao Windows do comando make sass

echo Executando compilador SASS...
docker exec MVC sass --poll --quiet-deps --watch Lyrics/public/scss/main.scss:Lyrics/public/css/style.css