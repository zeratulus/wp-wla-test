<?php get_header(); ?>

    <div class="modal-backdrop" id="cart-modal">
        <div class="modal">
            <div class="modal-header">Your order</div>
            <div class="modal-body">

                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <table class="fw">
                            <tr>
                                <td>Product</td>
                                <td>Price</td>
                                <td>Quantity</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
                foreach (WC()->cart->cart_contents as $product) {
                    $product_id = $product['product_id'];
                    $quantity = $product['quantity'];
                    $subtotal = $product['line_subtotal'];
                    $total = $product['line_total'];
                    $data = $product['data'];
	                $title = $data->get_title();
                ?>
                    <div class="row">
                        <div class="col d-flex flex-center flex-align-center"><?= $data->get_image(); ?></div>
                        <div class="col">
                            <table class="fw">
                                <tr>
                                    <td>
                                        <p class="title"><?= $title; ?></p>
                                        <p class="description"></p>
                                    </td>
                                    <td>$<?= $subtotal ?></td>
                                    <td>
                                        <div class="d-flex flex-start flex-align-center">
                                            <a href="#" class="btn-counter btn-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" class="cart-quantity" min="1" step="1" value="<?= $quantity; ?>">
                                            <a href="#" class="btn-counter btn-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="line-white"></div>
                        </div>
                    </div>
                <?php
                }

                $cartSubtotal = WC()->cart->get_displayed_subtotal();

                $cartTotal = WC()->cart->get_cart_contents_total();
                ?>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <div class="d-flex flex-between">
                            <p>Subtotal:</p>
                            <p>$<?= $cartSubtotal; ?></p>
                        </div>
                        <div class="line-white"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <div class="d-flex flex-between">
                            <p class="total">Total:</p>
                            <p class="total">$<?= $cartTotal; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p>
                            Information about this shipment method. Delay,<br>
                            conditions.Information about this shipment method
                        </p>
                        <select name="" id="">
                            <option value="">Select your country</option>
                        </select>
                        <input type="text" value="State / country">
                        <input type="text" value="Postcode">
                    </div>
                    <div class="col"></div>
                </div>

                <div class="buttons d-flex flex-between flex-align-center">
                    <a class="btn btn-secondary btn-sm">Update Shipping</a>
                    <a href="<?= wc_get_checkout_url(); ?>" class="btn btn-primary">Checkout</a>
                </div>
            </div>
            <div class="close"><i class="fas fa-times"></i></div>
        </div>
    </div>

    <div id="content">

        <!-- Top slider -->
		<?php

		$img_placeholder = get_template_directory_uri() . '/images/img-placeholder.png';

		$gallery_id = get_theme_mod( "top_gallery" );
		if ( $gallery_id !== null ) {
			$gallery = new WP_Query( [
				'post_type'         => 'gallery',
				'queried_object_id' => $gallery_id
			] );

			$images = get_field( 'gallery', $gallery->post->ID );
			?>

            <div class="fw-slider">
				<?php foreach ( $images as $image ) { ?>
                    <div class="slide" style="background-image: url('<?= $image['url']; ?>')"></div>
				<?php } ?>
            </div>

            <script>
                jQuery(document).ready(function () {
                    jQuery('.fw-slider').slick({
                        autoplay: true,
                        autoplaySpeed: 4000,
                    });
                });
            </script>

		<?php } ?>
        <!-- ./ Top slider -->


        <!-- Categories -->
		<?php
		$categories = get_categories( [
			'orderby' => 'name',
			'order'   => 'ASC'
		] );

		$posts_limit = count( $categories ) * 2;

		$posts = get_posts( [
			'numberposts' => $posts_limit,
		] );

		if ( $categories || $posts ) {
			?>
            <h2 class="text-center heading">Our Blog</h2>
            <div class="categories">
                <div class="container d-flex flex-center flex-align-start">
                    <div class="col">
						<?php
						foreach ( $categories as $category ) {
							$image = get_field( 'image', $category );
							if ( empty( $image ) ) {
								$image = $img_placeholder;
							}
							?>

                            <a class="category" href="<?= get_category_link( $category->cat_ID ); ?>"
                               style="background-image: url('<?= $image ?>')">
                                <h3 class="d-flex flex-start flex-align-center"><?= $category->name; ?></h3>
                            </a>

						<?php } ?>
                    </div>

                    <div class="col">
						<?php
						foreach ( $posts as $post ) {
							$author = get_user_by( 'ID', $post->post_author );
							$thumb  = get_the_post_thumbnail_url( $post );
							if ( empty( $thumb ) ) {
								$thumb = $img_placeholder;
							}
							?>
                            <a href="<?= get_the_permalink( $post ); ?>" class="post-card">
                                <div class="description">
                                    <div class="wrapper">
                                        <h3><?= $post->post_title; ?></h3>
                                        <h4>
                                            <span><?= $author->display_name; ?></span>, <?= get_the_time( 'd.m.Y', $post ); ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="thumb">
                                    <img src="<?= $thumb; ?>" alt="<?= $post->post_title; ?>">
                                </div>
                            </a>
						<?php } ?>
                    </div>
                </div>
            </div>
		<?php } ?>
        <!-- ./ Categories -->

        <!-- Testimonials Block -->
        <div id="testimonials" data-ajax-url="<?= admin_url( 'admin-ajax.php?action=get_testimonials&alpha=' ) ?>">
            <div class="fw bg">
                <div class="container">
                    <h2>Testimonials</h2>
                    <div class="alphabet"
                         data-ajax-url="<?= admin_url( 'admin-ajax.php?action=get_testimonials_alphabet' ) ?>"></div>
                </div>
            </div>

            <div class="container">
                <div class="d-flex flex-between flex-align-center controls">
                    <a class="btn-slider-prev"></a>
                    <div class="slider-active-alpha"></div>
                    <a class="btn-slider-next"></a>
                </div>
                <div class="content">

                </div>
            </div>
        </div>
        <!-- ./ Testimonials Block -->

        <!-- Products Block -->
        <div id="products">
            <h2 class="products-heading text-center">Products</h2>
            <div class="tabs d-flex flex-center">
				<?php
				$categories = get_categories( [
					'taxonomy'     => 'product_cat',
					'orderby'      => 'name',
					'show_count'   => false,
					'pad_counts'   => false,
					'hierarchical' => false,
					'hide_empty'   => true
				] );
				foreach ( $categories as $category ) {
					?>
                    <a class="tab" href="#tab-<?= $category->term_id; ?>"><?= $category->name; ?></a>
				<?php } ?>
            </div>

            <div class="products d-flex flex-center">
                <div class="container">
					<?php foreach ( $categories as $category ) { ?>
                        <div class="tab" id="tab-<?= $category->term_id; ?>">
                            <div class="products-slider fw">
								<?php

								$loop = new WP_Query( [
									'post_type'      => 'product',
									'posts_per_page' => 10,
									'product_cat'    => $category->slug
								] );

								while ( $loop->have_posts() ) : $loop->the_post();
									global $product;
									?>

                                    <div class="single-slide" href="<?= get_permalink(); ?>">
                                        <div class="wrapper">
                                            <div class="image">
												<?= woocommerce_get_product_thumbnail(); ?>
                                                <div class="product-buttons">
                                                    <a href="?add-to-cart=<?= $product->get_id(); ?>&quantity=1" class="button"><i class="fas fa-cart-plus"></i></a>
                                                    <a href="#" class="button"><i class="fa-regular fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <h3 class="text-center"><?= get_the_title(); ?></h3>
                                            <p class="price">
												<?php
												$price         = $product->get_price();
												$regular_price = $product->get_regular_price();
												$isSale        = $regular_price != $price;
												if ( $isSale ) {
													$percent      = $price / 100;
													$salePercents = round( ( $regular_price - $price ) / $percent, 0 );
												}
												?>

                                                $<?= $price; ?><?= $isSale ? '<span>$' . $regular_price . '</span>' : ''; ?>
                                            </p>
                                        </div>
										<?php if ( $isSale ) { ?>
                                            <div class="badge sale"><?= $salePercents; ?>%</div>
										<?php } ?>
										<?php if ( ! $product->is_in_stock() ) { ?>
                                            <div class="badge out-of-stock">Out of Stock</div>
										<?php } ?>
<!--										--><?php //if ( date( 'Y-m-d H:i:s' ) <= date_add( date( $product->get_date_created() ), '30d' ) ) { ?>
<!--                                            <div class="badge new">New</div>-->
<!--										--><?php //} ?>
                                    </div>

								<?php endwhile;

								wp_reset_query(); ?>
                            </div>
                        </div>
                        <script>
                            if (window.isMobile) {
                                jQuery('.products-slider').slick({
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                });
                            } else {
                                jQuery('.products-slider').slick({
                                    slidesToShow: 4,
                                    slidesToScroll: 4
                                });
                            }
                        </script>
					<?php } ?>
                </div>
            </div>
        </div>
        <!-- ./ Products Block -->

        <div id="contact" data-ajax-url="<?= admin_url( 'admin-ajax.php?action=get_location&map_location_id=' ) ?>">
            <h2 class="contact-heading text-center">Contact</h2>
            <div class="d-flex flex-center">
                <div class="container d-flex flex-between">
					<?php $q   = new WP_Query( [
						'post_type' => 'map_location',
						'nopaging'  => true
					] );
					$address   = get_field( 'address', $q->post->ID );
					$email     = get_field( 'email', $q->post->ID );
					$telephone = get_field( 'telephone', $q->post->ID );
					$gallery   = get_field( 'location_gallery', $q->post->ID );
					?>
                    <div class="location-info">
                        <div class="row d-flex flex-start flex-align-center">
                            <div class="icon"><i class="fas fa-map-marker"></i></div>
                            <p id="loc-address"><?= $address ?></p>
                        </div>
                        <div class="row d-flex flex-start flex-align-center">
                            <div class="icon"><i class="fas fa-envelope"></i></div>
                            <p id="loc-email"><?= $email ?></p>
                        </div>
                        <div class="row d-flex flex-start flex-align-center">
                            <div class="icon"><i class="fas fa-phone"></i></div>
                            <p id="loc-phone"><?= $telephone ?></p>
                        </div>
                    </div>
                    <div class="map">
						<?php
						foreach ( $q->posts as $post ) {
							$title     = $post->post_title;
							$location  = get_field( 'map', $post->ID );
							$address   = get_field( 'address', $post->ID );
							$email     = get_field( 'email', $post->ID );
							$telephone = get_field( 'telephone', $post->ID );
							?>
                            <div class="marker" data-lat="<?= esc_attr( $location['lat'] ); ?>"
                                 data-lng="<?= esc_attr( $location['lng'] ); ?>"
                                 data-email="<?= $email; ?>"
                                 data-address="<?= $address ?>"
                                 data-telephone="<?= $telephone ?>"
                                 data-location-id="<?= $post->ID ?>"
                            >
                                <h3><?= esc_html( $title ); ?></h3>
                                <p><?= esc_html( $address ); ?></p>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-center">
                <div class="container">
                    <div class="gallery">
						<?php foreach ( $gallery as $item ) { ?>
                            <div class="location-slide" style="background-image: url('<?= $item['url']; ?>')"></div>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?= get_theme_mod( 'google_maps_api_key' ); ?>"></script>
        <script>
            function initMap($el) {
                let $markers = $el.find('.marker');
                let mapArgs = {
                    zoom: $el.data('zoom') || 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: true,
                };
                let map = new google.maps.Map($el[0], mapArgs);
                map.markers = [];
                $markers.each(function () {
                    initMarker(jQuery(this), map);
                });

                // Center map based on markers.
                centerMap(map);

                // Return map instance.
                return map;
            }

            function centerMap(map) {

                // Create map boundaries from all map markers.
                let bounds = new google.maps.LatLngBounds();
                map.markers.forEach(function (marker) {
                    bounds.extend({
                        lat: marker.position.lat(),
                        lng: marker.position.lng()
                    });
                });

                // Case: Single marker.
                if (map.markers.length == 1) {
                    map.setCenter(bounds.getCenter());

                    // Case: Multiple markers.
                } else {
                    map.fitBounds(bounds);
                }
            }

            function initMarker($marker, map) {

                // Get position from marker.
                let lat = $marker.data('lat');
                let lng = $marker.data('lng');
                let latLng = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };

                // Create marker instance.
                let marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });
                marker.locationId = $marker.data('location-id');

                // Append to reference for later use.
                map.markers.push(marker);

                // If marker contains HTML, add it to an infoWindow.
                if ($marker.html()) {

                    // Create info window.
                    let infowindow = new google.maps.InfoWindow({
                        content: $marker.html()
                    });

                    // Show info window when marker is clicked.
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                        jQuery('#loc-address').html($marker.data('address'));
                        jQuery('#loc-email').html($marker.data('email'));
                        jQuery('#loc-phone').html($marker.data('telephone'));
                        let url = jQuery('#contact').data('ajax-url') + marker.locationId;
                        jQuery.get(url, {}, function (data) {
                            console.log(data);
                            if (data.success) {
                                let gallery = jQuery('#contact .gallery');
                                gallery.slick('unslick');
                                gallery.html('');
                                data.item.gallery.forEach(function (image) {
                                    gallery.append(`<div class="location-slide" style="background-image: url('${image['url']}')"></div>`);
                                });
                                initContactGallery();
                            }
                        });
                    });
                }
            }

            jQuery(document).ready(function () {
                initContactGallery();

                jQuery('.map').each(function () {
                    let gmap = initMap(jQuery(this));
                });

                jQuery('#btn-top-menu-cart').on('click', function (e) {
                    e.preventDefault();
                    jQuery('#cart-modal').toggleClass('active');
                });

                jQuery('#cart-modal .close').on('click', function () {
                    jQuery('#cart-modal').removeClass('active');
                });
            });

            function initContactGallery() {
                if (!window.isMobile) {
                    jQuery('#contact .gallery').slick({
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        centerMode: true,
                        arrows: true,
                        dots: false,
                    });
                } else {
                    jQuery('#contact .gallery').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true,
                        arrows: true,
                        dots: false,
                    });
                }
            }
        </script>

    </div>
<?php get_footer(); ?>