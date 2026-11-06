# IRIS-05 — Fotos no hero (5 nov 2026)

Pedido do senhor Thaynan: trocar o H1 “Tênis gratuito em Valinhos” por “Projeto Raquete para Todos” e encaixar duas fotos no lugar da ilustração da quadra (`hero-quadra.svg`).

## Arquivos (originais do envio + versões para a web)

Pasta: `/home/box/shared/wordpress-raquete/iris/fotos-hero/`

| Arquivo | Uso | Tamanho nativo |
|---|---|---|
| `professor-alunos.jpg` | master da foto 1 (professor com alunos) | 1080 × 948 |
| `professor-alunos-800.jpg` / `.webp` | srcset 800w | 800 × 702 |
| `professor-alunos-1080.jpg` / `.webp` | srcset 1080w | 1080 × 948 |
| `professor-cuca.jpg` | master da foto 2 (professor com “o Cuca”) | 960 × 720 |
| `professor-cuca-800.jpg` / `.webp` | srcset 800w | 800 × 600 |
| `professor-cuca-960.jpg` / `.webp` | srcset 960w | 960 × 720 |

Publicar em `wp-content/themes/raquete-child/assets/img/foto/`, no mesmo padrão da foto de Pedro e Sérgio.

CSS: `/home/box/shared/wordpress-raquete/iris/iris-hero-fotos.css` — enfileirar depois de `style.css` e de `iris-contraste-faixas.css`.

## Layout

Substituir o `<img class="rq-hero-art" … hero-quadra.svg>` por um bloco `.rq-hero-fotos` com as duas figuras, nesta ordem: alunos, depois a foto com o Cuca.

- Computador (≥1000px): as fotos ficam na coluna da arte, uma sobre a outra, largura máxima 560px. O texto do hero permanece à esquerda.
- Celular: as duas fotos abaixo do texto, empilhadas.
- Sem recorte (`height: auto`). Cantos 12px, iguais aos da foto já publicada.
- Sem a animação `rq-float` de `.rq-hero-art`.
- A ilustração `hero-quadra.svg` fica de reserva, fora do hero.

Legendas (textos da ECHO): sobre o fundo azul `#3775C4` o texto da legenda é branco `#FFFFFF` (contraste 4,66:1, critério AA). Não usar `#231F20` nem `#FFF200` nesse texto.

## Textos

H1: `Projeto Raquete para Todos` (capitalização da ECHO). Subtítulo permanece: `Aulas de tênis em que o boletim também vale raquete.`

Foto 1 — alt e legenda da ECHO. Não nomear nenhuma criança. Não usar a foto para extrair número de alunos.

Foto 2 — até o senhor Thaynan confirmar o nome público da segunda pessoa, não afirmar “Cuca” nem outro nome no site. Alt e legenda provisórios, só com o professor: “O professor Pedro Stucchi (à esquerda) em um torneio de tênis.”

## Autorização

A foto 1 mostra crianças identificáveis. O envio pelo senhor Thaynan e o pedido para publicá-la são a origem do arquivo; o BASTION registra o status de autorização de imagem (LGPD e ECA). IRIS não aprova o próprio trabalho.

## Marcação sugerida ao ANVIL

