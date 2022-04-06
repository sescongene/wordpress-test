<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package donation
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="donation-form">
		<div class="form-header">
			<h2 class="sub-heading form-title">Lorem Ipsum</h2>
			<div class="total-raised"><span class="currency">$</span><span id="total-amount">413,078</span></div>
			<div class="sub-title">of $4 million raised</div>
		</div>
		<form>
			<div id="progress-bar">
				<div class="progress"></div>
			</div>

			<div class="amount-input">
				<span>$</span>
				<input type="number" name="donation_amount">
			</div>
			<div class="description">
				Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
				diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
				sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
			</div>

			<h2 class="sub-heading">Select payment method</h2>
			<div class="radio-group">
				<label><input type="radio" name="payment_method">Paypal <span class="checkmark"></span></label>
				<label><input type="radio" name="payment_method">Offline Donation <span class="checkmark"></span></label>
			</div>

			<h2 class="sub-heading">Personal info</h2>
			<div class="form-group">
				<div class="sub-group">
					<input type="text" name="first_name" placeholder="First Name*" required>
					<input type="email" name="email" placeholder="Email*" required>
				</div>
				<div class="sub-group">
					<input type="text" name="last_name"  placeholder="Last Name*" required>
					<input type="text" name="phone" placeholder="Phone*" required>
				</div>
			</div>
			<div class="amount-input wider">
				<span>Donation total:</span>
				<input type="text" name="donation_amount_copy" disabled>
			</div>
			<button class="submit-button">Donate Now</button>
		</form>

	</div>
</main>

<section class="sub-section">
	<div class="featured-image">
		<img src="<?=get_template_directory_uri()?>/assets/kid.png">
	</div>
	<div class="content">
		<h2 class="sub-heading">
			Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
		</h2>
		<div class="description">
		With only 3 hospices / respite centres in Australia for children under the age of 18, Rio’s Legacy’s vision is to provide more facilities readily available for families going through the most difficult time in their lives, living with a child who has a terminal illness. On top of this, Rio’s Legacy will look to assist families who have a child in the intensive care unit at the Sydney Children’s Hospital and support children and young people who have been diagnosed with a terminal illness and their families at Bear Cottage.
		</div>
	</div>
</section>
<?php
get_footer();