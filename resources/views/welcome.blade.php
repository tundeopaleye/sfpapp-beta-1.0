@extends('layouts.master2')



@section('content')

	
<div id="wrapper">
      
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="images/sfpbanner1.jpg" data-thumb="images/sfpbanner1.jpg" alt="" />
                <img src="images/sfpbanner2.jpg" data-thumb="images/sfpbanner2.jpg" alt="" data-transition="slideInLeft" />
                <img src="images/sfpbanner1.jpg" data-thumb="images/sfpbanner1.jpg" alt="" title="#htmlcaption" />
            </div>
            <div id="htmlcaption" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
            </div>
        </div>

    </div>
    <script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>	
	
	
	
			
			
 @stop