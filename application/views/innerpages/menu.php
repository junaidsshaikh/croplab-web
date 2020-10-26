<nav class="mainmenu_wrapper">
    <ul class="mainmenu nav sf-menu">
    	<?php
			$uri=$this->uri->segment(1);
        	if($uri==""){
				$uri="english";
			}
		?>
        <li class="active">
            <a href="<?php echo base_url()?><?php echo $uri?>/home"><?php echo $this->lang->line('menu_link_home')?></a>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $uri?>/about"><?php echo $this->lang->line('menu_link_about_us')?></a>
        </li>
        <!-- eof pages -->
        <li>
            <a href="<?php echo base_url()?><?php echo $uri?>/gallary"><?php echo $this->lang->line('menu_link_gallary')?></a>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $uri?>/sampling"><?php echo $this->lang->line('menu_link_sampling')?></a>
        </li>
        <li>
            <a href="#"><?php echo $this->lang->line('menu_link_portfolio')?></a>
            <ul>
                <li><a href="<?php echo base_url()?><?php echo $uri?>/services"><?php echo $this->lang->line('menu_link_services')?></a></li>
                <li><a href="<?php echo base_url()?><?php echo $uri?>/testimonials"><?php echo $this->lang->line('menu_link_testimonials')?></a></li>
            </ul>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $uri?>/downloads"><?php echo $this->lang->line('menu_link_downloads')?></a>
        </li>
        <li>
            <a href="<?php echo base_url()?><?php echo $uri?>/downloads"><?php echo $this->lang->line('menu_link_contact')?></a>
            <!-- eof mega menu -->
        </li>
        <!-- eof features -->
    </ul>
</nav>
