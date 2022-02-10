/*
Theme Name: Wincasa template
Theme URI: https://www.singularity.is
Author: Singularity Solution - Djordje, Bojan
Author URI: https://www.singularity.is
Description:
Version: 1.5.1
GitHub Theme URI: BojanSusic/wincasa-template
GitHub Theme URI: https://github.com/BojanSusic/wincasa-template

* For the full copyright and license information, please view
* the LICENSE file that was distributed with this source code.

*/

@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto&display=swap');

:root {
--site-font-family: 'Montserrat', sans-serif;
--navbar-font-size: 16px;
--navbar-padding-top: 25px;
--navbar-padding-bottom: 0;
--navbar-background: #fff;
--navbar-color: #1B365C;
--contact-background: #1B365C;
--contact-border-color: #1B365C;
--contact-color: #fff;
--contact-hover-background: #1B365C;
--contact-border-hover-color: #1B365C;
--contact-hover-color: #fff;
--contact-padding: 10px 33px;
--contact-font-size: 16px;
--contact-font-weight: 600;
--current-menu-item-color: #1B365C;
--kontakt-background: #8E6956;
--kontakt-color: #fff;
--contact-card-background: #fff;
--contact-card-hover-background: #cb4a3e;
--contact-card-color: #49483F;
--contact-image-background: #8E6956;
--contact-image-hover-background: #bcbcbc;
--site-slogan-color: #1B365C;
--site-slogan-span-color: #36b37e;
--site-slogan-background: rgba(255, 255, 255, 0.8);
--header-link-background: #36B37E;
--indicator-carousel-color: #1B365C;
--contact-section-background: #1b365c;
--contact-image-border-color: #587288;
--contact-2-border-color: #36B37E;
--contact-2-background: #fff;
--swiper-bullet-vackground: #36B37E;
--hero2-background: #BCBCBC;
--hero2-color: #fff;
--hero2-padding: 111px 0 125px 0;
--footer-background: #1B365C;
--footer-color: #fff;
--footer-padding: 108px 0 115px 0;
--copy-text: #fff;
--content-color: #0C0844;
--title-color: #0C0844;
--link-color: #0C0844;
--flats-cards-background: #8E6956;
--flats-cards-color: #223237;
--flar-acordion-padding: 19px 20px;
--flar-acordion-font-weight: normal;
--flar-acordion-font-family: 'Roboto', sans-serif;
--flar-acordion-font-size: 24px;
--accordion-border-radius: 10px;
--accordion-border-color: #1B365C;
--no-free-flats-background: transparent;
--wincasa-alarm-button-background: #36B37E;
--no-free-flats-color: transparent;
--no-free-flats-link-color: #0C0844;
--header-title-border-color: #36B37E;
--header-title-background: rgba(255, 255, 255, 0.7);
--header-title-color: #1B365C;
--copyright-background-color: #1d2b2f;
--beschribung-circle-background: #36B37E;
--contact-form-padding: 120px 40px;
--contact-form-background: #D6D5D5;
--contact-button-padding: 8px 44px;
--contact-button-font-size: 16px;
--contact-button-font-weight: 600;
--contact-button-color: #fff;
--contact-button: #1B365C;
--label-color: #000;
--title-font-size: 36px;
--wohnen-1-background: transparent;
--accordion-circle: #36B37E;
--accordion-minus-circle: #1B365C;
--accordion-circle-line: 20px;
--wohnen-2-background: #f3f5f6;
--wohnen-title: #1B365C;
}

table, td, th {

}
.gallery a{
padding: 9px;
}
.mobile-wohnen-card h2 {
font-size: 24px!important;
line-height: 30px!important;
background: #dee2e6;
}
.gallery-block a img {
min-height: 100%;
object-fit: cover;
aspect-ratio: 159/100;
}
.vertiacal-line{
border-left: 2px solid rgba(0, 0, 0, 0.2);
margin-top: 50px;
margin-bottom: 50px;
}
.table-striped tbody tr:nth-of-type(odd) {
background: #e6e9ed;
}

.form-group p {
text-align: right;
}

.gray-background {
background: var(--wohnen-2-background);
}

.contact-page {
background: var(--contact-form-background);
}

.beschreibung-card p {
text-align: left;
}

.mobile-wohnen-card {
border: 1px solid black;
border-radius: 10px;
overflow: hidden;
}

.footer p {
text-align: left;
}

#menu-item-1159 {
display: none;
}

table {
border-collapse: collapse;
}

.carousel-control-prev-icon {
background-image: url('/wp-content/themes/wincasa-template/images/Vector (4).svg');
}

.carousel-control-next-icon {
background-image: url('/wp-content/themes/wincasa-template/images/Vector (5).svg');
}

.table {
color: var(--content-color);
}

.beschreibung-card {
margin: 150px 0;
}


.card-title-row, .card-value-row {
padding: 12px 20px;
}

.bold {
font-weight: bold;
}

.bewerbe {
color: var(--content-color);
font-size: 16px;
line-height: 24px;
}

.card-title-row {
box-shadow: inset 0px -1px 0px #DEE2E6, inset 0px 1px 0px #DEE2E6;
}

