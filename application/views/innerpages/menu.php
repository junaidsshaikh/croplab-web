<nav class="mainmenu_wrapper">
    <ul class="mainmenu nav sf-menu">
        <li class="active">
            <a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/home"><?php echo $this->lang->line('menu_link_home')?></a>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/about"><?php echo $this->lang->line('menu_link_about_us')?></a>
        </li>
        <!-- eof pages -->
        <li>
            <a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/gallary"><?php echo $this->lang->line('menu_link_gallary')?></a>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/sampling"><?php echo $this->lang->line('menu_link_sampling')?></a>
        </li>
        <li>
            <a href="#"><?php echo $this->lang->line('menu_link_portfolio')?></a>
            <ul>
                <li><a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/services"><?php echo $this->lang->line('menu_link_services')?></a></li>
                <li><a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/testimonials"><?php echo $this->lang->line('menu_link_testimonials')?></a></li>
            </ul>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/downloads"><?php echo $this->lang->line('menu_link_downloads')?></a>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $this->uri->segment(1)?>/downloads"><?php echo $this->lang->line('menu_link_contact')?></a>
            <!-- eof mega menu -->
        </li>
        <!-- eof features -->
    </ul>
</nav>
