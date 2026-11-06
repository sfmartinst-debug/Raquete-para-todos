# ANVIL — Especificação técnica v1 (site de apresentação) — HIPÓTESE / RASCUNHO
Projeto Raquete para Todos (Valinhos/SP) · ANVIL (= FORGE no manual mestre) · 31/10/2026 (horário de Brasília) · v0.2
Status: **HIPÓTESE** (protocolo geral §14). Nada aqui está aprovado para publicação. A estrutura segue a decisão do VANGUARD para a v1, e os textos são da ECHO (`echo/textos-v1.md`), em rascunho.

## 0. Escopo da v1 (decisões recebidas)
- Site **institucional de apresentação**: sem formulários, sem cadastro, sem integrações, sem rastreamento ou analytics, sem chamadas a terceiros.
- Sem fotos de alunos. Só ilustrações próprias (SVG) ou imagens de licença livre com origem registrada (IRIS-01).
- Sem cotas e sem valores de patrocínio. Bloco com dado não confirmado é **omitido** (regra BASTION/ECHO). Nome do idealizador omitido.
- Tema e plugins gratuitos; nada pago (manual mestre, Regra de Veracidade).

## 1. Fundação WordPress (cap.1, 001–010)
| Item | Ambiente de teste (instalado) | Produção (pendente) |
|---|---|---|
| Núcleo | WordPress 7.1.4 pt_BR | versão estável vigente na data do deploy |
| PHP | 8.4.23 (binário estático, static-php-cli, MIT) | ≥ 8.2 suportado pela hospedagem |
| Banco | SQLite via plugin oficial "SQLite Database Integration" 3.1.2 (WordPress Performance Team, GPL) — o PHP estático disponível não traz `mysqli` e o apt da box está indisponível | MySQL/MariaDB da hospedagem (migrar com export WXR ou dump) |
| Servidor | `php -S 127.0.0.1:8088` + router.php (só localhost) | Nginx/Apache da hospedagem com HTTPS |
| Config | `WP_ENVIRONMENT_TYPE=local`, `DISALLOW_FILE_EDIT`, `AUTOMATIC_UPDATER_DISABLED`, `blog_public=0`, comentários/pings fechados, permalinks `/%postname%/`, fuso America/Sao_Paulo | idem, exceto atualizações de segurança automáticas ligadas |

## 2. Tema (cap.2, 011–020)
- Pai: **Twenty Twenty-Five 1.5** (tema de bloco padrão, GPL, mantido pelo WordPress.org).
- Filho: **raquete-child 0.2.0**, que contém:
  - `theme.json`: paleta IRIS (#0B6E4F, #12355B, #F2C230, #F7F3EA, #1F2933), escala 18/22/28/36/48, espaçamentos de 8px, cantos de 12px, conteúdo de 760px e área larga de 1200px;
  - fontes **Inter 400/600** e **Montserrat 700/800** auto-hospedadas em `assets/fonts` (SIL OFL 1.1, licenças junto);
  - templates `page.html` e `front-page.html`, partes `header.html` (logo SVG provisório, menu, botão "Apoie o Projeto") e `footer.html` (nota "Identidade visual provisória").
- `functions.php`: desliga wp-emoji, oEmbed, wp-embed, dns-prefetch, generator, feeds, RSD e links da REST API no `<head>`; define title e meta description por página (metadados `rq_title`/`rq_desc`); adiciona `noindex` e a faixa "Prévia de rascunho".
- Sem construtor de páginas (Elementor etc.), para manter a dependência mínima.

## 3. Modelagem de conteúdo (cap.3, 021–030)
- Só **Páginas** nativas, sem tipos personalizados nem taxonomias na v1 (não há volume que justifique).
- Páginas e slugs: Início `/` · O Projeto `/o-projeto/` · Atividades e Público `/atividades/` · Eventos e Ações `/eventos/` · Apoie o Projeto `/apoie/` · Contato `/contato/` · Política de Privacidade `/privacidade/` (também registrada como página de privacidade do WP).
- Posts e comentários fora do escopo (sem blog na v1).
- Evolução possível, se aprovada: tipo `evento` (data, local, fonte) para a linha do tempo.
- Cada seção traz uma nota discreta de **Fontes** no fim, com links públicos da Prefeitura ou da imprensa.

## 4. Interface (cap.4, 031–040)
- Construída só com blocos nativos (group, columns, heading, paragraph, buttons, navigation, html para SVG). Hero em gradiente verde→azul, cards, linha do tempo e faixa de CTA amarela.
- Testada em 1366, 768 e 390px: sem overflow horizontal; menu vira overlay no celular.
- Acessibilidade:
  - foco visível de 3px em amarelo;
  - alvos de toque com 44px ou mais;
  - hierarquia H1→H3 com um único H1 por página;
  - links do rodapé em amarelo sobre azul;
  - ainda falta medir o contraste com ferramenta (pendente para o BASTION).
- H1 da Início: no celular, quebra forçada depois de "Valinhos," (`.rq-br`), sem mudar o texto.

## 5. Plugins (cap.5, 041–050)
| Plugin | Motivo | Licença | Status |
|---|---|---|---|
| SQLite Database Integration 3.1.2 | só no ambiente de teste (banco sem MySQL) | GPL | **não vai para produção** |
| Akismet, Hello Dolly | removidos (sem comentários/formulários) | — | removidos |
Recomendação para produção: **nenhum plugin obrigatório**.
- Title e meta já ficam no child theme.
- Sitemap XML: o nativo do WP (`/wp-sitemap.xml`).
- Backup: o da hospedagem ou o plugin gratuito UpdraftPlus (decisão do senhor).
- Antispam: dispensável, porque não há formulário nem comentários.

## 6. Critérios de aceite técnicos (hipótese, para revisão do BASTION)
1. As 7 páginas respondem 200, cada uma com title e meta description próprios.
2. **Zero requisições a domínios externos** no carregamento (teste: puppeteer `externas: []`); os links de fonte só abrem se o visitante clicar.
3. Nenhum `[PENDENTE]`, "em confirmação" ou nome do idealizador no HTML.
4. Sem overflow horizontal em 1366, 768 e 390px.
5. Sem `<form>` no front-end; sem cookies além dos técnicos de login (admin).
6. Backup (SQL + wp-content + core/config) restaurado em outra instância, com HTML idêntico ao original.
7. Fontes servidas localmente, com licença OFL presente.
8. Produção: HTTPS, admin com 2FA, privilégio mínimo, backup testado, plano de rollback (protocolo geral §18).