.card-value-row {
background: #DEE2E6;
border: 1px solid rgba(255, 255, 255, 0.29);
box-sizing: border-box;
/* Stroke for Table */

box-shadow: inset 0px -1px 0px #DEE2E6, inset 0px 1px 0px #DEE2E6;
}

.image-wrapper {
height: 100px;
width: 100px;
border-radius: 100%;
background-color: var(--beschribung-circle-background);
margin: auto;
display: flex;
align-items: center;
justify-content: center;
margin-bottom: 50px;
}


.wpcf7-spinner {
display: none;
}

.contact-section {
display: flex;
min-height: 650px;
flex-direction: column;
background-color: var(--contact-section-background);
}

.contact-card img {
width: 41px;
height: 41px;
}

.contact-page .contact-cards-wrapper {
height: 140px;
}

.contact-cards-wrapper {
height: 280px;
}

.contact-cards {
width: 60vw;
margin: auto;
justify-content: space-around;
border-top: 45px solid var(--contact-2-border-color);
background: var(--contact-2-background);
box-shadow: 0px 30px 60px rgba(0, 0, 0, 0.1);

position: absolute;
top: -50%;
}


.contact-page .contact-cards {
width: 60vw;
margin: auto;
justify-content: space-around;
border-top: 45px solid --contact-2-border-color;
background: #FFFFFF;
box-shadow: none;
position: absolute;
top: -100%;
}

.contact-cards-image {
height: 455px;
object-fit: cover;
margin: auto;
margin-bottom: 0;
margin-top: auto;
border-radius: 0;
}

.contact-section .contact-image {
height: 455px;
width: 82%;
object-fit: cover;
margin: auto;
margin-bottom: 0;
margin-top: auto;
border-top: 45px solid var(--contact-image-border-color);
border-radius: 0;
}

.swiper-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet, .swiper-pagination-horizontal.swiper-pagination-bullets .swiper-pagination-bullet {
margin: 0 10px;

}

.swiper-pagination-bullet-active {
background-color: var(--swiper-bullet-vackground);

}
.swiper-pagination-bullets {
flex-wrap: wrap;
}
.swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet {
margin: 4px!important;
}

.to-gallery-button {
background: #FFFFFF;
box-shadow: -17px 13px 68px rgba(7, 10, 25, 0.08);
width: 376px;
max-width: 100%;
height: 78px;
margin: auto;

}

.to-gallery-button:hover {
text-decoration: none;
}

.to-gallery-button .white-part {
display: flex;
align-items: center;
text-align: center;
width: 266px;
color: var(--content-color);
justify-content: center;
font-family: Montserrat;
font-style: normal;
font-weight: 600;
font-size: 16px;
line-height: 20px;
background: linear-gradient(to right, var(--header-link-background) 50%, white 50%);
background-size: 200% 100%;
background-position: right bottom;
transition: all .5s ease-out;
}

.to-gallery-button:hover .white-part {
background-position: left bottom;
}

.to-gallery-button .yellow-part {
background: var(--header-link-background);
width: 110px;
display: flex;
justify-content: center;
align-items: center;
}

.to-gallery-button .yellow-part img {
filter: brightness(0) invert(1);
}

.wincasa-text {
font-size: 16px;
color: white;
margin: auto;
margin-bottom: 55px;
line-height: 20px;
max-width: 625px;
}

.header-title > h1 {
height: 100%;
display: flex;
justify-content: center;
align-items: center;
font-style: normal;
font-weight: bold;
font-size: 64px;
line-height: 24px;
color: var(--header-title-color);
}

.text-before-table-wrapper {
padding: 120px 0;
background: var(--wohnen-1-background);
}

.text-before-table {
max-width: 580px;
text-align: center;
}

.text-before-table h1 {
font-family: 'Montserrat';
font-style: normal;
font-weight: bold;
font-size: 36px;
line-height: 48px;
color: #223237;
}

.site-slogan {
padding: 3% 0px 3% 8.5%;
max-width: 1083px;
min-height: 250px;
background-color: var(--site-slogan-background);
margin-bottom: 80px;
box-shadow: 0px 24px 34px rgba(4, 5, 18, 0.04);
backdrop-filter: blur(12px);
}

.site-slogan h1 {
font-weight: bold;
font-size: 64px;
line-height: 78px;
color: var(--site-slogan-color);
}

.head-info {
position: absolute;
top: 0;
bottom: 0;
display: flex;
width: 100%;
align-items: center;
}

.head-info > div {
width: 100%;
}

.head-info .to-gallery-button {
margin-left: 8.5%;
}

.head-info .to-gallery-button {
height: 118px;
width: 528px;
}

.contact-card p {
font-weight: 600;
font-size: 20px;
line-height: 24px;
}

.contact-card p a {
font-weight: 600;
font-size: 20px;
line-height: 24px;
color: var(--content-color);
text-decoration: underline;
}

.contact-card a:hover {
text-decoration: none;
color: var(--content-color);
}

.head-info .white-part {
padding: 30px;
width: 418px;
text-align: left;
}

