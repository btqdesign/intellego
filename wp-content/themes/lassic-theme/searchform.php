<?php 
/**
 * The template for displaying Search Form
 */
global $cs_theme_options
?>
<div class="cs-search-area">
<form method="get" action="<?php echo home_url()?>" role="search">
	<i class="icon-search6"></i>
    <input type="text" class="form-control" onfocus="if(this.value =='<?php  _e('Buscar, Company','lassic');?>') { this.value = ''; }" onblur="if(this.value == '') { this.value ='<?php  _e('Buscar','lassic');?>'; }" value="<?php  _e('Buscar','lassic');?>" name="s" id="s">
    <label>
        <input type="submit" class="btnsubmit cs-bg-color" value="Search">
    </label>
</form>
</div>