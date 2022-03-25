<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Equita
 */
$content_404_page = equita_get_opt( 'content_404_page' );
$btn_text_404_page = equita_get_opt( 'btn_text_404_page' );
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="row">
                <div class="col-12">
                    <section class="error-404 bg-overlay bg-image">
                        <div class="error-404-inner">
                            <header>
                                <h1>404</h1>
                            </header><!-- .page-title -->
                            <div class="page-content">
                                <?php if(!empty($content_404_page)) {
                                    echo wp_kses_post($content_404_page);
                                } else {
                                    echo esc_html__('The page you are looking is not available or has been removed. Try going to HomePage by using the button below.', 'equita');
                                } ?>
                            </div><!-- .page-content -->
                            <a class="btn btn-default" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php if(!empty($btn_text_404_page)) {
                                    echo wp_kses_post($btn_text_404_page);
                                } else {
                                    echo esc_html__('Back To Home', 'equita');
                                } ?>   
                            </a>
                        </div>
                    </section><!-- .error-404 -->
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
