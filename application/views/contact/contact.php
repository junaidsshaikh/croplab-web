<section class="page_breadcrumbs ds parallax section_padding_top_40 section_padding_bottom_40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><?php echo $this->lang->line('contact_us_heading');?></h2>
                <ol class="breadcrumb greylinks color4">
                    <li>
                        <a href="index-2.html">
                            Home
                        </a>
                    </li>
                    <li><a href="#">Pages</a></li>
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
                        <h3>Map Title</h3>
                        <p>Map description text</p>
                        <!-- <img class="map_marker_icon" src="images/map_marker_icon.png" alt=""> -->
                    </div>
                </section>
            </div>
        </div>
        <div class="row topmargin_40">
            <div class="col-sm-4 to_animate" data-animation="pullDown">
                <div class="teaser text-center">
                    <div class="teaser_icon highlight size_normal"><i class="rt-icon2-phone5"></i></div>
                    <p>
                        <span class="grey">Phone:</span> +12 345 678 9123<br />
                        <span class="grey">Fax:</span> +12 345 678 9123
                    </p>
                </div>
            </div>
            <div class="col-sm-4 to_animate" data-animation="pullDown">
                <div class="teaser text-center">
                    <div class="teaser_icon highlight size_normal"><i class="rt-icon2-location2"></i></div>
                    <p>
                        PO Box 54378<br />
                        4321 Your Address,<br />
                        Your City, Your Country
                    </p>
                </div>
            </div>
            <div class="col-sm-4 to_animate" data-animation="pullDown">
                <div class="teaser text-center">
                    <div class="teaser_icon highlight size_normal"><i class="rt-icon2-mail"></i></div>
                    <p>support@yourname.com</p>
                </div>
            </div>
        </div>
        <div class="row topmargin_40">
            <div class="col-sm-12 to_animate">
                <form class="contact-form columns_padding_5" method="post" action="http://webdesign-finder.com/html/canabia/">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="form-group">
                                <label for="name">Full Name <span class="required">*</span></label> <i class="fa fa-user highlight" aria-hidden="true"></i>
                                <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name" />
                            </p>
                            <p class="form-group">
                                <label for="email">Email address<span class="required">*</span></label> <i class="fa fa-envelope highlight" aria-hidden="true"></i>
                                <input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Email Address" />
                            </p>
                            <p class="form-group">
                                <label for="subject">Subject<span class="required">*</span></label> <i class="fa fa-flag highlight" aria-hidden="true"></i>
                                <input type="text" aria-required="true" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Subject" />
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="contact-form-message form-group">
                                <label for="message">Message</label> <i class="fa fa-comment highlight" aria-hidden="true"></i>
                                <textarea aria-required="true" rows="3" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="contact-form-submit text-center topmargin_10"><button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button color1 margin_0">Send Message</button></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
