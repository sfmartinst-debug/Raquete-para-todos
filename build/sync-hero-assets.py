#!/usr/bin/env python3
"""Copia o CSS/JS do hero do tema para o export estático."""
import shutil
from pathlib import Path

root = Path(__file__).resolve().parents[1]
src = root / "theme" / "raquete-child" / "assets"
dst = root / "static" / "wp-content" / "themes" / "raquete-child" / "assets"
for name in ("iris-hero-fotos.css", "iris-hero-fotos.js"):
    shutil.copy2(src / name, dst / name)
style_src = root / "theme" / "raquete-child" / "style.css"
style_dst = root / "static" / "wp-content" / "themes" / "raquete-child" / "style.css"
if style_src.exists() and style_dst.exists():
    shutil.copy2(style_src, style_dst)
