# ANVIL — Inventário técnico (entregável n.5 do manual mestre) — RASCUNHO
Ambiente: **LOCAL DE TESTE** na box · 31/10/2026 (horário de Brasília) · sem domínio, sem dados reais.

| Componente | Versão | Origem | Licença | Custo | Observação |
|---|---|---|---|---|---|
| WordPress (pt_BR) | 7.1.4 | wordpress.org (via wp-cli) | GPLv2+ | gratuito | |
| Tema pai Twenty Twenty-Five | 1.5 | wordpress.org | GPLv2+ | gratuito | |
| Tema filho raquete-child | 0.2.0 | criado pelo ANVIL | GPLv2+ | — | `site/wp-content/themes/raquete-child` |
| Plugin SQLite Database Integration | 3.1.2 (drop-in db.php 1.8.0) | wordpress.org | GPLv2+ | gratuito | só teste |
| Fontes Inter 400/600, Montserrat 700/800 | fontsource latest (woff2 latin) | Google Fonts/Fontsource, baixadas uma vez | SIL OFL 1.1 | gratuito | auto-hospedadas |
| PHP CLI | 8.4.23 (estático) | static-php-cli (dl.static-php.dev) | PHP License / MIT | gratuito | sem mysqli |
| SQLite | 3.45.2 | embutido no PHP | domínio público | gratuito | |
| WP-CLI | 2.12.0 | github.com/wp-cli/builds | MIT | gratuito | wrapper `bin/wpc` (memory_limit 512M) |
| Caddy | 2.11.7 | github.com/caddyserver | Apache-2.0 | gratuito | serve o export estático com basic auth em 127.0.0.1:8090 |
| cloudflared | 2026.10.7 | github.com/cloudflare | Apache-2.0 | gratuito | túnel **falhou** (rede bloqueia o edge) |
| localtunnel | 2.x (npm) | npm | MIT | gratuito | túnel **falhou** (502/503) |
| puppeteer-core + Google Chrome | 23 / 156 | npm / box | Apache-2.0 | gratuito | capturas e verificação de requisições |
| Node.js | 20.19.2 | box | MIT | — | |

## Caminhos
- Raiz: `/home/box/raquete-wp/` (`site/`, `bin/`, `static/`, `backups/` [chmod 700], `tools/`)
- Subir/parar o WP: `/home/box/raquete-wp/iniciar.sh` · `/home/box/raquete-wp/parar.sh`
- Credenciais do admin local: `anvil/.credenciais-local` (chmod 600) · acesso à prévia: `anvil/.acesso-preview` (chmod 600)

## Contas
- 1 administrador local com nome e senha aleatórios. Nenhuma conta real e nenhum e-mail real (`admin@example.invalid`).

