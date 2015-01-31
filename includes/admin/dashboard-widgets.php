<?php
/**
 * Admin Dashboard Functions
 *
 * @package WP_TICKET_COM
 * @version 1.2
 * @since WPAS 4.0
 */
if (!defined('ABSPATH')) exit;
/**
 * WP Dashboard setup function
 * @since WPAS 4.0
 *
 */
function wp_ticket_com_register_dashb_widgets() {
	if (current_user_can('configure_recent_tickets_dashboard')) {
		wp_add_dashboard_widget('wp_ticket_com_recent_tickets_dashboard', __('Recent Tickets', 'wp-ticket-com') , 'wp_ticket_com_recent_tickets_dashboard_dwidget', 'wp_ticket_com_recent_tickets_dashboard_dwidget_control');
	} else if (current_user_can('view_recent_tickets_dashboard')) {
		wp_add_dashboard_widget('wp_ticket_com_recent_tickets_dashboard', __('Recent Tickets', 'wp-ticket-com') , 'wp_ticket_com_recent_tickets_dashboard_dwidget', '');
	}
}
add_action('wp_dashboard_setup', 'wp_ticket_com_register_dashb_widgets');
/**
 * Dashboard entity widget display
 * @since WPAS 4.0
 *
 */
function wp_ticket_com_recent_tickets_dashboard_dwidget() {
	$args['has_pages'] = false;
	$args['class'] = 'emd_ticket';
	$args['query_args'] = Array(
		'post_type' => 'emd_ticket',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC'
	);
	$args['fname'] = 'wp_ticket_com_recent_tickets_dashboard_layout';
	$args['app'] = 'wp_ticket_com';
	emd_dashboard_widget('wp_ticket_com_recent_tickets_dashboard', 'entity', $args);
}
/**
 * Dashboard entity widget control
 * @since WPAS 4.0
 *
 */
function wp_ticket_com_recent_tickets_dashboard_dwidget_control() {
	emd_dashboard_widget_control('wp_ticket_com_recent_tickets_dashboard', 'Tickets', 'entity');
}
/**
 * Dashboard entity widget layout
 * @since WPAS 4.0
 *
 */
function wp_ticket_com_recent_tickets_dashboard_layout() {
?>
* <a title="<?php echo esc_html(rwmb_meta('emd_ticket_id')) ?> - <?php echo get_the_date() ?> - <?php echo get_the_time() ?>" href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a><br />


<?php
} ?>