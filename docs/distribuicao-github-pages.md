# Distribuição — tema, export e GitHub Pages

Transferência autorizada pelo senhor Thaynan para `https://github.com/sfmartinst-debug/Raquete-para-todos`. Os repositórios antigos `JarvisBotGrok/raquete-demo-ed93b4a0` e `JarvisBotGrok/raquete-para-todos-site` não são alterados por este repositório.

Isto é uma demonstração autorizada. Não é o aceite institucional final. Direitos de imagem para o lançamento final continuam pendentes de confirmação formal. O site permanece com `noindex, nofollow` e `robots.txt` com `Disallow: /`.

## Layout

| Caminho | Função |
|---|---|
| `theme/raquete-child/` | Tema WordPress atual (fonte). |
| `static/` | Export público servido pelo GitHub Pages. |
| `build/` | Export local, correção de caminhos, sincronização do hero e checagem. |
| `docs/` | Documentação. Não entra no site publicado. |
| `content/` | Metadados públicos derivados do export. |
| `specs/` | Especificação IRIS-05 e o complemento IRIS-05h. |

O GitHub Pages de projeto publica um diretório na URL `https://sfmartinst-debug.github.io/Raquete-para-todos/`. O workflow `.github/workflows/pages.yml` envia somente `static/` depois do merge em `main`. A pasta `docs/` fica como documentação, não como raiz do Pages, para o endereço do projeto abrir a home do site.

## Caminhos

O export usa caminhos relativos (`wp-content/...`, `../o-projeto/`). Eles resolvem dentro do subdiretório do projeto e também num servidor local na raiz. Não há prefixo fixo `/Raquete-para-todos/` no HTML: um caminho absoluto na raiz do domínio (`/wp-content/...`) quebraria o Pages de projeto.

`build/fix-static.py` reescreve, num export novo:

- `http://127.0.0.1:8088/`
- `https://jarvisbotgrok.github.io/raquete-demo-ed93b4a0`
- `https://jarvisbotgrok.github.io/raquete-para-todos-site`
- `href` e `src` que começam com `/`

No tema, `functions.php` reescreve na renderização os mesmos caminhos internos para `home_url()` e para o URI do tema, para um WordPress em subdiretório. Padrões com PHP usam `home_url()` e `get_stylesheet_directory_uri()`.

`static/.nojekyll` impede o Jekyll de processar o export.

## Hero

`theme/raquete-child/assets/iris-hero-fotos.css` e `.js` são a fonte. `build/sync-hero-assets.py` copia os dois arquivos, e o `style.css`, para `static/wp-content/themes/raquete-child/`. A marcação publicada da home está em `static/index.html`. O padrão `theme/raquete-child/patterns/hero-fotos.php` repete essa marcação para o WordPress.

## O que este repositório não faz

Não altera DNS, não contrata serviço, não envia mensagem e não remove o `noindex`. A publicação no ar depende do merge deste trabalho em `main` e da permissão da conta para GitHub Pages (Actions). Sem essa permissão o workflow fica preparado e o site não é publicado.
