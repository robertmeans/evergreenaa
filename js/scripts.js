function validateEmail(a){var b=/^(.+)@(.+)$/,c='\\(\\)<>@,;:\\\\\\"\\.\\[\\]',d="[^\\s"+c+"]",e='("[^"]*")',f=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/,g=d+"+",h="("+g+"|"+e+")",i=new RegExp("^"+h+"(\\."+h+")*$"),j=new RegExp("^"+g+"(\\."+g+")*$"),k=a.match(b);if(""==document.forms[0].email.value)return alert("\nThe e-mail field is blank.\n\nPlease enter your e-mail address."),document.forms[0].email.focus(),!1;if(null==k)return alert('_____________________________\n\nYour e-mail address seems incorrect. Please check the following\n\n1. Did you include the "@" and the " . " (dot)?\n2. Did you include anything other than a "@" & " . "?\n\nPlease re-enter your e-mail address.\n_____________________________'),document.forms[0].email.select(),document.forms[0].email.focus(),!1;var l=k[1],m=k[2];if(null==l.match(i))return alert("_____________________________\n\nThe username does not seem to be valid.\n\nPlease check the following:\n\n1. That you entered your e-mail address correctly.\n\nThank you.\n_____________________________"),document.forms[0].email.select(),document.forms[0].email.focus(),!1;var n=m.match(f);if(null!=n){for(var o=1;o<=4;o++)if(n[o]>255)return alert("_____________________________\n\nThe destination IP address you entered is invalid.\n\nPlease check your e-mail address and make the necessary corrections.\n\nThank you.\n_____________________________"),document.forms[0].email.select(),document.forms[0].email.focus(),!1;return!0}if(null==m.match(j))return alert("_____________________________\n\nAre you making stuff up now?\n\nThe e-mail address portion of this form is not something to scoff at.\n\nI've been placed here in  your computer to make sure your information is valid. You\nneed to enter your real e-mail address or successfully fake me out to proceed.\n\nThank you.\n_____________________________"),document.forms[0].email.select(),document.forms[0].email.focus(),!1;var p=new RegExp(g,"g"),q=m.match(p),r=q.length;if(q[q.length-1].length<2||q[q.length-1].length>3)return alert("_____________________________\n\nYour e-mail address must end in a three-letter domain, or two letter country.\n\n_____________________________"),document.forms[0].email.select(),document.forms[0].email.focus(),!1;if(r<2){return alert('_____________________________\n\nYour e-mail address is missing either a username, a hostname or a domain.\nAn e-mail address should include these three basic components:\n\n1. A username - (e.g., YOURNAME@yahoo.com, YOURNAME@mho.net)\n2. A host - (e.g., yourname@YAHOO.com, yourname@MHO.net)\n3. A domain - (e.g., yourname@yahoo.COM, yourname@mho.NET)\n\nPlease make the necessary corrections and press "Send".\n-- Thank you, The unforgiving script validating this e-mail field.\n\n_____________________________'),document.forms[0].email.select(),document.forms[0].email.focus(),!1}return!0}function copyToClipboardMsg(a,b){var c,d=copyToClipboard(a);c=d?"Copied!":"Press Ctrl+c to copy","string"==typeof b&&(b=document.getElementById(b)),b.innerHTML=c,b.style.background="#40d046",b.style.color="#fff",b.style.border="1px solid #fff",setTimeout(function(){b.innerHTML='<i class="far fa-arrow-alt-circle-up"></i> Copy',b.style.background="#fff",b.style.color="#313131",b.style.border="1px solid #757575"},750)}function copyToClipboard(a){var b,c,d="_hiddenCopyText_",e="INPUT"===a.tagName||"TEXTAREA"===a.tagName;if(e)f=a,b=a.selectionStart,c=a.selectionEnd;else{if(!(f=document.getElementById(d))){var f=document.createElement("textarea");f.style.position="absolute",f.style.left="-9999px",f.style.top="0",f.id=d,document.body.appendChild(f)}f.textContent=a.textContent}var g=document.activeElement;f.focus(),f.setSelectionRange(0,f.value.length);var h;try{h=document.execCommand("copy")}catch(i){h=!1}return g&&"function"==typeof g.focus&&g.focus(),e?a.setSelectionRange(b,c):f.textContent="",h}for(var but=document.getElementsByClassName("btn"),txt=document.getElementsByClassName("input-copy"),x=0;x<but.length;x++)!function(a){but[a].addEventListener("click",function(){copyToClipboardMsg(txt[a],but[a])},!1)}(x);$(document).ready(function(){$("input.timepicker").timepicker({timeFormat:"h:mm p",dynamic:!1,dropdown:!1,scrollbar:!1})}),$(".radio-group .radio").click(function(){$(this).parent().find(".radio").removeClass("selected"),$(this).addClass("selected");var a=$(this).attr("value");$(this).parent().find("input").val(a)}),$(document).ready(function(){$(".day-content").hide(),$(".weekday-wrap").hide(),$("#msg-one").hide(),$("#email-bob").hide(),$(".day").click(function(){var a=$(this),b=$(this).next(".day-content");$(".day-content").not(b).slideUp(),$(".day").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".daily-glance-wrap").click(function(){var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".daily-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".manage-glance-wrap").click(function(){var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".manage-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".collapse-day").click(function(){var a=$(this);$(".day-content").not(a).slideUp(),$(".day").removeClass("active")}),$("#toggle-contact-form").click(function(){return $(this).toggleClass("active").next().slideToggle(600),"close"===$.trim($(this).text())?$(this).html('<i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i>'):$(this).html('<i class="fa fa-times-circle close-left" aria-hidden="true"></i> close <i class="fa fa-times-circle close-right" aria-hidden="true"></i>'),!1})}),setTimeout(function(){$("#success-wrap").fadeOut(1500)},2e3),$("#toggle-public-msg").click(function(a){a.preventDefault(),a.stopPropagation(),$("#msg-one").is(":hidden")?($("#msg-one").fadeIn(500),$("#toggle-public-msg").html("Close")):($("#msg-one").fadeOut(500),$("#toggle-public-msg").html("Readme"))}),$("#toggle-private-msg").click(function(a){a.preventDefault(),a.stopPropagation(),$("#msg-one").is(":hidden")?($("#msg-one").fadeIn(500),$("#toggle-private-msg").html("Close")):($("#msg-one").fadeOut(500),$("#toggle-private-msg").html("Extras"))}),$(document).click(function(){$("#msg-one").fadeOut(500),$("#toggle-public-msg").html("Readme"),$("#toggle-private-msg").html("Extras")}),$("#preamble").click(function(a){a.stopPropagation()}),$("#twelvesteps").click(function(a){a.stopPropagation()}),$("#traditions").click(function(a){a.stopPropagation()}),$("#topics").click(function(a){a.stopPropagation()}),$("#daccaa").click(function(a){a.stopPropagation()}),$(".manage-edit").click(function(a){a.stopPropagation()}),$(".manage-delete").click(function(a){a.stopPropagation()}),$(".youtube").click(function(a){a.stopPropagation()}),$(".omw").change(function(){$(".omw").not(this).prop("checked",!1)}),$(".oc").change(function(){$(".oc").not(this).prop("checked",!1)});