<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no" />
<meta name="description" content="">
<meta name="author" content="">
<link rel="apple-touch-icon" href="assets/images/favicon/apple-touch-icon.png">
<link rel="icon" href="assets/images/favicon/favicon.png">
<title>Department of Women and Child Development | Home</title>
<!-- Custom styles for this template -->
<link href="{{ asset('home_page/assets/css/base.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/assets/css/base-responsive.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/assets/css/grid.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/assets/css/font.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/assets/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/assets/css/flexslider.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/assets/css/megamenu.css') }}" rel="stylesheet" media="all" />
<link href="{{ asset('home_page/assets/css/print.css') }}" rel="stylesheet" media="print" />
<!-- Theme styles for this template -->
<link href="{{ asset('home_page/assets/css/megamenu.css') }}" rel="stylesheet" media="all" />
<link href="{{ asset('home_page/theme/css/site.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/theme/css/site-responsive.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('home_page/theme/css/ma5gallery.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('home_page/theme/css/print.css') }}" rel="stylesheet" type="text/css" media="print">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
   <script src="assets/js/html5shiv.js"></script>
   <script src="assets/js/respond.min.js"></script>
   <![endif]-->
<!-- Custom JS for this template -->
<noscript>
    <link href="theme/css/no-js.css" type="text/css" rel="stylesheet">
</noscript>
</head>

