<section class="page_breadcrumbs ds parallax section_padding_top_40 section_padding_bottom_40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><?php echo $this->lang->line('contact_us_heading');?></h2>
                <ol class="breadcrumb greylinks color4">
                    <li>
                        <a href="<?php echo base_url().$this->uri->segment(1);?>/home">
                            Home
                        </a>
                    </li>
                    <li class="active"><?php echo $this->lang->line('contact_us_heading');?></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="ls section_padding_top_130 section_padding_bottom_150">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <section id="map" class="ls ms" data-address="Terracina, LT, Italia">
                    <!-- marker description and marker icon goes here -->
                    <div class="map_marker_description">
                        <h3>CROPLAB</h3>
                        <p>Vanita Agrochem (I) Pvt. Ltd</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2650.0554020504833!2d73.89083905331007!3d20.061150632166175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bddc3d45ce3c47b%3A0xb412431c65e5b215!2sVanita%20Agrochem%20(I)%20Pvt.%20Ltd%20Nashik%20Lab!5e0!3m2!1sen!2sin!4v1603798556473!5m2!1sen!2sin" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </section>
            </div>
        </div>
        <!--<div class="row topmargin_40">
            <div class="col-sm-4 to_animate" data-animation="pullDown">
                <div class="teaser text-center">
                    <div class="teaser_icon highlight size_normal"><i class="rt-icon2-phone5"></i></div>
                    <p>
                        <span class="grey">Phone:</span> 968 944 1133<br />
                    </p>
                </div>
            </div>
            <div class="col-sm-4 to_animate" data-animation="pullDown">
                <div class="teaser text-center">
                    <div class="teaser_icon highlight size_normal"><i class="rt-icon2-location2"></i></div>
                    <p>
                        Vanita Agrochem (I) Pvt. Ltd Nashik Lab
Jaulakedindori, Nashik, Maharashtra, 422206
                    </p>
                </div>
            </div>
            <div class="col-sm-4 to_animate" data-animation="pullDown">
                <div class="teaser text-center">
                    <div class="teaser_icon highlight size_normal"><i class="rt-icon2-mail"></i></div>
                    <p><a href="mailto:croplabnsk@vanitaagro.com ">croplabnsk@vanitaagro.com </a></p>
                </div>
            </div>
        </div>-->
        <div class="row topmargin_40">
            <div class="col-sm-6 to_animate">
            	<div class="col-sm-12 to_animate" data-animation="pullDown">
                    <div class="teaser text-center">
                        <div class="teaser_icon highlight size_normal"><i class="rt-icon2-phone5"></i></div>
                        <p>
                            <span class="grey">Phone:</span> 968 944 1133<br />
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 to_animate" data-animation="pullDown">
                    <div class="teaser text-center">
                        <div class="teaser_icon highlight size_normal"><i class="rt-icon2-location2"></i></div>
                        <p>
                            Vanita Agrochem (I) Pvt. Ltd Nashik Lab
    Jaulakedindori, Nashik, Maharashtra, 422206
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 to_animate" data-animation="pullDown">
                    <div class="teaser text-center">
                        <div class="teaser_icon highlight size_normal"><i class="rt-icon2-mail"></i></div>
                        <p><a href="mailto:croplabnsk@vanitaagro.com ">croplabnsk@vanitaagro.com </a></p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 to_animate">
            			<?php 
							/*if($message = $this->session->flashdata('error_message')) {
								showErrorMessage($message);
							} 
							if($message = $this->session->flashdata('success_message')) {
								showSuccessMessage($message);
							}*/
						?>
                <form method="post" action="<?php echo base_url('contact/contact/send_feedback'); ?>">
                    <div class="row" >
                    	<div class="col-sm-3"></div>
                        <div class="col-sm-12">
                            <p class="form-group">
                                <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name" />
                            </p>
                            <p class="form-group">
                                <input type="number" aria-required="true" size="30" maxlength="10" value="" name="mobile" id="mobile" class="form-control" placeholder="Mobile No." />
                            </p>
                            <p class="contact-form-message form-group">
                                <textarea aria-required="true" rows="3" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" align="center">
                           <button type="submit" id="contact_form_submit" name="contact_submit" class="color1 margin_0">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
