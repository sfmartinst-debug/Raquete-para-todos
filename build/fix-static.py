import os, re, sys

O = sys.argv[1]
# Prefixos absolutos de demos antigos. O export passa a usar caminho relativo,
# que funciona na raiz do GitHub Pages do projeto (/Raquete-para-todos/).
OLD_PAGES = (
    "https://jarvisbotgrok.github.io/raquete-demo-ed93b4a0",
    "http://jarvisbotgrok.github.io/raquete-demo-ed93b4a0",
    "https://jarvisbotgrok.github.io/raquete-para-todos-site",
    "http://jarvisbotgrok.github.io/raquete-para-todos-site",
)

for r, _, fs in os.walk(O):
    for f in fs:
        if not f.endswith((".html", ".css", ".js")):
            continue
        p = os.path.join(r, f)
        rel = os.path.relpath(O, r)
        pre = "./" if rel == "." else rel + "/"
        s = open(p, encoding="utf-8", errors="surrogateescape").read()
        o = s
        s = s.replace("http://127.0.0.1:8088/", pre).replace("http://127.0.0.1:8088", pre.rstrip("/") or ".")
        for old in OLD_PAGES:
            s = s.replace(old + "/", pre).replace(old, pre.rstrip("/") or ".")
        if f.endswith(".html"):
            s = re.sub(r'(href|src)="/(?!/)', lambda m: f'{m.group(1)}="{pre}', s)
            s = re.sub(
                r'(href|src)="((?:\.\./|\./)*[^":#?]*?)index\.html"',
                lambda m: f'{m.group(1)}="{m.group(2) or "./"}"',
                s,
            )
            if 'rel="icon"' not in s:
                s = s.replace("</head>", f'<link rel="icon" type="image/svg+xml" href="{pre}assets/logo.svg">\n</head>', 1)
        if s != o:
            open(p, "w", encoding="utf-8", errors="surrogateescape").write(s)
