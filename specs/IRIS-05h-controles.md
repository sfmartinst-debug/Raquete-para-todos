# IRIS-05h — controles do hero

Complemento de `specs/IRIS-05-hero-fotos.md`. O pacote de transferência trazia ícones tipográficos (`‹ › Ⅱ`) numa faixa abaixo das fotos. Isso não é o 05h.

## Controles

- Setas: SVG embutido, chevron branco fino, dentro de botões circulares pretos translúcidos.
- Alvo de toque mínimo: 44×44 px.
- Anterior à esquerda da foto; próxima à direita da foto.
- Pausar/retomar compacto no canto inferior direito da foto.
- Foco de teclado visível em amarelo `#FFF200`.
- Sem rótulo de texto visível.
- Nomes acessíveis: `Foto anterior`, `Próxima foto`, `Pausar`. Com a animação parada o botão passa a `Retomar`.
- Dois pontos passivos da foto corrente, no elemento com `aria-hidden="true"`. Não são botões e não recebem clique.

## O que permanece do 05g

A correção de imagem em branco não foi substituída. Com hover, foco, pausa ou no instante em que a animação reinicia (`.is-holding`), as figuras ficam com `opacity: 0`, a `figure.is-active` fica visível e, se nenhuma estiver ativa, a primeira figura aparece. O script continua a marcar `.is-active` pela figura mais opaca antes de parar, para não trocar a foto nem esvaziar o quadro.

Legendas e `alt` aprovados, o H1 `Projeto Raquete para Todos`, `prefers-reduced-motion` (controles ocultos e o script não inicia), `noindex, nofollow` e `Disallow: /` permanecem.

O ciclo manual é alunos → Guga → alunos. Pausar e retomar não tira o foco do botão. O mouse sobre o bloco para a animação na foto ativa.
