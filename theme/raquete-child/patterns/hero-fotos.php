<?php
/**
 * Title: Fotos do hero
 * Slug: raquete/hero-fotos
 * Categories: raquete
 * Description: Duas fotos do hero (alunos, depois Guga) com controles IRIS-05h. A home publicada está no export estático.
 */
$rq_foto = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/img/foto/';
?>
<!-- wp:html -->
<div class="rq-hero-fotos">
<figure class="is-active">
<picture>
<source type="image/webp" srcset="<?php echo esc_url( $rq_foto ); ?>professor-alunos-800.webp 800w, <?php echo esc_url( $rq_foto ); ?>professor-alunos-1080.webp 1080w" sizes="(min-width:1000px) 560px, 100vw" />
<img src="<?php echo esc_url( $rq_foto ); ?>professor-alunos-1080.jpg" srcset="<?php echo esc_url( $rq_foto ); ?>professor-alunos-800.jpg 800w, <?php echo esc_url( $rq_foto ); ?>professor-alunos-1080.jpg 1080w" sizes="(min-width:1000px) 560px, 100vw" width="1080" height="948" alt="O professor Pedro Stucchi, de camiseta e boné oficiais do projeto, posa com um grupo de alunos de camiseta azul-clara, medalhas e raquetes, diante do banner do Raquete para Todos." fetchpriority="high" decoding="async" />
</picture>
<figcaption>O professor Pedro Stucchi com alunos do Projeto Raquete para Todos.</figcaption>
</figure>
<figure>
<picture>
<source type="image/webp" srcset="<?php echo esc_url( $rq_foto ); ?>professor-torneio-recorte-560.webp 560w, <?php echo esc_url( $rq_foto ); ?>professor-torneio-recorte-760.webp 760w" sizes="(min-width:1000px) 560px, 100vw" />
<img src="<?php echo esc_url( $rq_foto ); ?>professor-torneio-recorte-760.jpg" srcset="<?php echo esc_url( $rq_foto ); ?>professor-torneio-recorte-560.jpg 560w, <?php echo esc_url( $rq_foto ); ?>professor-torneio-recorte-760.jpg 760w" sizes="(min-width:1000px) 560px, 100vw" width="760" height="670" alt="O professor Pedro Stucchi com Gustavo Kuerten (Guga)." loading="lazy" decoding="async" />
</picture>
<figcaption>O professor Pedro Stucchi com Gustavo Kuerten (Guga).</figcaption>
</figure>
<div class="rq-hero-fotos__controles" role="group" aria-label="Controles das fotos de destaque">
<button type="button" class="rq-hero-fotos__prev" data-rq-foto="prev" aria-label="Foto anterior"><svg class="rq-hero-fotos__icon" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" focusable="false"><path d="M14.5 5.5 8 12l6.5 6.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
<button type="button" class="rq-hero-fotos__next" data-rq-foto="next" aria-label="Próxima foto"><svg class="rq-hero-fotos__icon" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" focusable="false"><path d="M9.5 5.5 16 12l-6.5 6.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
<button type="button" class="rq-hero-fotos__pause" data-rq-foto="pause" aria-pressed="false" aria-label="Pausar"><svg class="rq-hero-fotos__icon rq-icon-pause" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false"><path d="M7.5 5.5h2.6v13H7.5zM13.9 5.5h2.6v13h-2.6z" fill="#ffffff"/></svg><svg class="rq-hero-fotos__icon rq-icon-play" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false"><path d="M8.5 5.8 18 12 8.5 18.2z" fill="#ffffff"/></svg></button>
<div class="rq-hero-fotos__dots" aria-hidden="true"><span class="rq-hero-fotos__dot is-current"></span><span class="rq-hero-fotos__dot"></span></div>
</div>
</div>
<!-- /wp:html -->
