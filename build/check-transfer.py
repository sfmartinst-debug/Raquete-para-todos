#!/usr/bin/env python3
"""Confere o export estático antes do GitHub Pages. Sai com erro se achar problema."""
import re
import sys
from pathlib import Path

root = Path(__file__).resolve().parents[1]
static = root / "static"
theme_assets = root / "theme" / "raquete-child" / "assets"
static_assets = static / "wp-content" / "themes" / "raquete-child" / "assets"
errors = []

for name in ("iris-hero-fotos.css", "iris-hero-fotos.js"):
    a = (theme_assets / name).read_bytes()
    b = (static_assets / name).read_bytes()
    if a != b:
        errors.append(f"{name} do tema e do static divergem")

robots = (static / "robots.txt").read_text(encoding="utf-8")
if "Disallow: /" not in robots:
    errors.append("robots.txt sem Disallow: /")

if not (static / ".nojekyll").exists():
    errors.append("static/.nojekyll ausente")

banned = (
    "jarvisbotgrok.github.io",
    "127.0.0.1",
    "wp-config",
    "BEGIN PRIVATE KEY",
    "BEGIN RSA PRIVATE KEY",
)
htmls = list(static.rglob("*.html"))
if len(htmls) < 16:
    errors.append(f"páginas HTML insuficientes: {len(htmls)}")

for p in htmls:
    text = p.read_text(encoding="utf-8", errors="replace")
    rel = p.relative_to(static)
    if "noindex" not in text or "nofollow" not in text:
        errors.append(f"{rel} sem noindex,nofollow")
    for word in banned:
        if word in text:
            errors.append(f"{rel} contém {word}")
    if re.search(r'(?:href|src)="/(?!/)', text):
        errors.append(f"{rel} ainda tem caminho absoluto na raiz do domínio")

home = (static / "index.html").read_text(encoding="utf-8")
if "<h1 class=\"wp-block-heading\">Projeto Raquete para Todos</h1>" not in home:
    errors.append("H1 da home diferente de Projeto Raquete para Todos")
for label in ("Foto anterior", "Próxima foto", "Pausar"):
    if f'aria-label="{label}"' not in home:
        errors.append(f"nome acessível ausente: {label}")
if 'class="rq-hero-fotos__dots" aria-hidden="true"' not in home:
    errors.append("pontos do hero sem aria-hidden=true")
if home.count("<svg class=\"rq-hero-fotos__icon\"") < 2:
    errors.append("setas SVG do hero ausentes")
if "‹" in home or "Ⅱ" in home:
    errors.append("ícone tipográfico preliminar ainda na home")
for caption in (
    "O professor Pedro Stucchi com alunos do Projeto Raquete para Todos.",
    "O professor Pedro Stucchi com Gustavo Kuerten (Guga).",
):
    if caption not in home:
        errors.append("legenda ausente: " + caption)

if errors:
    print("\n".join(errors))
    sys.exit(1)
print(f"ok: {len(htmls)} páginas, hero 05h, caminhos relativos, noindex, robots")
