#!/bin/sh
# Exporta o WordPress local (127.0.0.1:8088) para ../static
# Este repositório não inclui WordPress, banco nem wp-config.
# Sem o ambiente local, o script para e preserva o static/ já versionado.
set -e
D=$(cd "$(dirname "$0")" && pwd)
ROOT=$(cd "$D/.." && pwd)
O="$ROOT/static"
TMP=$(mktemp -d)
cleanup() { rm -rf "$TMP"; }
trap cleanup EXIT
cd "$TMP"
B=http://127.0.0.1:8088
wget -q -e robots=off --mirror --page-requisites --convert-links --adjust-extension --no-host-directories \
  --reject-regex '(wp-json|xmlrpc|/feed/|\?p=|/wp-admin|/author/|/category/|/tag/|/comments/|wp-login|\?s=)' \
  $B/ $B/o-projeto/ $B/nossa-historia/ $B/atividades/ $B/tenis-sem-misterio/ $B/por-que-o-tenis-transforma/ \
  $B/eventos/ $B/apoie/ $B/perguntas-frequentes/ $B/blog/ $B/contato/ $B/privacidade/ \
  $B/wp-content/themes/raquete-child/assets/doc/apresentacao-raquete-para-todos.pdf
if [ ! -f "$TMP/index.html" ]; then
  echo "Export incompleto; static/ existente foi mantido." >&2
  exit 1
fi
rm -rf "$O"
mkdir -p "$O/assets"
cp -a "$TMP"/. "$O"/
cp "$ROOT/theme/raquete-child/assets/img/logo.svg" "$O/assets/logo.svg"
printf 'User-agent: *\nDisallow: /\n' > "$O/robots.txt"
python3 "$D/fix-static.py" "$O"
python3 "$D/sync-hero-assets.py"
: > "$O/.nojekyll"