---
## v1.1 — Enriquecimento de conteúdo (03/11/2026, 10:20, horário de Brasília)
Entradas: echo/textos-v2.md (v2.0), echo/textos-v1.md (Política de Privacidade de demonstração), iris/02-enriquecimento-visual.md, iris/svg/*.
Tema raquete-child 0.3.0 (style.css + assets/iris-linha-do-tempo.css da IRIS). Sem plugins novos e sem chamadas externas.

### Padrões de bloco (raquete-child/patterns, categoria "Raquete para Todos")
| Slug | Conteúdo | Usado em |
|---|---|---|
| raquete/como-funciona | 3 passos (ECHO v2) com ícones IRIS aulas/boletim/raquete | Início, O Projeto |
| raquete/linha-do-tempo | 9 marcos de 2007 a 2026, cada um com data e fonte (CSS .rpt-timeline da IRIS) | Nossa história |
| raquete/linha-do-tempo-eventos | Grand Slam 2024 e 24 Horas 2025 (Prefeitura) | Eventos |
| raquete/faq-familias / faq-completo | Acordeão core/details (details/summary nativos, foco visível, alvo ≥ 48 px) | Atividades / Perguntas frequentes |
| raquete/galeria | "Galeria do tênis" com 4 SVG da IRIS, sem pessoas | Início |
| raquete/por-que-apoiar | Faixa azul com 3 motivos, sem cotas nem valores | Início, Apoie |
| raquete/apresentacao-pdf | Botão de download do PDF | Apoie |
| raquete/mapa-clt | Mapa estático PNG local com "© colaboradores do OpenStreetMap" e link para a página de copyright | O Projeto, Contato |
| raquete/na-midia | 7 cards de citação: título entre aspas em texto normal, com veículo, data e link | Eventos |

### Ativos novos
- assets/img/iris/: hero-quadra, aulas, boletim, raquete, solidariedade e divisoria-quadra (autoria IRIS, SVG próprio). As ilustrações SVG provisórias do ANVIL foram removidas.
- assets/img/mapa-clt.png (720×420): recorte de 15 tiles do OpenStreetMap (z16, tile.openstreetmap.org), baixados uma vez em 03/11/2026 e servidos localmente. Coordenadas do Nominatim: way 154961503, -22.9562, -46.9829. Dados © colaboradores do OpenStreetMap (ODbL). O marcador é próprio.
- assets/doc/apresentacao-raquete-para-todos.pdf: 4 páginas A4, gerado pelo Chrome headless a partir dos textos ECHO v2 com as fontes locais. Não traz cotas, valores, autor nem e-mail. Metadados: Title = projeto e Creator = "Raquete para Todos" (o user-agent foi removido).
- Movimento: flutuação do hero e elevação dos cards só com prefers-reduced-motion: no-preference.

### Páginas e posts (WordPress local)
Páginas novas: nossa-historia (31), por-que-o-tenis-transforma (32), tenis-sem-misterio (33), perguntas-frequentes (34) e blog (35, page_for_posts).
Posts (permalink /blog/%postname%/): tenis-para-criancas (36), esporte-e-desempenho-escolar (37), inclusao-no-esporte (38) e tenis-em-valinhos-e-regiao (39).
Templates novos: home.html e single.html, sem autor, categoria ou comentários. Cabeçalho ganhou "Nossa história" e "Blog". O rodapé traz os links das páginas novas e o selo "Versão de demonstração".
blogname passou a "Raquete para Todos" (antes era o placeholder do ambiente de teste).

### Export estático e publicação
- build-static.sh: wget --mirror, seguido de tools/fix-static.py (caminhos relativos e favicon), robots.txt Disallow e assets/logo.svg.
- Resultado: 16 páginas HTML e 34 arquivos no total. Zero ocorrências de 127.0.0.1, noindex em todas as páginas, nenhum link absoluto na raiz.
- Repo demo JarvisBotGrok/raquete-demo-ed93b4a0, commit 919b8a6, mesmo link. Verificação por curl: 200 em 34 de 34 arquivos.
- Puppeteer (1366 e 390, 16 páginas): nenhum 4xx/5xx, nenhuma chamada externa, nenhuma rolagem horizontal, fontes carregadas, nenhum texto pendente.
- Evidências: anvil/evidencias/publicado-v11/ (32 PNG). Resumos: /workspace/raquete-prints/resumo-v11-desktop.png e resumo-v11-mobile.png.

### Omitido por regra de veracidade
- Números de alunos e de raquetes, faixa etária, dias/horários, regra de nota mínima, restaurante parceiro, nomes de alunos, WhatsApp e turmas PCD. Também 170 tenistas/180 partidas (dossiê), porque o ECHO v2 não os adotou.
- Na mídia: as matérias do JTV de 19/05/2024 e de 15/09/2024 ficaram fora até decisão do VANGUARD (a primeira tem número de alunos no título). Nos itens da linha do tempo que citam essas duas fontes, a fonte aparece só como texto, sem link.
- IRIS-02, item 6 (cards de visibilidade com camisetas, banners e site): omitido, porque não há texto do ECHO nem contrapartidas aprovadas.
- Fotos de licença livre: não usadas, só ilustrações.