.homepage-header .carousel-indicators {
left: auto;
right: 0;
margin: 0 20px;
position: relative;
width: auto;
}

.site-slogan h1 span {
color: var(--site-slogan-span-color);
}

.header-title {
padding: 80px;
position: absolute;
height: 100px;
background-color: var(--header-title-background);
top: 0;
bottom: 0;
margin: auto;
border-left: 57px solid var(--header-title-border-color);
left: 0;
box-shadow: 0px 24px 34px rgba(4, 5, 18, 0.04);
backdrop-filter: blur(12px);
height: 250px;
}

.text-secondary {
color: var(--hero2-background) !important;
}

.text-danger {
color: #FF1010
}

form label {
color: var(--label-color);
}

.um-icon-android-checkbox-outline-blank {
color: #fff !important;
}

.um-icon-android-checkbox-outline-blank:hover {
color: #fff !important;
}

.um-field-checkbox-option {
color: #fff !important;
}

.um-field .um-field-type_terms_conditions {
display: flex !important;
flex-direction: row-reverse !important;
justify-content: center !important;
}

.um-icon-android-checkbox-outline {
color: #fff !important;
}

.content-image {
padding-left: 0px;
padding-right: 30px;
}

.um-toggle-terms {
color: #fff !important;
text-decoration: underline;
}

.um-toggle-terms:hover {
color: #fff !important;
text-decoration: none;
}

.um-field-area {
display: flex !important;
justify-content: center !important;
flex-wrap: wrap !important;
align-items: center !important;
margin-right: 7px !important;
}

@media (max-width: 460px) {
.um-field-type_terms_conditions {
flex-direction: column-reverse !important;
flex-wrap: wrap-reverse;
}
}

@media (max-width: 390px) {
.um-field-type_terms_conditions {
padding-left: 1.3em;
}
}

.navbar-collapse .contact {
padding: 20px
}

.white-image {
display: none
}

.contact-image:hover {
background: var(--contact-image-hover-background)
}

#um-29 div {
margin: auto !important
}

.navbar-toggler {
position: relative;
border: 0;
height: 35px
}

.navbar-toggler:focus, .navbar-toggler:active {
outline: 0
}

.navbar-toggler span {
display: block;
background-color: var(--navbar-color);
height: 3px;
width: 25px;
margin-top: 4px;
margin-bottom: 4px;
-webkit-transform: rotate(0deg);
-moz-transform: rotate(0deg);
-o-transform: rotate(0deg);
transform: rotate(0deg);
position: relative;
left: 0;
opacity: 1;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px
}

.navbar-toggler span:nth-child(1), .navbar-toggler span:nth-child(3) {
-webkit-transition: transform .35s ease-in-out;
-moz-transition: transform .35s ease-in-out;
-o-transition: transform .35s ease-in-out;
transition: transform .35s ease-in-out
}

.navbar-toggler:not(.collapsed) span:nth-child(1) {
position: absolute;
left: 12px;
top: 11px;
-webkit-transform: rotate(135deg);
-moz-transform: rotate(135deg);
-o-transform: rotate(135deg);
transform: rotate(135deg);
opacity: .9
}

.navbar-toggler:not(.collapsed) span:nth-child(2) {
height: 12px;
visibility: hidden;
background-color: transparent
}

.navbar-toggler:not(.collapsed) span:nth-child(3) {
position: absolute;
left: 12px;
top: 11px;
-webkit-transform: rotate(-135deg);
-moz-transform: rotate(-135deg);
-o-transform: rotate(-135deg);
transform: rotate(-135deg);
opacity: .9
}

.gray-text img {
width: 114px;
height: 114px
}

.content-text a {
color: var(--link-color);
text-decoration: underline
}

.content-text a:hover {
color: var(--link-color);
text-decoration: none
}

#menu-primary .nav-link:after {
background: none repeat scroll 0 0 transparent;
bottom: 0;
content: "";
display: block;
height: 2px;
left: 25%;
position: absolute;
background: #759ac9;
transition: width 0.3s ease 0s, left 0.3s ease 0s;
width: 20%;
opacity: 0;
display: none
}

.link {
color: #45494d;
text-decoration: underline
}

.link:hover {
color: #45494d;
text-decoration: none
}

.nav-link {
position: relative
}

#menu-primary .nav-link:hover:after {
left: 40%;
width: 20%;
opacity: 1
}

#menu-primary {
padding: 0 15px
}

.footer-map-image {
width: 25px;
height: 30px;
margin-top: 10px
}

.um-29.um {
max-width: 660px !important
}

.oberi-header {
font-weight: 600;
font-size: 42px;
line-height: 58px;
letter-spacing: 1.01px;
color: var(--title-color);
margin-bottom: 44px;
}

.home-page-content {
line-height: 34px
}

html, body {
font-size: 18px;
color: var(--content-color);
font-family: var(--site-font-family);
}

.indicators-holder span {
font-weight: bold;
line-height: 28px;
letter-spacing: -0.02em;
}

.modal-backdrop {
position: unset !important
}

.table {
font-size: 14px !important
}

main {
z-index: 1;
position: relative;
overflow: hidden
}