```html
<div class="rq-hero-fotos">
  <figure>
    <picture>
      <source type="image/webp" srcset="wp-content/themes/raquete-child/assets/img/foto/professor-alunos-800.webp 800w, wp-content/themes/raquete-child/assets/img/foto/professor-alunos-1080.webp 1080w" sizes="(min-width:1000px) 560px, 92vw" />
      <img src="wp-content/themes/raquete-child/assets/img/foto/professor-alunos-800.jpg" srcset="wp-content/themes/raquete-child/assets/img/foto/professor-alunos-800.jpg 800w, wp-content/themes/raquete-child/assets/img/foto/professor-alunos-1080.jpg 1080w" sizes="(min-width:1000px) 560px, 92vw" width="1080" height="948" alt="O professor Pedro Stucchi, de camiseta e boné oficiais do projeto, posa com um grupo de alunos de camiseta azul-clara, medalhas e raquetes, diante do banner do Raquete para Todos." fetchpriority="high" decoding="async" />
    </picture>
    <figcaption>O professor Pedro Stucchi com alunos do Projeto Raquete para Todos, após uma premiação.</figcaption>
  </figure>
  <figure>
    <picture>
      <source type="image/webp" srcset="wp-content/themes/raquete-child/assets/img/foto/professor-cuca-800.webp 800w, wp-content/themes/raquete-child/assets/img/foto/professor-cuca-960.webp 960w" sizes="(min-width:1000px) 560px, 92vw" />
      <img src="wp-content/themes/raquete-child/assets/img/foto/professor-cuca-800.jpg" srcset="wp-content/themes/raquete-child/assets/img/foto/professor-cuca-800.jpg 800w, wp-content/themes/raquete-child/assets/img/foto/professor-cuca-960.jpg 960w" sizes="(min-width:1000px) 560px, 92vw" width="960" height="720" alt="O professor Pedro Stucchi, à esquerda, ao lado de outra pessoa, à direita, em um ambiente de torneio de tênis." loading="lazy" decoding="async" />
    </picture>
    <figcaption>O professor Pedro Stucchi (à esquerda) em um torneio de tênis.</figcaption>
  </figure>
</div>
```


## Atualização — recorte e bloqueio da foto das crianças

Decisão em vigor (VANGUARD, acatando recomendação do BASTION): a foto com os alunos **não entra** nesta publicação, enquanto o senhor Thaynan não confirmar autorização dos responsáveis.

No lugar da ilustração da quadra entra **somente** o recorte da foto do professor com Gustavo Kuerten (Guga), os dois em primeiro plano.

- Recorte aplicado: `(150, 40, 910, 710)` sobre o original 960×720, resultado 760×670.
- Rostos e o gesto de positivo do professor preservados.
- Saíram do quadro a mulher à esquerda e a pessoa à direita. Ainda aparece, ao fundo e à esquerda, parte de outra pessoa sentada; um recorte mais fechado cortaria o polegar do professor.
- Arquivos: `iris/fotos-hero/professor-com-guga-recorte.jpg` (master), `professor-com-guga-recorte-760.jpg` / `.webp` e `professor-com-guga-recorte-560.jpg` / `.webp`. Cópia em `ativos-cliente/foto-professor-com-guga-recorte.jpg`.

**Legenda (ECHO):** O professor Pedro Stucchi com Gustavo Kuerten (Guga).

**Alt:** O professor Pedro Stucchi, à esquerda, ao lado de Gustavo Kuerten (Guga), à direita, em um ambiente de torneio de tênis.

Marcação sugerida: um único `figure` dentro de `.rq-hero-fotos`, no lugar de `img.rq-hero-art`.


## Atualização — as duas fotos entram (confirmação do senhor Thaynan)

O senhor Thaynan confirmou que o projeto tem autorização dos responsáveis e que a foto das crianças pode entrar. O BASTION retirou o bloqueio. Nenhum aluno é nomeado.

No lugar da ilustração da quadra entram as duas fotos, nesta ordem:

1. Alunos — `iris/fotos-hero/professor-alunos-800.jpg` / `.webp` e `professor-alunos-1080.jpg` / `.webp`.
   Legenda e referência visual: “O professor Pedro Stucchi com alunos do Projeto Raquete para Todos.”
   Alt: “O professor Pedro Stucchi, de camiseta e boné oficiais do projeto, posa com um grupo de alunos de camiseta azul-clara, medalhas e raquetes, diante do banner do Raquete para Todos.”

2. Adultos — recorte em primeiro plano, arquivo **neutro** (sem Guga nem Kuerten): `iris/fotos-hero/professor-torneio-recorte.jpg`, `professor-torneio-recorte-760.jpg` / `.webp` e `professor-torneio-recorte-560.jpg` / `.webp`.
   Legenda: “O professor Pedro Stucchi em um torneio.”
   Alt: “O professor Pedro Stucchi, à esquerda, ao lado de outra pessoa, à direita, em um ambiente de torneio de tênis.”

O CSS `iris/iris-hero-fotos.css` já empilha as duas figuras em `.rq-hero-fotos`. Substituir o bloco que hoje tem uma foto só por dois `figure`.
