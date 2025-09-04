<template>
 <div class="content_holder">

		<section class="top_content header-334065 clearfix"><div class="google_map_holder" data-scope="#map-334065-636412" data-bw="">

			<div id="map-334065-636412" class="google_map"></div>
		

		</div></section>		
			<div class="content_second_background">
				<div class="content_area clearfix"> 
		

													 
	<div id="row-334065-1" class="content_block_background template_builder "> 
			<section class="content_block clearfix"><section id="row-334065-1-content" class="content full  clearfix"><section class="info_bar clearfix only_breadcrumb"><section class="breadcrumb"><div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="icon-home" href="../index.html" itemprop="url"><span itemprop="title" title="Unique Construction &amp; Contracting LLC">Home</span></a> <span class="icon-angle-right"></span> 
<div itemscope itemprop="child" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title" title="Contact Us">Contact Us</span>
						<meta itemprop="name" content="Contact Us">
						<meta itemprop="url" content="https://uniqueom.com/contact-us-2/">
						</div></div></section></section><div class="row clearfix"><div class="box three ">	 
	 
		<h3 class="featured_article_title">HEAD OFFICE</h3><div class="space margin-b20"></div>
		<ul class="with_icons default " data-rt-animation-group="group">
		 <li class="box one first last" data-rt-animate="animate" data-rt-animation-type="fadeInDown"><span class="icon-home icon"></span> <p>MOD PF BUILDING (Khimji's Building),  Building NO-782, Way NO- 2911 PO BOX-3289 PC- 112 Rex Road next to Pizza hut, near muscat bakery.</p></li> <li class="box one first last" data-rt-animate="animate" data-rt-animation-type="fadeInDown"><span class="icon-mail icon"></span> <p><a href="../cdn-cgi/l/email-protection.html" class="__cf_email__" data-cfemail="fb92959d94bb8e95928a8e9e9496d5989496">[email&#160;protected]</a></p></li> <li class="box one first last" data-rt-animate="animate" data-rt-animation-type="fadeInDown"><span class="icon-phone icon"></span> <p>+968-24782898</p></li> <li class="box one first last" data-rt-animate="animate" data-rt-animation-type="fadeInDown"><span class="icon-print-1 icon"></span> <p>+968-24782899 </p></li>
		</ul>
	</div><div class="box two-three "><div class="clear"></div><h3 class="featured_article_title">Contact Form</h3><div class="space margin-b20"></div><p><i class="decs_text">Description</i></p>
		<!-- contact form -->
		<div class="contact_form dynamic-class-177448" data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single">
		<div class="clear"></div><div class="result"></div>
			<form action="#" name="contact_form" class="validate_form rt_form" method="post" role="form" >
				<ul>
					<li><label for="name">Your Name: (*)</label><input id="name" type="text" name="name" value="" class="required" /> </li>
					<li><label for="email">Your Email: (*)</label><input id="email" type="text" name="email" value="" class="required email" /> </li>
					<li><label for="message">Your Message: (*)</label><textarea id="message" name="message" rows="8" cols="40" class="required"></textarea></li>
					<li class="security-question"><label class="math_label" for="math">Security Question:</label>5 + 35 = <input id="math" placeholder="?" type="text" name="math" value="" class="required" /></li>
					<li>
					<input type="hidden" name="your_email" value="cm9iaW5AdW5pcXVlb20uY29t">
					<input type="hidden" name="dynamic_class" value="dynamic-class-177448">
					<input type="hidden" name="rt_form_data" value="NDA=">
					<input type="submit" class="button" value="Send"  /><span class="loading"></span></li>
				</ul>
			</form>
		</div><div class="clear"></div>
		<!-- /contact form -->
	 </div></div></section></section></div>
							
	
				</div><!-- / end div .content_area -->  

				<div class="content_footer footer_widgets_holder footer-334065"><section class="footer_widgets clearfix footer-widgets-334065 clearfix"><div class="row clearfix footer_widgets_row"><div id="footer-column-1" class="box three"></div><div id="footer-column-2" class="box three"><div class="box one footer clearfix widget widget_text">			<div class="textwidget"></div>
		</div></div><div id="footer-column-3" class="box three"></div></div></section></div>

	        </div><!-- / end div .content_second_background -->  
	    </div>
</template>

<script>
export default {
  mounted() {
    this.$nextTick(() => {
      // Initialize FlexSlider (moved from inline script inside template)
      try {
        jQuery("#slider-562252").flexslider({
          animation: "slide",
          controlsContainer: "#slider-562252 .flex-nav-container",
          slideshow: true,
          slideshowSpeed: 8 * 1000,
          smoothHeight: true,
          directionNav: true,
          controlNav: false,
          prevText: '<span class="icon-left-open"></span>',
          nextText: '<span class="icon-right-open"></span>',
          start: function (slider) {
            slider.parents(".flex-container:eq(0)").removeAttr("style");
            if (typeof jQuery.waypoints === "function")
              jQuery.waypoints("refresh");
          },
          after: function () {
            if (typeof jQuery.waypoints === "function")
              jQuery.waypoints("refresh");
          },
        });
      } catch (e) {
        // ignore if flexslider not available yet
      }

      // Initialize testimonial carousel (moved from inline script inside template)
      try {
        if (jQuery("#testimonial-carousel-166114-155252").length) {
          jQuery("#testimonial-carousel-166114-155252").rt_start_carousels(
            1,
            ""
          );
        }
      } catch (e) {
        // ignore if carousel plugin not available yet
      }
    });
  },
};
</script>

<style></style>