.navbar-light .navbar-nav .nav-link {
color: var(--navbar-color) !important
}

.contact a {
color: var(--contact-color);
text-decoration: none;
border: 2px solid var(--contact-border-color);
padding: var(--contact-padding);
background-color: var(--contact-background);
font-size: var(--contact-font-size);
font-weight: var(--contact-font-weight);
}

.contact a:hover {
color: var(--contact-hover-color);
text-decoration: none;
background-color: var(--contact-hover-background);
border: 2px solid var(--contact-border-hover-color);
}

@media only screen and (max-width: 1020px) {
table {
padding: 0 40px
width: 1020px;
}

.scrollcontainer {
margin-left: -40px;
margin-right: -40px;
-webkit-overflow-scrolling: touch;
overflow: hidden;
overflow-x: auto
}

.scrollcontainer .inner {
padding: 0 40px;
min-width: 1020px
}
}

.gallery-section h2 {
text-align: center;
margin-bottom: 48px;
font-style: normal;
font-weight: bold;
font-size: var(--title-font-size);
line-height: 50px;
color: var(--title-color);
}

.mySwiper {
margin: 0 150px;
}

.swiper-container {
overflow: inherit;
font-size: .8em;
width: 100%
}

.swiper-button-prev, .swiper-rtl .swiper-button-next, .swiper-button-next, .swiper-rtl .swiper-button-prev {
font-size: 16px;
color: #223237;
font-weight: 900;
}

.swiper-button-next:after, .swiper-rtl .swiper-button-prev:after, .swiper-button-prev:after, .swiper-rtl .swiper-button-next:after {
font-size: 16px;
}

.swiper-slide {
padding: 0 !important;
background: transparent !important;
overflow: hidden
}

.swiper-pagination {
padding: .5em;
position: relative;
margin-bottom: 0px;
margin-top: 20px;
}

.swiper-container-horizontal > .swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction {
bottom: auto
}


.cards .swiper-slide {
padding: 0
}

body {
line-height: 1.68em
}

.cards .swiper-slide .header {
background-color: rgba(0, 0, 0, .05);
border-bottom: solid 1px #F2F3F5;
padding: 1em;
background: var(--flats-cards-background);
color: var(--flats-cards-color)
}

.cards .swiper-slide .header span {
font-size: 1.5em
}

.cards .swiper-slide .body {
padding: 1em
}

.cards .swiper-slide .footer {
padding: 1em
}

.color-overlay {
width: 100%;
height: 100%;
opacity: .7;
position: absolute;
background: rgb(42, 183, 202);
background: linear-gradient(90deg, rgba(42, 183, 202, 1) 0%, rgba(0, 0, 0, 0) 100%);
top: 0;
left: 0
}

#freieWohnungenSwiper {
display: none
}

.container, .container-lg, .container-md, .container-sm, .container-xl {
max-width: 100%
}

.wpcf7-response-output {
margin-left: 0px !important;
}

@media only screen and (max-width: 1020px) {
#freieWohnungenTable {
display: none
}

#freieWohnungenSwiper {
display: block
}
}

@media (min-width: 1200px) {
.py-5 .container, .container-lg, .container-md, .container-sm, .container-xl {
max-width: 1400px;
}

.cards .container, .container-lg, .container-md, .container-sm, .container-xl {
max-width: 1600px;
}

main .container, .container-lg, .container-md, .container-sm, .container-xl {
max-width: 1400px;
}

.navbar .container, .container-lg, .container-md, .container-sm, .container-xl {
max-width: 1622px;
}

.footer .container, .container-lg, .container-md, .container-sm, .container-xl {
max-width: 1600px;
}
}

.carousel-image {
height: 540px;
object-fit: cover
}

#carouselExampleIndicators {
width: 70%;
margin-right: 0;
margin-left: auto;
}

.indicators-wrapper {
justify-content: center;
display: flex;
align-items: center;
bottom: -40px;
right: 9%;
}

.indicators-holder {
align-self: center;
display: flex;
align-items: center;
justify-content: center;
margin: 0 50px;
}

.carousel-indicators .active {
background-color: var(--indicator-carousel-color);
}

.carousel-indicators li {
background-color: #E5E5E5;
margin: 0;
}

.main-title-block {
padding-top: 220px;
padding-bottom: 220px;
background-repeat: no-repeat;
background-size: cover;
position: relative;
background-position-y: center;
background-position-x: center
}


.iframe-map {
width: 100% !important;
height: 607px !important
}

.um-button {
background: #E33E94 !important
}

.page-hero {
height: 350px;
width: 100%;
position: relative;
background-position: center !important;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover
}

.page-hero-overlay {
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: #fe4a49;
opacity: .45
}

.copyright {
padding-top: 30px;
padding-bottom: 30px;
background-color: var(--copyright-background-color)
}

.copy-logo img {
height: 34px
}

.copy-text {
color: var(--copy-text);
font-size: 16px;
}

.copy-text a {
color: var(--copy-text);
text-decoration: underline
}

.no-free-flats {
background: var(--no-free-flats-background);
border-radius: 7px;
padding: 10px;
text-align: center
}