<body>
    <div id="fb-root"></div>
    <header>
        <div class="region region-header-top">
            <div id="block-cmf-content-header-region-block" class="block block-cmf-content first last odd">
                <div class="wrapper common-wrapper">
                    <div class="container common-container four_content top-header">
                        <div class="common-left clearfix">
                            <ul>
                                <li class="gov-india"><span class="responsive_go_hindi" lang="hi"><a target="_blank" href="https://cgstate.gov.in/" title="छत्तीसगढ़ शासन( बाहरी वेबसाइट जो एक नई विंडो में खुलती है)" role="link">छत्तीसगढ़ शासन</a></span> </li>
                                <li class="ministry"><span class="li_eng responsive_go_eng"><a target="_blank" href="https://cgstate.gov.in/" title="Government of Chhattisgarh,External Link that opens in a new window" role="link">Government of Chhattisgarh</a></span></li>
                            </ul>
                        </div>
                        <div class="common-right clearfix">
                            <ul id="header-nav">
                                <li class="ico-skip cf"><a href="#skipCont" title="">Skip to main content</a>
                                </li>
                                <li class="ico-accessibility cf">
                                    <!-- <a href="javascript:void(0);" id="toggleAccessibility" title="Accessibility Dropdown" role="link">
                                        <img class="top" src="{{ asset('home_page/assets/images/ico-accessibility.png') }}" alt="Accessibility Dropdown" />
                                    </a> -->
                                    <!-- <ul style="visibility: hidden;">
                                        <li> <a onClick="set_font_size(&#39;increase&#39;)" title="Increase font size" href="javascript:void(0);" role="link">A<sup>+</sup>
                                            </a>
                                        </li>
                                        <li> <a onClick="set_font_size()" title="Reset font size" href="javascript:void(0);" role="link">A<sup>&nbsp;</sup></a> </li>
                                        <li> <a onClick="set_font_size(&#39;decrease&#39;)" title="Decrease font size" href="javascript:void(0);" role="link">A<sup>-</sup></a> </li>
                                        <li> <a href="javascript:void(0);" class="high-contrast dark" title="High Contrast" role="link">A</a> </li>
                                        <li> <a href="javascript:void(0);" class="high-contrast light" title="Normal Contrast" style="display: none;" role="link">A</a>
                                        </li>
                                    </ul> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p id="scroll" style="display: none;"><span></span></p>
        </div>
        <!--Top-Header Section end-->
        <section class="wrapper header-wrapper">
            <div class="container common-container four_content header-container">
                <h1 class="logo">
                    <a href="#" title="Home" rel="home" class="header__logo" id="logo">
                        <img src="{{ url('userassets/img/logo.webp') }}" alt="Chhattisgarh Government">
                        <p>महिला एवं बाल विकास विभाग </p>
                        <span>WCD RECRUITMENT</span>
                    </a>
                </h1>
                <div class="header-right clearfix">
                    <div class="right-content clearfix">
                        <div class="float-element">
                            <img src="{{ asset('home_page/assets/images/wcd.png') }}" alt="Chhattisgarh Government" style="height: 90px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/.header-wrapper-->
        <section class="wrapper megamenu-wraper">
            <div class="container common-container four_content">
                <p class="showhide"><em></em><em></em><em></em></p>
                <nav class="main-menu clearfix" id="main_menu">
                    <ul class="nav-menu">
                        <li class="nav-item"> <a href="{{url('/')}}" class="home"><span style="display: none;">home</span><i class="fa fa-home"></i></a> </li>
                        <li class="nav-item"><a href="#">About Us</a></li>
                        <li class="nav-item"><a href="{{url('/contact')}}">Contact</a></li>
                        <li class="nav-item"><a href="{{url('login')}}">Login</a></li>
                    </ul>
                </nav>
                <nav class="main-menu clearfix" id="overflow_menu">
                    <ul class="nav-menu clearfix">
                    </ul>
                </nav>
            </div>
            <style type="text/css">
                body~.sub-nav {
                    right: 0
                }
            </style>
        </section>
    </header>
    <!--/.nav-wrapper-->
    <section class="wrapper banner-wrapper">
        <div id="flexSlider" class="flexslider">
            <ul class="slides">
                <li> <img src="{{ asset('home_page/theme/images/banner/slider-1.png') }}" alt="slide 1"></li>
                {{-- <li> <img src="{{ asset('home_page/theme/images/banner/slider-2.jpg') }}" alt="slide 1"></li> --}}
            </ul>
        </div>
    </section>
    <div class="wrapper" id="skipCont"></div>
    <!--/#skipCont-->
    <section id="fontSize" class="wrapper body-wrapper ">

        <div class="bg-wrapper top-bg-wrapper gray-bg padding-top-bott">
            <div class="container common-container four_content body-container top-body-container padding-top-bott2">
                <div class="minister clearfix">
                    <div class="minister-box clearfix">
                        <div class="minister-sub">
                            <div class="minister-image"><img src="{{ asset('home_page/assets/images/cm.jpg') }}" alt="minister"></div>
                            <div class="min-info">
                                <h3>
                                    <a href="#">श्री विष्णु देव साय </a></h4>
                                    <h4>माननीय मुख्यमंत्री </h4>
                                    <p>छत्तीसगढ़ शासन</p>
                            </div>
                        </div>
                        <div class="minister-sub">
                            <div class="minister-image"><img src="{{ asset('home_page/assets/images/hm.jpg') }}" alt="state minister"></div>
                            <div class="min-info">
                                <h3>
                                    <a href="#">श्रीमती लक्ष्मी राजवाड़े</a></h4>
                                    <h4>माननीय मंत्री </h4>
                                    <p>महिला एवं बाल विकास विभाग</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="left-block">
                    <h2>आंगनबाड़ी भर्ती प्रक्रिया</h2>
                    <p style="text-align: justify">आंगनबाड़ी भर्ती प्रक्रिया राज्य सरकारों द्वारा संचालित की जाती है। विभिन्न राज्यों में भर्ती प्रक्रिया और मानदंड अलग-अलग हो सकते हैं।
                    <p><strong>भर्ती प्रक्रिया के चरण:</strong></p>
                    <p style="text-align: justify;"><strong>सूचना और आवेदन:</strong> भर्ती की सूचना संबंधित राज्य की आधिकारिक वेबसाइट या स्थानीय समाचार पत्रों में प्रकाशित की जाती है। उम्मीदवारों को आवेदन पत्र भरना होता है और आवश्यक दस्तावेजों के साथ जमा करना होता है।क्रिया और मानदंड अलग-अलग हो सकते हैं।
                    <p style="text-align: justify;"><strong>योग्यता:</strong> उम्मीदवारों की योग्यता की जांच की जाती है। अधिकांश राज्यों में उम्मीदवार को स्थानीय निवासी होना चाहिए और उसकी आयु सीमा 18-35 वर्ष के बीच होनी चाहिए। शैक्षिक योग्यता आमतौर पर 10वीं पास या उससे ऊपर हो सकती है।
                    <p style="text-align: justify;"><strong>लिखित परीक्षा/साक्षात्कार:</strong> कुछ राज्यों में लिखित परीक्षा या साक्षात्कार का आयोजन किया जाता है ताकि उम्मीदवारों की योग्यता और क्षमता का मूल्यांकन किया जा सके।वेजों के साथ जमा करना होता है।क्रिया और मानदंड अलग-अलग हो सकते हैं।
                    <p style="text-align: justify;"><strong>मेरिट लिस्ट:</strong> योग्य उम्मीदवारों की मेरिट लिस्ट तैयार की जाती है और चयनित उम्मीदवारों की सूची प्रकाशित की जाती है।
                    </p>
                    <p style="text-align: justify;"><strong>प्रशिक्षण:</strong> चयनित उम्मीदवारों को आंगनबाड़ी कार्यकर्ता के रूप में कार्य करने के लिए आवश्यक प्रशिक्षण दिया जाता है।
                    </p>
                    <hr>
                    <h2>आवेदन कैसे करें?</h2>
                    <p>आवेदन भरने हेतु दिशा निर्देश</p>
                    <p>ऑनलाइन आवेदन करने के लिए निम्नलिखित चरणों का पालन करें:</p>
                    <p style="text-align: justify">
                        <i class="fa fa-check text-primary mr-3"></i>ऑनलाइन आवेदन करने हेतु सर्वप्रथम signup करें |
                    </p>
                    <p style="text-align: justify;">
                        <i class="fa fa-check text-primary mr-3"></i>इसके उपरांत लॉग इन करने के लिए अपना यूजर आई डी एवं पासवर्ड दर्ज करें |
                    </p>
                    <p style="text-align: justify;">
                        <i class="fa fa-check text-primary mr-3"></i>लॉग इन करने के उपरान्त Apply Now पर क्लिक करें |
                    </p>
                    <p style="text-align: justify;">
                        <i class="fa fa-check text-primary mr-3"></i>आपके समक्ष विज्ञापन की सूची आ जावेगी |
                    </p>
                    <p style="text-align: justify;">
                        <i class="fa fa-check text-primary mr-3"></i>आपको जिस विज्ञप्ति के लिए आवेदन करनी है वहा पर दिए गए Proceed बटन पर क्लिक कर आवेदन भरें |
                    </p><br>
                    <a style="color: #fff;
                            background-color: #138496;
                            border-color: #117a8b;
                            padding: 12px;
                            border-radius: 37px;" href="{{url('/login')}}" class="btn btn-primary mt-2 py-2 px-4">ऑनलाइन आवेदन</a>
                </div>
            </div>
        </div>
    </section>
    </div>
    <footer class="wrapper footer-wrapper">
        <div class="footer-top-wrapper">
            <div class="container common-container four_content footer-top-container">
                <ul>
                    <li><a href="#">Website Policies</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Terms and Conditions </a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Web Information Manager</a></li>
                    <li><a href="#">Visitor Analytics</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Disclaimer</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom-wrapper">
            <div class="container common-container four_content footer-bottom-container">
                <div class="footer-content clearfix">
                    <div class="copyright-content"> Website Content Managed by <strong>Department of Women & Child
                            Development, Government of Chhattisgarh</strong> </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/.footer-wrapper-->
    <!-- jQuery v1.11.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js" integrity="sha512-nhY06wKras39lb9lRO76J4397CH1XpRSLfLJSftTeo3+q2vP7PaebILH9TqH+GRpnOhfAGjuYMVmVTOZJ+682w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery Migration v1.4.1 -->
    <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
    <!-- jQuery v3.6.0 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery Migration v3.4.0 -->
    <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>

    <script src="{{ asset('home_page/assets/js/jquery-accessibleMegaMenu.js') }}"></script>
    <script src="{{ asset('home_page/assets/js/framework.js') }}"></script>
    <script src="{{ asset('home_page/assets/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('home_page/assets/js/font-size.js') }}"></script>
    <script src="{{ asset('home_page/assets/js/swithcer.js') }}"></script>
    <script src="{{ asset('home_page/theme/js/ma5gallery.js') }}"></script>
    <script src="{{ asset('home_page/assets/js/megamenu.js') }}"></script>
    <script src="{{ asset('home_page/theme/js/easyResponsiveTabs.js') }}"></script>
    <script src="{{ asset('home_page/theme/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
</body>