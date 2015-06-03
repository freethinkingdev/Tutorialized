<?php
/**
 * User: Marcin
 * Date: 12/11/2012
 * Time: 18:54
 * File name: index.php
 */

session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Tutorialized');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'><div class='homePage'>");
Page::addMainBodyToThePage("
<p><img alt='Moodle image' src='Images/moo.jpg'/>
The OU has responded to the desire for enhanced online collaboration with an online learning space called SocialLearn for students, staff, alumni and the general public to sample.
With the increase in the use of third party social media/networking platforms, the ability to learn and collaborate with others is now a reality and the OU’s SocialLearn offers a new kind of collaborative learning space.
The OU has always been at the forefront of multi-channel learning using television, radio, iTunes U, and YouTube, and culminating in the OpenLearn online learning hub. These channels enable the OU to reach a wide, global
 audience and are designed to open up informal learning to anyone, whatever their educational needs and experience.
SocialLearn now takes this opportunity one step further. The Open University’s online learning space is available as an
early beta release for students, staff, alumni and the general public to sample.</p>

");
Page::addMainBodyToThePage("</div></div>");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");