.no-free-flats * {
color: var(--no-free-flats-link-color);
text-decoration: underline
}

.nav-link {
white-space: nowrap
}

.no-free-flats *:hover {
color: var(--no-free-flats-link-color)
}

.subscribe-form .um-field-private .um-field-half {
float: left;
width: auto;
margin-right: 20px
}

.subscribe-form .um-field-private .um-clear:first-of-type {
display: none
}

.subscribe-form .um-field-type_radio .um-field-checkbox-option, .subscribe-form .um-field-type_radio .um-field-radio-option {
margin-left: 26px;
color: #fff !Important
}

.um-button {
background: var(--wincasa-alarm-button-background) !important;
padding: 30px 0 !important;
font-size: 18px !important;
border-radius: 0 !important
}

.um-icon-android-radio-button-off {
color: #45494d !important
}

.um-icon-android-radio-button-on {
color: #45494d !important
}

.subscribe-form .um-field-lang {
display: none
}

.um-icon-android-radio-button-off::before, .um-icon-android-radio-button-on::before {
z-index: 2;
position: relative
}

.um-icon-android-radio-button-off::after, .um-icon-android-radio-button-on::after {
content: "";
background: #fff;
display: block;
width: 17.5px;
height: 17.5px;
border-radius: 50%;
top: 3px;
position: absolute;
z-index: 1;
left: 1px
}

.text-red {
color: #45494d
}

p {
font-style: normal;
font-weight: normal;
font-size: 16px;
line-height: 24px;
color: var(--content-color);
}

a {
transition: 0.2s linear;
-moz-transition: 0.2s linear;
-webkit-transition: 0.2s linear;
-o-transition: 0.2s linear
}

main a {
color: var(--link-color);
text-decoration: underline
}

main a:hover {
color: var(--link-color);
text-decoration: none
}

.width_basic {
max-width: 1280px;
padding: var(--contact-form-padding);
}

.wpcf7-list-item {
margin: 0 !important
}

.all-flats {
/*     padding-top: 50px; */
padding-bottom: 90px;
}

.border-radius {
-webkit-border-radius: 7px;
-moz-border-radius: 7px;
border-radius: 7px
}

.no-border {
border: none
}

.gray-text {
color: #525156;
text-decoration: none
}

a {
transition: 0.2s linear;
-moz-transition: 0.2s linear;
-webkit-transition: 0.2s linear;
-o-transition: 0.2s linear
}

.btn-one {
background-color: #f9f9f9;
color: #fe4a49;
padding: 20px 20px;
font-weight: 500;
font-size: 18px
}

.btn-one:hover {
background: #e8e4dc;
color: #fe4a49
}

.btn-two {
background-color: var(--contact-button);
color: var(--contact-button-color);
padding: var(--contact-button-padding);
font-weight: var(--contact-button-font-weight);
font-size: var(--contact-button-font-size);
border-radius: 0px !important
}

.btn-two:hover {
background: var(--contact-button);
color: #fff
}

.btn-one img, .btn-two img {
margin-right: 5px;
height: 31px
}

.navbar {
padding-top: var(--navbar-padding-top);
padding-bottom: var(--navbar-padding-bottom);
position: sticky;
padding-left: 8%;
top: 0;
z-index: 10;
background: var(--navbar-background)
}

.navbar-brand {
margin-right: 0px !important
}

.navbar-brand img {
width: 160px;
margin-right: 25px
}

.navbar-nav li a {
line-height: 24px;
font-size: var(--navbar-font-size);
padding-left: 24px !important;
padding-right: 24px !important
}

#menu-primary .current-menu-item a {
color: var(--current-menu-item-color) !important;
}

#menu-primary .navbar-nav li a:hover {
color: var(--navbar-color) !important
}

.current-menu-item a {
color: var(--footer-color) !important;
text-decoration: none;
font-weight: 700
}

.navbar-nav li a:hover {
color: #759ac9;
text-decoration: none
}

.hero {
height: 380px;
width: 100%;
position: relative;
background: linear-gradient(to right, #b7942b63, #8e7e4e45), url(foto/hero1.jpg) no-repeat center center;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover
}

.hero .container {
position: relative
}

.hero h1 {
font-size: 56px;
font-weight: 700;
color: #fff;
letter-spacing: 2px
}

.hero-info {
position: absolute;
bottom: 0;
right: 0;
background: #525156;
padding: 17px 20px;
color: #fff;
font-size: 18px
}

.wincasa-alarm-logo {
/*filter: brightness(0) invert(1)*/
}

.home-page-content {
max-width: 1400px
}

.content {
padding: 100px 20px;
}

.content-image img {
width: 100%
}

.homepage-swiper {
-webkit-overflow-scrolling: touch;
overflow: hidden;
overflow-x: auto;
white-space: nowrap;
padding-left: 25px
}

.homepage-swiper::-webkit-scrollbar {
display: none
}

.homepage-swiper {
-ms-overflow-style: none;
scrollbar-width: none
}

.homepage-swiper img {
width: 580px;
height: 410px;
object-fit: cover
}

.background {
width: 517px;
height: 399px;
background-color: var(--contact-card-background);
color: var(--contact-card-color);
font-weight: 600;
font-size: 22px
}

.background p {
color: var(--contact-card-color);
font-size: 22px;
letter-spacing: 0.53px;
font-weight: normal;
}

#kontakt {
width: 100%;
background-color: var(--kontakt-background);
color: var(--kontakt-color)
}

