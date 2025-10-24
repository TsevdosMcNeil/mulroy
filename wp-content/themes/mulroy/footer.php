       </div>
      </div>
    </main>
<?php 
$company_name = get_field('company_name', 'option');
$building_address = get_field('building_address', 'option');
$street = get_field('street', 'option');
$city = get_field('city', 'option');
$pin_code = get_field('pin_code', 'option');
$country = get_field('country', 'option');
$phone = get_field('phone', 'option');
$email = get_field('email', 'option');
$instagram = get_field('instagram', 'option');
$linkedin = get_field('linkedin', 'option');
$legal = get_field("legal",'option');
$career = get_field("careers",'option');
?>
      <!-- Footer -->
    <footer class="bg-light">
      <section class="site-container container-py pt-8">
        <div
          class="footer-content flex flex-col gap-y-[5vh] md:gap-y-[7vh] lg:grid lg:grid-cols-12"
        >
          <div class="footer-title">
            <a href="<?php echo home_url(); ?>" class="anchor"> MULROY </a>
			 <div class="legal_careers_links">
				<a href="<?php echo $legal; ?>" class="anchor">Legal</a>
				<a href="<?php echo $career; ?>" class="anchor">Careers</a>
			</div>
          </div>

          <div
            class="flex flex-col md:gap-20 gap-10 col-start-6 col-end-8 justify-self-center"
          >
            <div class="address">
              <?php echo $company_name; ?> <br /><?php echo $building_address; ?><br />
              <?php echo $street; ?><br />
              <?php echo $city; ?> <?php echo $pin_code; ?>
              <br />
             <?php echo $country; ?>
            </div>
            <div class="contact flex flex-col">
              <a href="tel:<?php echo $phone; ?>" class="anchor"><?php echo $phone; ?></a>
              <a href="mailto:<?php echo $email; ?>" class="anchor"><?php echo $email; ?></a>
            </div>
          </div>
          <div
            class="footer-social flex flex-col col-start-11 justify-self-end"
          >
            <a href="<?php echo $instagram; ?>" class="anchor" target="_blank" >Instagram</a>
            <a href="<?php echo $linkedin; ?>" class="anchor" target="_blank">LinkedIn</a>
          </div>
        </div>
      </section>
    </footer>
<?php wp_footer(); ?>
</body>
</html>
