@extends('frontend.layouts.frontend')
@section('content')
    <div class="content_holder">
        <section class="top_content header-166114 clearfix">
            <div class="flex-container">
                <div class="flexslider" id="slider-562252">
                    <ul class="slides">
                        <li class="stretch" data-sliderminheight="400px" data-flexfirstslide="true">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2018/10/01_Banner.jpg') }}"
                                    alt="" title="" /></div>
                        </li>
                        <li class="stretch">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/02_1.jpg') }}" alt=""
                                    title="" /></div>
                        </li>
                        <li class="stretch">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/03_1.jpg') }}" alt=""
                                    title="" /></div>
                        </li>
                        <li class="stretch">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/04_1.jpg') }}" alt=""
                                    title="" /></div>
                        </li>
                        <li class="stretch">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/DSC3891-1700x800.jpg') }}"
                                    alt="" title="" /></div>
                        </li>
                        <li class="stretch">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/DSC3329-1700x800.jpg') }}"
                                    alt="" title="" /></div>
                        </li>
                        <li class="stretch">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/DSC3193-1700x800.jpg') }}"
                                    alt="" title="" /></div>
                        </li>
                        <li class="stretch">
                            <div class="slide_data"><img
                                    src="{{ asset('assets/frontend/wp-content/uploads/2017/01/DSC_8424_Easy-Resize.com_-1280x800.jpg') }}"
                                    alt="" title="" /></div>
                        </li>
                    </ul>
                </div>
                <div class="flex-nav-container"></div>
            </div>
            <script type="text/javascript">
                /* <![CDATA[ */
                // Flex Slider and Helper Functions
                jQuery(window).load(function() {
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
                        start: function(slider) {
                            slider.parents(".flex-container:eq(0)").removeAttr("style");
                            jQuery.waypoints("refresh");
                        },
                        after: function() {
                            jQuery.waypoints("refresh");
                        },
                    });
                });
                /* ]]> */
            </script>
        </section>
        <div class="content_second_background">
            <div class="content_area clearfix">
                <div id="row-166114-1" class="content_block_background template_builder">
                    <section class="content_block clearfix">
                        <section id="row-166114-1-content" class="content full clearfix">
                            <div id="space-166114-129499" class="clearfix" style="height: 10px"></div>
                            <div class="row clearfix">
                                <div class="box three">
                                    <article id="content-box-166114-179038" class="featured" data-rt-animate="animate"
                                        data-rt-animation-type="fadeIn" data-rt-animation-group="single">
                                        <div class="featured_image_holder rounded_image pin bw_filter">
                                            <a href="major-completed-projects/index.html" title="Major Completed Projects"
                                                target="_self"><img
                                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/03_2-480x400.jpg') }}"
                                                    class="aligncenter" alt="" /></a>
                                        </div>
                                        <div class="space margin-b20"></div>
                                        <div class="caption title_centered">
                                            <h3 class="featured_article_title">
                                                <a href="major-completed-projects/index.html"
                                                    title="Major Completed Projects" target="_self">Major
                                                    Completed Projects</a>
                                            </h3>
                                        </div>
                                        <div class="space margin-b20"></div>
                                    </article>
                                </div>
                                <div class="box three">
                                    <article id="content-box-166114-124580" class="featured" data-rt-animate="animate"
                                        data-rt-animation-type="fadeIn" data-rt-animation-group="single">
                                        <div class="featured_image_holder rounded_image pin bw_filter">
                                            <a href="on-going-projects/index.html" title="Ongoing Projects"
                                                target="_self"><img
                                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/04/DSC_4654-480x480.jpg') }}"
                                                    class="aligncenter" alt="" /></a>
                                        </div>
                                        <div class="space margin-b20"></div>
                                        <div class="caption title_centered">
                                            <h3 class="featured_article_title">
                                                <a href="on-going-projects/index.html" title="Ongoing Projects"
                                                    target="_self">Ongoing Projects</a>
                                            </h3>
                                        </div>
                                        <div class="space margin-b20"></div>
                                    </article>
                                </div>
                                <div class="box three">
                                    <article id="content-box-166114-43581" class="featured" data-rt-animate="animate"
                                        data-rt-animation-type="fadeIn" data-rt-animation-group="single">
                                        <div class="featured_image_holder rounded_image pin bw_filter">
                                            <a href="key-projects/index.html" title="Key Projects" target="_blank"><img
                                                    src="{{ asset('assets/frontend/wp-content/uploads/2015/02/DSC3009-480x480.jpg') }}"
                                                    class="aligncenter" alt="" /></a>
                                        </div>
                                        <div class="space margin-b20"></div>
                                        <div class="caption title_centered">
                                            <h3 class="featured_article_title">
                                                <a href="key-projects/index.html" title="Key Projects"
                                                    target="_blank">Key Projects</a>
                                            </h3>
                                        </div>
                                        <div class="space margin-b20"></div>
                                    </article>
                                </div>
                            </div>
                            <div id="space-166114-131353" class="clearfix" style="height: 10px"></div>
                            <div class="row clearfix">
                                <div class="title_line margin-b20">
                                    <h3 class="featured_article_title" data-rt-animate="animate"
                                        data-rt-animation-type="fade" data-rt-animation-group="single">
                                        Major Completed Projects
                                    </h3>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div id="portfolio-166114-65102" class="portfolio_holder clearfix"
                                    data-rt-animate="animate" data-rt-animation-type="fadeIn"
                                    data-rt-animation-group="single">
                                    <ul class="portfolio_boxes fluid fixed" data-filter="4">
                                        <li class="box four first completed-projects projects">
                                            <div class="portfolio_item_holder">
                                                <!-- portfolio image -->
                                                <div class="featured_image">
                                                    <div class="imgeffect">
                                                        <a id="lightbox-556015" class="icon-zoom-in lightbox_"
                                                            data-group="portfolio" title="Enlarge Image"
                                                            data-title="Residential Apartments Building for Inma @ Al Gubrah &#8211; J257"
                                                            data-description=""
                                                            data-thumbnail="https://uniqueom.com/wp-content/uploads/2018/09/J-257-INMA-Ghubrah-Residential-View-1-75x50.jpg"
                                                            data-thumbTooltip="" data-scaleUp="" data-href=""
                                                            data-width="" data-height="" data-flashHasPriority=""
                                                            data-poster="" data-autoplay="" data-audiotitle=""
                                                            href="{{ asset('assets/frontend/wp-content/uploads/2018/09/J-257-INMA-Ghubrah-Residential-View-1.jpg') }}"></a>
                                                        <a href="portfolio/residential-apartments-building-for-inma-al-gubrah-j257/index.html"
                                                            target="_self" class="icon-link"
                                                            title="Residential Apartments Building for Inma @ Al Gubrah &#8211; J257"
                                                            rel="bookmark"></a>
                                                        <img src="{{ asset('assets/frontend/wp-content/uploads/2018/09/J-257-INMA-Ghubrah-Residential-View-1-480x270.jpg') }}"
                                                            alt="" class="" />
                                                    </div>
                                                </div>
                                                <div class="portfolio_info">
                                                    <!-- title-->
                                                    <h4>
                                                        <a href="portfolio/residential-apartments-building-for-inma-al-gubrah-j257/index.html"
                                                            target="_self"
                                                            title="Residential Apartments Building for Inma @ Al Gubrah &#8211; J257"
                                                            rel="bookmark">Residential Apartments Building for Inma
                                                            @ Al Gubrah &#8211; J257</a>
                                                    </h4>
                                                    <!-- text-->
                                                </div>
                                            </div>
                                        </li>
                                        <li class="box four key-projects completed-projects projects">
                                            <div class="portfolio_item_holder">
                                                <!-- portfolio image -->
                                                <div class="featured_image">
                                                    <div class="imgeffect">
                                                        <a id="lightbox-555998" class="icon-zoom-in lightbox_"
                                                            data-group="portfolio" title="Enlarge Image"
                                                            data-title="The Links by BADR Residential cum Commercial Complex &#8211; J243"
                                                            data-description=""
                                                            data-thumbnail="https://uniqueom.com/wp-content/uploads/2018/09/DSC_0578-75x50.jpg"
                                                            data-thumbTooltip="" data-scaleUp="" data-href=""
                                                            data-width="" data-height="" data-flashHasPriority=""
                                                            data-poster="" data-autoplay="" data-audiotitle=""
                                                            href="{{ asset('assets/frontend/wp-content/uploads/2018/09/DSC_0578.jpg') }}"></a>
                                                        <a href="portfolio/the-links-by-badr-residential-cum-commercial-complex-j243/index.html"
                                                            target="_self" class="icon-link"
                                                            title="The Links by BADR Residential cum Commercial Complex &#8211; J243"
                                                            rel="bookmark"></a>
                                                        <img src="{{ asset('assets/frontend/wp-content/uploads/2018/09/DSC_0578-480x319.jpg') }}"
                                                            alt="" class="" />
                                                    </div>
                                                </div>
                                                <div class="portfolio_info">
                                                    <!-- title-->
                                                    <h4>
                                                        <a href="portfolio/the-links-by-badr-residential-cum-commercial-complex-j243/index.html"
                                                            target="_self"
                                                            title="The Links by BADR Residential cum Commercial Complex &#8211; J243"
                                                            rel="bookmark">The Links by BADR Residential cum
                                                            Commercial Complex &#8211; J243</a>
                                                    </h4>
                                                    <!-- text-->
                                                </div>
                                            </div>
                                        </li>
                                        <li class="box four completed-projects">
                                            <div class="portfolio_item_holder">
                                                <!-- portfolio image -->
                                                <div class="featured_image">
                                                    <div class="imgeffect">
                                                        <a id="lightbox-729838" class="icon-zoom-in lightbox_"
                                                            data-group="portfolio" title="Enlarge Image"
                                                            data-title="INDIAN SCHOOL AT WADI KABIR (J236)"
                                                            data-description=""
                                                            data-thumbnail="https://uniqueom.com/wp-content/uploads/2017/01/DSC_4841_Easy-Resize.com_-75x50.jpg"
                                                            data-thumbTooltip="" data-scaleUp="" data-href=""
                                                            data-width="" data-height="" data-flashHasPriority=""
                                                            data-poster="" data-autoplay="" data-audiotitle=""
                                                            href="{{ asset('assets/frontend/wp-content/uploads/2017/01/DSC_4841_Easy-Resize.com_.jpg') }}"></a>
                                                        <a href="portfolio/indian-school-at-wadi-kabir-j236/index.html"
                                                            target="_self" class="icon-link"
                                                            title="INDIAN SCHOOL AT WADI KABIR (J236)" rel="bookmark"></a>
                                                        <img src="{{ asset('assets/frontend/wp-content/uploads/2017/01/DSC_4841_Easy-Resize.com_-480x319.jpg') }}"
                                                            alt="" class="" />
                                                    </div>
                                                </div>
                                                <div class="portfolio_info">
                                                    <!-- title-->
                                                    <h4>
                                                        <a href="portfolio/indian-school-at-wadi-kabir-j236/index.html"
                                                            target="_self" title="INDIAN SCHOOL AT WADI KABIR (J236)"
                                                            rel="bookmark">INDIAN SCHOOL AT WADI KABIR (J236)</a>
                                                    </h4>
                                                    <!-- text-->
                                                </div>
                                            </div>
                                        </li>
                                        <li class="box four last completed-projects">
                                            <div class="portfolio_item_holder">
                                                <!-- portfolio image -->
                                                <div class="featured_image">
                                                    <div class="imgeffect">
                                                        <a id="lightbox-210838" class="icon-zoom-in lightbox_"
                                                            data-group="portfolio" title="Enlarge Image"
                                                            data-title="RESIDENTIAL/COMMERCIAL-BUILDING AT SHATTI AL QURUM (J216)"
                                                            data-description=""
                                                            data-thumbnail="https://uniqueom.com/wp-content/uploads/2017/01/DSC_4964_Easy-Resize.com_-e1485699642693.jpg"
                                                            data-thumbTooltip="" data-scaleUp="" data-href=""
                                                            data-width="" data-height="" data-flashHasPriority=""
                                                            data-poster="" data-autoplay="" data-audiotitle=""
                                                            href="{{ asset('assets/frontend/wp-content/uploads/2017/01/DSC_4964_Easy-Resize.com_-e1485699642693.jpg') }}"></a>
                                                        <a href="portfolio/residentialcommercial-building-at-shatti-al-qurum-j216/index.html"
                                                            target="_self" class="icon-link"
                                                            title="RESIDENTIAL/COMMERCIAL-BUILDING AT SHATTI AL QURUM (J216)"
                                                            rel="bookmark"></a>
                                                        <img src="{{ asset('assets/frontend/wp-content/uploads/2017/01/DSC_4964_Easy-Resize.com_-e1485699642693-480x380.jpg') }}"
                                                            alt="" class="" />
                                                    </div>
                                                </div>
                                                <div class="portfolio_info">
                                                    <!-- title-->
                                                    <h4>
                                                        <a href="portfolio/residentialcommercial-building-at-shatti-al-qurum-j216/index.html"
                                                            target="_self"
                                                            title="RESIDENTIAL/COMMERCIAL-BUILDING AT SHATTI AL QURUM (J216)"
                                                            rel="bookmark">RESIDENTIAL/COMMERCIAL-BUILDING AT
                                                            SHATTI AL QURUM (J216)</a>
                                                    </h4>
                                                    <!-- text-->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="box one">
                                    <div id="space-166114-110514" class="clearfix" style="height: 30px"></div>
                                    <div class="title_line margin-b20">
                                        <h3 class="featured_article_title" data-rt-animate="animate"
                                            data-rt-animation-type="fade" data-rt-animation-group="single">
                                            <span class="icon-mic heading_icon"></span> About Unique Contracting
                                            Co. LLC
                                        </h3>
                                    </div>
                                    <section id="text-box-166114-24149" class="text_box" data-rt-animate="animate"
                                        data-rt-animation-type="fadeIn" data-rt-animation-group="single">
                                        <p>
                                            <strong>Unique Contracting Company L.L.C.</strong> from its
                                            incorporation in 1999, has grown and developed under the
                                            direction of Mr. Manilal H. Limbani, Managing Director to become an
                                            established and recognized organization in all sectors
                                            of the building industry. Projects completed over the past 22 years,
                                            ranging in value from R.O. 1 million to R.O. 50
                                            million. Unique Construction has extensive experience in encompassing
                                            all sectors of the industrial,commercial buildings and
                                            large scale residential developments.
                                        </p>
                                    </section>
                                    <div id="space-166114-115052" class="clearfix" style="height: 30px"></div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="box one">
                                    <div id="space-166114-43877" class="clearfix" style="height: 10px"></div>
                                    <div class="title_line margin-b20">
                                        <h3 class="featured_article_title" data-rt-animate="animate"
                                            data-rt-animation-type="fade" data-rt-animation-group="single">
                                            <span class="icon-volume-up heading_icon"></span> Chairman's Message
                                        </h3>
                                    </div>
                                    <section id="text-box-166114-92483" class="text_box" data-rt-animate="animate"
                                        data-rt-animation-type="fadeIn" data-rt-animation-group="single">
                                        <h3>Greetings to one and all!</h3>
                                        <p>
                                            As history unfolds, Unique Contracting Co. LLC. has carved a perception
                                            of Integrity. Value. Accountability. Quality and
                                            Innovation. Through the application of these principles, we continue to
                                            provide value to our clients and we will
                                            consistently meet our purpose: <strong>Together Building Value Everyday.
                                            </strong>Our services and expertise have been
                                            proven through the years as our capabilities extend from the most
                                            complex projects to the simplest.
                                        </p>
                                        <p>
                                            At this juncture, i would like to point out that being one of the prime
                                            movers for making the company as one of the leading
                                            firsm in the field of construction that we will actively persue
                                            diversity in our workplace. The markets we serve and the
                                            services we provide.
                                        </p>
                                    </section>
                                    <div id="space-166114-158231" class="clearfix" style="height: 30px"></div>
                                </div>
                            </div>
                        </section>
                    </section>
                </div>
                <div id="row-166114-2" class="content_block_background template_builder row-style-2">
                    <section class="content_block clearfix">
                        <section id="row-166114-2-content" class="content full clearfix">
                            <div class="row clearfix">
                                <div class="row clearfix">
                                    <div id="testimonial-carousel-166114-155252"
                                        class="carousel-holder clearfix without_heading" data-rt-animate="animate"
                                        data-rt-animation-type="fadeIn" data-rt-animation-group="single">
                                        <section class="carousel_items clearfix">
                                            <div class="owl-carousel">
                                                <div class="testimonial item">
                                                    <div class="client_image gradient">
                                                        <img src="{{ asset('assets/frontend/wp-content/uploads/2014/01/vision1.png') }}"
                                                            alt="" class="" />
                                                    </div>
                                                    <div class="text with_image">
                                                        <p>
                                                            <span class="icon-quote-left"></span>
                                                            Unique Contracting Company LLC aims to make valued
                                                            contributions to our client's need and satisfaction.
                                                            This will be
                                                            attained by collaborative efforts and exemplary
                                                            performance by having qualified staff with innovative
                                                            and creatie
                                                            ideas and skills that are paramount to the successful
                                                            implementation of our mission.
                                                            <span class="icon-quote-right"></span>
                                                        </p>
                                                        <div class="client_info"></div>
                                                    </div>
                                                </div>
                                                <div class="testimonial item">
                                                    <div class="client_image gradient">
                                                        <img src="{{ asset('assets/frontend/wp-content/uploads/2014/01/Mission123.jpg') }}"
                                                            alt="" class="" />
                                                    </div>
                                                    <div class="text with_image">
                                                        <p>
                                                            <span class="icon-quote-left"></span>
                                                            We will continue to guide, support and meet the changing
                                                            needs of our clients to maintain our impeccable
                                                            reputation
                                                            built on performance. <span class="icon-quote-right"></span>
                                                        </p>
                                                        <div class="client_info"></div>
                                                    </div>
                                                </div>
                                                <div class="testimonial item">
                                                    <div class="client_image gradient">
                                                        <img src="{{ asset('assets/frontend/wp-content/uploads/2014/01/Core-Values-400x400.jpg') }}"
                                                            alt="" class="" />
                                                    </div>
                                                    <div class="text with_image">
                                                        <p>
                                                            <span class="icon-quote-left"></span>
                                                            ...نحن "نفعل الشيء الصحيح". شركة المتميز تعد من الأعمال
                                                            التجارية التي بُني أساسهاعلى الثقة
                                                            <span class="icon-quote-right"></span>
                                                        </p>
                                                        <div class="client_info"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    /* <![CDATA[ */
                                    // run carousel
                                    jQuery(document).ready(function() {
                                        jQuery("#testimonial-carousel-166114-155252").rt_start_carousels(1, "");
                                    });
                                    /* ]]> */
                                </script>
                            </div>
                        </section>
                    </section>
                </div>
                <div id="row-166114-149190" class="content_block_background template_builder">
                    <section class="content_block clearfix">
                        <section id="row-166114-149190-content" class="content full clearfix">
                            <div class="row clearfix">
                                <div class="box two-three">
                                    <div class="title_line margin-b20">
                                        <h3 class="featured_article_title" data-rt-animate="animate"
                                            data-rt-animation-type="fade" data-rt-animation-group="single">
                                            <span class="icon-chart-line heading_icon"></span> Why Unique
                                            Construction & Contracting LLC?
                                        </h3>
                                    </div>
                                    <section id="text-box-166114-319345" class="text_box" data-rt-animate="animate"
                                        data-rt-animation-type="fadeIn" data-rt-animation-group="single">
                                        <p>Typically Unique contracting 's services would fall into one or more
                                            combinations of:</p>
                                    </section>
                                    <div id="space-166114-54098" class="clearfix" style="height: 20px"></div>
                                    <div data-rt-animation-group="group" class="rt-toggle">
                                        <ol>
                                            <li data-rt-animate="animate" data-rt-animation-type="fadeInDown">
                                                <div class="toggle-head">
                                                    <div class="toggle-number"><span class="icon-mobile"></span>
                                                    </div>
                                                    <div class="toggle-title">Project Management</div>
                                                </div>
                                                <div class="toggle-content fluid">
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="70">We M/s
                                                                Unique Contracting Company LLC has adopted a unique
                                                                management </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="84">strategy
                                                                of planning, organizing and controlling resources
                                                                with specific procedures </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="85">and
                                                                protocols to achieve the specific project goals in
                                                                scientific manner on a day to </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="10">day
                                                                basis.</span><span class="zw-portion" data-text-len="1">
                                                            </span><span class="zw-portion" data-text-len="70">We
                                                                synchronize the temporary
                                                                nature of the project with the permanent </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="33">nature of
                                                                operations in business.</span><span
                                                                class="EOP EOP-readonly"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li data-rt-animate="animate" data-rt-animation-type="fadeInDown">
                                                <div class="toggle-head">
                                                    <div class="toggle-number"><span class="icon-hospital"></span>
                                                    </div>
                                                    <div class="toggle-title">Construction Management</div>
                                                </div>
                                                <div class="toggle-content fluid">
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="81">The
                                                                construction management is done with developed
                                                                distinct technical skills and </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="83">management
                                                                strategies to achieve the quality in construction
                                                                within the speculated </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="6">time.
                                                            </span><span class="zw-portion" data-text-len="69">We
                                                                emphasize the execution of construction management
                                                                with a goal of </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="29">optimum
                                                                usage of resources. </span><span class="EOP EOP-readonly">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <p>. </p>
                                                </div>
                                            </li>
                                            <li data-rt-animate="animate" data-rt-animation-type="fadeInDown">
                                                <div class="toggle-head">
                                                    <div class="toggle-number"><span class="icon-home"></span>
                                                    </div>
                                                    <div class="toggle-title">Constructing both Residential and
                                                        Commercial buildings</div>
                                                </div>
                                                <div class="toggle-content fluid">
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="81">We plan,
                                                                organize and execute the Commercial and Residential
                                                                projects ranging in </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="43">different
                                                                span on built up area and budget.</span><span
                                                                class="EOP EOP-readonly"> </span>
                                                        </div>
                                                    </div>
                                                    <p>. </p>
                                                </div>
                                            </li>
                                            <li data-rt-animate="animate" data-rt-animation-type="fadeInDown">
                                                <div class="toggle-head">
                                                    <div class="toggle-number"><span class="icon-map"></span>
                                                    </div>
                                                    <div class="toggle-title">General Construction for different
                                                        purposes</div>
                                                </div>
                                                <div class="toggle-content fluid">
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content">
                                                            <span class="zw-portion" data-text-len="79">We have a
                                                                proven expertise is executing the different projects
                                                                like Hospitals, </span>
                                                        </div>
                                                    </div>
                                                    <div class="zw-line-div">
                                                        <div class="zw-line-content"><span class="zw-portion"
                                                                data-text-len="54">Educational institutions.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li data-rt-animate="animate" data-rt-animation-type="fadeInDown">
                                                <div class="toggle-head">
                                                    <div class="toggle-number"><span class="icon-cog-alt"></span>
                                                    </div>
                                                    <div class="toggle-title">Multiple Building Program</div>
                                                </div>
                                                <div class="toggle-content fluid">
                                                    <div class="zw-paragraph" data-width="624">
                                                        <div class="zw-line-div">
                                                            <div class="zw-line-content">
                                                                <span class="zw-portion" data-text-len="18">We
                                                                    have already ma</span><span class="zw-portion"
                                                                    data-text-len="63">de our signature in
                                                                    executing Mixed Amenities Buildings, Group
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="zw-line-div">
                                                            <div class="zw-line-content">
                                                                <span class="zw-portion" data-text-len="56">of
                                                                    residential villas and Commercial building
                                                                    complexes.</span><span class="EOP EOP-readonly">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="zw-paragraph" data-width="624">
                                                        <div class="zw-line-div">
                                                            <div class="zw-line-content"><span class="EOP EOP-readonly">
                                                                </span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="box three">
                                    <div class="row">
                                        <div class="box one">
                                            <!-- blog box-->
                                            <article class="blog_list loop" id="post-3989">
                                                <section class="first_section">
                                                    <div class="date_box"><span class="day">07</span><span
                                                            class="year">Mar 2021</span></div>
                                                </section>
                                                <section class="article_section">
                                                    <div class="blog-head-line clearfix">
                                                        <div class="post-title-holder">
                                                            <!-- blog headline-->
                                                            <h2><a href="hse-buliton/index.html" rel="bookmark">HSE
                                                                    Bulletin</a></h2>
                                                            <!-- / blog headline-->
                                                            <!-- meta data -->
                                                            <div class="post_data">
                                                                <!-- user -->
                                                                <span
                                                                    class="icon-user user margin-right20 vcard author"><span
                                                                        class="fn"><a
                                                                            href="author/siteadmin/index.html"
                                                                            title="Posts by Site Admin"
                                                                            rel="author">Site
                                                                            Admin</a></span></span>
                                                                <!-- categories -->
                                                                <span class="icon-flow-cascade categories"><a
                                                                        href="category/projects/index.html"
                                                                        rel="category tag">Projects</a></span>
                                                            </div>
                                                            <!-- / end div  .post_data -->
                                                            <meta itemprop="name" content="HSE Bulletin" />
                                                            <meta itemprop="datePublished" content="March 7, 2021" />
                                                            <meta itemprop="url" content="hse-buliton/index.html" />
                                                            <meta itemprop="image"
                                                                content="wp-content/uploads/2021/03/Unique.jpg" />
                                                            <meta itemprop="author" content="Site Admin" />
                                                        </div>
                                                        <!-- / end div  .post-title-holder -->
                                                    </div>
                                                    <!-- / end div  .blog-head-line -->
                                                    <div class="imgeffect aligncenter">
                                                        <a id="lightbox-854199" class="icon-zoom-in lightbox_"
                                                            href="{{ asset('assets/frontend/wp-content/uploads/2021/03/Unique.jpg') }}"></a>
                                                        <a href="hse-buliton/index.html" class="icon-link"
                                                            title="HSE Bulletin" rel="bookmark"></a>
                                                        <img src="wp-content/uploads/2021/03/Unique-1040x592.jpg"
                                                            alt="" class="" />
                                                    </div>
                                                </section>
                                            </article>
                                            <!-- / blog box-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </section>
                </div>
            </div>
            <!-- / end div .content_area -->
            <div class="content_footer footer_widgets_holder footer-166114">
                <section class="footer_widgets clearfix footer-widgets-166114 clearfix">
                    <div class="row clearfix footer_widgets_row">
                        <div id="footer-column-1" class="box three"></div>
                        <div id="footer-column-2" class="box three">
                            <div class="box one footer clearfix widget widget_text">
                                <div class="textwidget"></div>
                            </div>
                        </div>
                        <div id="footer-column-3" class="box three"></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