#kontakt h2 {
font-size: 42px;
font-weight: bold;
letter-spacing: 1.01px;
}

.contact-image {
width: 144px;
height: 144px;
line-height: 144px;
text-align: center;
border-radius: 100%;
background: var(--contact-image-background)
}

.red-text {
font-size: var(--title-font-size);
font-weight: bold;
line-height: 48px;
color: var(--title-color);
margin-bottom: 44px;
}

.white-text {
color: var(--no-free-flats-color)
}

.red-text a {
color: #fe4a49
}

.red-background {
background: var(--flats-cards-background) !important;
}

.black-text {
color: #fe4a49 !important
}

.wincasa-alarm-logo {
margin: auto;
width: 45px;
}

.wincasa_alarm {
padding: 0 30px;
background-image: url(http://ottoundalex.ch/wp-content/uploads/2021/02/DSC09633k.png);
background-size: cover
}

.wincasa-alarm-input {
font-size: 20px;
color: #0b0b0b
}

.form-control:active {
box-shadow: transparent !important
}

.wincasa_alarm p {
line-height: 1.68em
}

.um-field-label label {
font-size: 15px !important;
line-height: 22px !important;
font-weight: 700;
font-weight: 600
}

.map {
width: 90%;
height: 507px;
filter: brightness(92%) contrast(123%) saturate(0%) blur(0) hue-rotate(0deg)
}

.white-block {
background-color: #fff
}


.free-flats h2 {
font-size: var(--title-font-size);
line-height: 48px;
color: var(--title-color)
}

.sub-header {
font-size: 24px
}

.flat-img-lg {
width: 100%;
height: 426px;
object-fit: cover
}

.flat-img-sm img {
width: 100px;
height: 100px;
object-fit: cover
}

.see-more-img {
position: relative
}

.overlay {
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
background: #52515699;
color: #fff;
font-weight: 700;
text-align: center;
font-size: 18px;
line-height: 1.2
}

.gallery img:hover {
opacity: .8
}

.free-flats-headings {
margin-bottom: 100px
}

.strasse-heading {
font-size: 18px
}

.strasse {
font-size: 28px;
font-weight: 700;
color: black !important
}

.free-flat-right {
font-size: 18px
}

.table td {
vertical-align: baseline
}

.table-text {
padding: 10px 53px 10px 16px;
font-weight: 700
}

.flat-table-icon {
text-align: center
}

.flat-table-icon img {
max-width: 24px;
max-height: 24px;
height: 24px
}

.card-header .btn {
padding: var(--flar-acordion-padding);
color: var(--flats-cards-color);
font-weight: var(--flar-acordion-font-weight);
font-family: var(--flar-acordion-font-family);
font-size: var(--flar-acordion-font-size);
line-height: 30px;
}

.horisontal-line {
width: var(--accordion-circle-line);
height: 3px;
background: white;
position: absolute;
left: 0;
right: 0;
margin: auto;
top: 0;
bottom: 0;
}

.wohnungen-heading {
padding: 100px 0 0 0;
color: var(--wohnen-title) !important;
}

.vertical-line {
height: var(--accordion-circle-line);
width: 0;
background: white;
position: absolute;
left: 0;
right: 0;
margin: auto;
top: 0;
bottom: 0;
}

.collapsed .vertical-line {
width: 3px;
}

.gallery-page-content {
padding: 70px 130px;
}

.accordion .card-body {
padding: 0;
}

.collapsed .accordion-circle {
background-color: var(--accordion-circle);
}

.accordion-circle {
width: 62px;
height: 62px;
background-color: var(--accordion-minus-circle);
border-radius: 100%;
position: relative;
}

.accordion {

border: 1px solid var(--accordion-border-color);
border-radius: var(--accordion-border-radius);
}

.accordion .card {
border-radius: 10px;
}

.collapsed .collapse-icon-plus {
width: 24px;
height: 24px;
background: url(images/collapse-icon.svg) center center no-repeat;
filter: brightness(0) invert(1);
transform: rotate(180deg);
}

.collapse-icon-plus {
width: 24px;
height: 24px;
background: url(images/collapse-icon.svg) center center no-repeat;
filter: brightness(0) invert(1);
}

.collapse-icon-minus {
width: 24px;
height: 24px;
background: url(images/collapse-icon.svg) center center no-repeat;
filter: brightness(0) invert(1)
}

.accordion {
margin-bottom: 2px
}

.accordion > .card .btn-link:hover, .accordion > .card .btn-link:focus {
text-decoration: none;
box-shadow: none
}

.hero2 {
padding: var(--hero2-padding);
width: 100%;
position: relative;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
background-color: var(--hero2-background);
display: flex;
align-items: center;
}

.hero-overlay {
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
background: rgba(44, 0, 0, .35)
}

.hero2 .container {
position: relative
}

.hero2 h2 {
font-size: 42px;
font-weight: 700;
font-family: 'Montserrat', serif;
color: var(--hero2-color);
letter-spacing: 2px;
margin: 30px auto;
}

.hero2 p {
font-size: 18px;
color: var(--hero2-color)
}

.hero2-info {
position: absolute;
bottom: 0;
right: 0;
background: #525156;
padding: 17px 20px;
color: #fff;
font-size: 18px
}

.hero2 input {
border: none;
font-size: 20px;
position: relative;
margin-left: 0;
margin-right: auto
}

.hero2 input:focus {
outline: none
}

.email-input {
background-color: #fff;
padding: 10px;
border-radius: 7px
}

.um-field-user_email .um-field-area {
padding: 17px 2px;
background: #fff;
border: 2px solid #DEDEDE
}

.um-field-radio:hover .um-faicon-caret-up {
color: #C74A4A !important
}

.um-field-area {
display: flex;
justify-content: center;
flex-wrap: wrap
}

#user_email-29 {
font-size: 22px !important;
outline: transparent !important;
border: none !important
}

