<style>
	@media(max-width:1024px){
		footer{
			display:block !important;
		}
	}
</style>

<?php 
/*
Template Name: Contact Page
*/

get_header(); 
?>
<?php
global $post;

?>
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
?>
           <section
            class="bg-[#D9D8D6]"
          >
            <div class="contact-page-grid h-[max-content]">
              <div
                class="contact-page-title col-span-3 fs-3xl"
                style="line-height: 0.7"
              >
                CONTACT
              </div>
				<div class="contact-page-subtitle">
					<p class="fs-2xl">
						Tell us more about your query with the form  opposite and then book a meeting with our team.
					</p>
					
				<div class="subtitle__address_contact">
					 <div class="address">
                  <?php echo $company_name; ?><br /><?php echo $building_address; ?><br />
                  <?php echo $street; ?><br />
                  <?php echo $city; ?> <?php echo $pin_code; ?><br />
                  <?php echo $country; ?>
                </div>
				
				<div class="contact-social">
                  <div class="contact-social-content">
                    <div class="flex flex-col">
                      <a href="tel:<?php echo $phone; ?>" class="anchor"><?php echo $phone; ?></a>
                      <a href="mailto:<?php echo $email; ?>" class="anchor"><?php echo $email; ?></a>
                    </div>
                    <div class="menu-social flex flex-col">
                      <a href="<?php echo $instagram; ?>" class="anchor" target="_blank" >Instagram</a>
                      <a href="<?php echo $linkedin; ?>" class="anchor" target="_blank">Linkedin</a>
                    </div>
                  </div>
                </div>
					</div>
				</div>
				
              
                <div class="contact-form-container">
<div id="hubspot-form-container"></div>
<script src="//js.hsforms.net/forms/embed/v2.js"></script>
<script>
  hbspt.forms.create({
    portalId: "6491656",
    formId: "32c0eab7-ab42-488e-b931-35b71d970c73",
    region: "na1",
    target: "#hubspot-form-container"
  });
</script>




                </div>
				
				<div class="subtitle__address_contact__mobile" style="display:none;">
					 <div class="address">
                  <?php echo $company_name; ?><br /><?php echo $building_address; ?><br />
                  <?php echo $street; ?><br />
                  <?php echo $city; ?> <?php echo $pin_code; ?><br />
                  <?php echo $country; ?>
                </div>
				
				<div class="contact-social">
                  <div class="contact-social-content">
                    <div class="flex flex-col">
                      <a href="tel:<?php echo $phone; ?>" class="anchor"><?php echo $phone; ?></a>
                      <a href="mailto:<?php echo $email; ?>" class="anchor"><?php echo $email; ?></a>
                    </div>
                    <div class="menu-social flex flex-col">
                      <a href="<?php echo $instagram; ?>" class="anchor" target="_blank" >Instagram</a>
                      <a href="<?php echo $linkedin; ?>" class="anchor" target="_blank">Linkedin</a>
                    </div>
                  </div>
                </div>
					</div>
                
              
            </div>
          </section>
<script>
const menu = document.querySelector('.burger-menu')
		if(menu){
			menu.classList.add('contact-menu-btn')
		}
	
// 	const form = document.querySelector("form");
// 	form.addEventListener("submit", function(event) {
//     event.preventDefault();
//     const formInputs = document.querySelectorAll("input");
// 		console.log(formInputs);
		
// 		alert("Helo Form Submit")
// 		formInputs.forEach((entry)=>{
// 			entry.style.display = "none";
// 		})
//   });

</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Success: Email sent
    document.addEventListener('wpcf7mailsent', function (event) {
      console.log('Success!', event.detail);
		const message = document.querySelector(".wpcf7-response-output");
		const inputsFields = document.querySelectorAll("input");
		const submitButton = document.querySelector("form button");
		submitButton.style.display = "none";
		message.classList.add("class-thanks-message");
		inputsFields.forEach((entry)=>{
			entry.style.display = "none";
		})
    }, false);

    // Validation error
    document.addEventListener('wpcf7invalid', function (event) {
		
		message.classList.remove("class-thanks-message");
    }, false);

    // Server error
    document.addEventListener('wpcf7mailfailed', function (event) {
      console.log('Server mail failed', event.detail);
		
		message.classList.remove("class-thanks-message");
    }, false);
  });
</script>

<?php get_footer(); ?>