.footer-links {
display: inline-block !important
}

.footer {
padding: var(--footer-padding);
background-color: var(--footer-background);
color: var(--footer-color)
}

footer p {
color: var(--footer-color)
}

.footer li {
text-decoration: none
}

.footer li a {
padding: 5px;
text-decoration: none;
color: var(--footer-color)
}

.footer h3 {
font-size: 20px;
font-weight: bold;
}

.social-icons img {
margin-right: 25px
}


.footer ul {
list-style-type: none;
text-align: start
}

.contact-us p {
margin-bottom: 0;
padding: 10px 20px;
color: #fff
}

.footer p {
color: var(--footer-color)
}

.footer p a {
color: var(--footer-color);
text-decoration: underline
}

.about-card {
border-radius: 10px;
padding: 60px 100px;
background-color: #fff
}

.hero-sm {
height: 230px
}

.gallery-block a img {
width: 100% !important;
}

.gallery-block a img:hover {
filter: brightness(30%)
}

#slider {
position: relative;
overflow: hidden;
background: #fff
}

#slider .frame {
position: relative;
width: 100%;
padding: 20px 0;
height: 650px !important;
-webkit-perspective: 1000px;
perspective: 1000px;
-webkit-perspective-origin: 50% 50%;
perspective-origin: 50% 50%
}

#slider .frame .slide_element {
height: 100%;
-webkit-transform-style: preserve-3d;
transform-style: preserve-3d
}

#slider .frame .slide_element .slide {
float: left;
height: 100%;
margin-right: 20px;
opacity: .6;
background: #000;
z-index: 9;
-webkit-transform: translateZ(-150px);
transform: translateZ(-150px);
-webkit-transition: -webkit-transform 1s cubic-bezier(.19, 1, .22, 1);
-webkit-transition-property: opacity, -webkit-transform;
transition: transform 1s cubic-bezier(.19, 1, .22, 1);
transition-property: opacity, transform
}

#slider .frame .slide_element .slide.active {
opacity: 1;
z-index: 10;
-webkit-transform: translateZ(0);
transform: translateZ(0)
}

.ie #slider .frame .slide_element .slide {
margin-right: -70px;
transform: scale(.85)
}

.ie #slider .frame .slide_element .slide.active {
transform: scale(1)
}

#slider .mSButtons.mSPrev {
left: 25%;
right: auto;
bottom: 30px
}

#slider .mSButtons.mSNext {
right: 25%;
left: auto;
bottom: 30px
}

#slider.isTouch .mSButtons {
display: none
}

#slider .mSButtons.mSPrev, #slider .mSButtons.mSNext {
display: none
}


.cookie-title {
font-weight: 700;
text-align: left;
margin-bottom: 5px;
margin-top: 0;
font-size: 16px
}

@media (max-width: 1500px) {
.gallery-block a img {
height: auto;
}
}

@media (max-width: 1335px) {
.navbar-nav li a {
padding-left: 5px !important;
padding-right: 5px !important
}

.mySwiper {
margin: 0 80px;
}
}
@media (max-width: 1199px) {
#slider .frame {
width: 100%;
height: 550px !important
}

.navbar-nav li a {
font-size: 14px
}
}

@media (max-width: 1250px) {
.container, .container-lg, .container-md, .container-sm, .container-xl {
}

.navbar-brand {
margin-right: 5px
}

.navbar-brand img {
margin-right: 10px
}

.contact a {
padding: 10px 20px
}
}

@media (max-width: 1012px) and (min-width: 992px) {
.navbar-collapse .contact {
padding: 10px
}
}

@media (max-width: 991px) {
#slider .frame {
height: 450px !important
}

.navbar {
padding-left: 3%;
padding-right: 3%;
}

.gallery-page-content {
padding: 70px 15px;
}

#carouselExampleIndicators {
width: 100%;
padding: 0 5%;
}

.about-card {
padding: 35px 20px;
}

.site-slogan {
width: 70%;
padding: 3% 0px 3% 5%;
}

.head-info {
bottom: -15%;
}

.site-slogan h1 {
font-size: 44px;
}

.head-info .to-gallery-button {
margin-left: 3%;
}

.about-card img {
width: 100px
}

.header-title {
height: 150px;
}

.header-title {
border-left: 1.5rem solid var(--header-title-border-color);
max-width: 100%;
}

}
@media (min-width: 780px) and (max-width: 1300px){
.contact-image {
width: 100% !important;
}
.contact-cards {
width: 100% !important;
}
}
@media (max-width:780px){

.vertiacal-line{
border-top: 2px solid rgba(0,0,0,0.2);
border-left: none;
margin-top: 0;
margin-bottom: 0;
margin-left: 50px;
margin-right: 50px;
}
}

@media (max-width: 768px) {
#slider .frame {
height: 350px !important
}

.content {
padding: 50px 0px !important;
}

.galerija a {
margin: 0 1% 2% 1% !important;
width: 48% !important
}

.contact-image {
width: 110px;
height: 110px;
line-height: 110px
}

.background {
width: 317px;
height: 320px;
font-size: 16px
}

.homepage-swiper img {
width: 380px;
height: 210px
}

p {
font-size: 16px
}

.site-slogan {
min-height: 160px;
}

.site-slogan h1 {
font-weight: bold;
line-height: 37px;
font-size: 30px;
}

.head-info .to-gallery-button {
height: 118px;
left: auto;
right: auto;
width: 93%;
}

.indicators-wrapper {
display: none;
}

.head-info {
bottom: -120%;
}

.contact-section .contact-image {
width: 100%;
}

.mySwiper {
margin: 0;
}

.startsite-wrapper {
margin-top: 350px !important;
}

.contact-cards {
flex-direction: column;
width: 85% !important;
}

.contact-cards-wrapper {
margin-bottom: 300px;
}

.contact-page .contact-cards-wrapper {
height: 250px;
}

.header-title > h1 {
font-size: 36px;
}
}

@media (max-width: 591px) {
#slider .frame {
height: 270px !important
}

.background {
margin-right: 0px !important
}
}

@media (max-width: 420px) {
#slider .frame {
height: 230px !important
}

.oberi-header {
font-size: 32px;
}

.red-text {
font-size: 32px;
}
}

@media (max-width: 520px) {
.navbar-brand img {
max-height: 80px;
}

.site-slogan {
width: 90%;
padding: 3% 0px 3% 3%;
}
}
@media(min-width: 510px){
.gallery-section .swiper-slide{
margin: 0 10px !important;
}
}

@media (max-width: 480px) {

h2 {
font-size: 28px;
}

.gallery-section h2 {
font-size: 24px;
line-height: 48px;
}

.elementor-text-editor a {
overflow-wrap: break-word;
}

.carousel-image {
height: 220px
}

.site-slogan {
margin-bottom: 40px;
width: 90%;
}

.to-gallery-button .yellow-part {
width: 130px;
}

.head-info .white-part {
padding: 17px;
width: 326px;
}

.contact-section {
min-height: 535px;
}

.header-title > h1 {
font-size: 27px;
}

.head-info {
bottom: -200%;
}

#slider .frame .slide_element .slide {
margin-right: 0
}

.ie #slider .frame .slide_element .slide {
margin-right: -40px
}

.btn-two {
padding: 11px 22px
}

.btn-one {
padding: 11px 22px
}

.standard-block {
padding-top: 20px;
}

.free-flats-headings {
margin-bottom: 40px
}

.flat-img-lg {
height: 340px
}

.free-flat {
margin-bottom: 50px
}

.navbar {
padding-top: 5px;
padding-bottom: 0
}

.standard-block h2 {
font-size: 24px;
line-height: 48px;
}

.card-heading {
font-size: 20px
}

.card-header .btn {
padding: 15px 10px;
font-weight: 500;
font-size: 20px
}

.carousel-inner {
height: 220px
}
}

.gallery-section .swiper-slide {
text-align: center;
font-size: 18px;
background: #fff;

/* Center slide text vertically */
display: -webkit-box;
display: -ms-flexbox;
display: -webkit-flex;
display: flex;
-webkit-box-pack: center;
-ms-flex-pack: center;
-webkit-justify-content: center;
justify-content: center;
-webkit-box-align: center;
-ms-flex-align: center;
-webkit-align-items: center;
align-items: center;
margin-right: auto !important;
margin: 0 13px;
max-width: 476px;
}

.swiper-slide {
text-align: center;
font-size: 18px;
background: #fff;

/* Center slide text vertically */
display: -webkit-box;
display: -ms-flexbox;
display: -webkit-flex;
display: flex;
-webkit-box-pack: center;
-ms-flex-pack: center;
-webkit-justify-content: center;
justify-content: center;
-webkit-box-align: center;
-ms-flex-align: center;
-webkit-align-items: center;
align-items: center;
max-width: 400px;
}



.swiper-slide img {
width: 100%;
height: 317px;
object-fit: cover;
}


.swiper-pagination-bullets {
display: flex;
justify-content: center;
}

.swiper-pagination-bullet:only-child {
display: block !important;
}

