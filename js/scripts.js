function openNav(){var a=document.getElementById("side-nav");"300px"==a.style.width?($("#side-nav-bkg").fadeOut(501),a.style.width="0px"):($("#side-nav-bkg").fadeIn(0),a.style.width="300px")}function closeNav(){document.getElementById("side-nav").style.width="0",$("#side-nav-bkg").fadeOut(501),$(".top-nav").removeClass("acty")}function close_navigation_first(){var a=document.getElementById("side-nav");"300px"==a.style.width&&($("#side-nav-bkg").fadeOut(501),$(".top-nav").removeClass("acty"),a.style.width="0px",stopPropagation())}$(document).ready(function(){var a=window.location.href;$("#url").val(a),$("#tz-url").val(a),$(".top-nav").on("click",function(){this.classList.toggle("acty")})}),$(document).ready(function(){$("#toggle-msg-one").click(function(a){a.preventDefault(),a.stopPropagation(),$("#msg-one").is(":hidden")?$("#msg-one").fadeIn(500):$("#msg-one").fadeOut(500)}),$("#toggle-why-join").click(function(a){a.preventDefault(),a.stopPropagation(),$("#why-join").is(":hidden")?$("#why-join").fadeIn(500):$("#why-join").fadeOut(500)}),$("#show-tz").click(function(a){a.preventDefault(),a.stopPropagation(),$("#tz").fadeIn(500)}),$(".inline-show-tz").click(function(a){a.preventDefault(),a.stopPropagation(),$("#tz").fadeIn(500)}),$("#hide-tz").click(function(a){a.preventDefault(),a.stopPropagation(),$("#tz").fadeOut(500),setTimeout(function(){$("#tz-form").trigger("reset")},525)}),$("#toggle-role-key").click(function(a){a.preventDefault(),a.stopPropagation(),$("#role-key").is(":hidden")?$("#role-key").fadeIn(500):$("#role-key").fadeOut(500)}),$("#toggle-gottajoin").click(function(a){a.preventDefault(),a.stopPropagation(),$("#gottajoin").is(":hidden")?$("#gottajoin").fadeIn(500):$("#gottajoin").fadeOut(500)}),$("#toggle-mb-notes").click(function(a){a.preventDefault(),a.stopPropagation(),$("#mb-notes").is(":hidden")?$("#mb-notes").fadeIn(500):$("#mb-notes").fadeOut(500)})}),$(document).click(function(){var a=document.getElementById("side-nav");$("#msg-one").is(":visible")?$("#msg-one").fadeOut(500):$("#role-key").is(":visible")?$("#role-key").fadeOut(500):$("#why-join").is(":visible")?$("#why-join").fadeOut(500):$("#gottajoin").is(":visible")?$("#gottajoin").fadeOut(500):$("#mb-notes").is(":visible")?$("#mb-notes").fadeOut(500):$("#lat-long").is(":visible")?$("#lat-long").fadeOut(500):$("#one-tap").is(":visible")?$("#one-tap").fadeOut(500):$("#desc-loc").is(":visible")?$("#desc-loc").fadeOut(500):$("#pdf-upload").is(":visible")?$("#pdf-upload").fadeOut(500):$("#link-label").is(":visible")?$("#link-label").fadeOut(500):"300px"==a.style.width&&closeNav()}),$(".top-nav").click(function(a){a.stopPropagation()}),$(".nav-active").click(function(a){a.preventDefault(),a.stopPropagation()}),$(document).ready(function(){$("#usr-role-go").click(function(){close_navigation_first();var a=$("#mng-usr").val();"empty"!=a&&(window.location=a)}),$("#usr-role-goz").click(function(){close_navigation_first();var a=$("#mng-usrz").val();"empty"!=a&&(window.location=a)}),$("#usr-role-gozz").click(function(){close_navigation_first();var a=$("#mng-usrzz").val();"empty"!=a&&(window.location=a)})}),$(document).ready(function(){$(document).on("click","a[data-role=rnote]",function(){close_navigation_first();var a=$(this).data("id"),b=$("#uid_"+a).html();if($("#round2_"+a).html().length)var c=$("#"+a).html().replaceAll("<br>","\n").replaceAll("<br><br>","\n\n").trim();else var c=$("#"+a).html().replaceAll("<br>\n","\n").replaceAll("<br>\n<br>","\n").trim();$("#"+a).addClass("formhere"),$("#"+a).html('<form id="revise-sus-note"><textarea id="sus-note" name="reason" maxlength="250">'+c+'</textarea><input type="hidden" name="user-id" value="'+b+'"></form>'),$("#a_"+a).html('<a data-id="'+a+'" data-role="unote" class="reason-note rt sicon"><div class="tooltip"><span class="tooltiptext type">Save Edit</span><i class="far fa-save"></i></div></a> <a data-role="cnote" data-id="'+a+'" class="reason-note rt cicon"><div class="tooltip right"><span class="tooltiptext type">Cancel Edit</span><i class="fas fa-ban"></i></div></a>')}),$(document).on("click","a[data-role=cnote]",function(){close_navigation_first();var a=$(this).data("id");if($("#round2_"+a).html().length)var b=$("#round2_"+a).html();else var b=$("#on_"+a).html();$("#error_"+a).html(""),$("#"+a).html(b),$("#a_"+a).html('<a data-id="'+a+'" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right"><span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>'),$("#"+a).removeClass("formhere")}),$(document).on("click","a[data-role=unote]",function(){close_navigation_first();var a=$(this).data("id"),b=$("#sus-note").val().replaceAll("\n","<br>").trim();$.ajax({dataType:"JSON",url:"process-edit-sus_note.php",type:"POST",data:$("#revise-sus-note").serialize(),beforeSend:function(a){},success:function(c){c&&("ok"==c.signal?($("#a_"+a).html('<a data-id="'+a+'" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right"><span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>'),$("#"+a).removeClass("formhere"),$("#"+a).removeClass("emsg"),$("#error_"+a).html(""),$("#"+a).html(b),$("#round2_"+a).html(b)):$("#error_"+a).html('<div class="alert alert-warning ump">'+c.msg+"</div>"))},error:function(){$("#"+a).html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","a[data-role=ic]",function(){var a=$(this).data("id"),b=document.getElementById(a).value,c=document.createElement("textarea");document.body.appendChild(c),c.value=b,c.select(),document.execCommand("copy"),document.body.removeChild(c);var d=$(this);$(this).html('<i class="fas fa-check fa-fw"></i> ID Copied!'),$(this).addClass("copied"),setTimeout(function(){d.removeClass("copied"),d.html('<i class="far fa-arrow-alt-circle-up"></i> Copy ID</a>')},1e3)}),$(document).on("click","a[data-role=pc]",function(){var a=$(this).data("id"),b=document.getElementById(a).value,c=document.createElement("textarea");document.body.appendChild(c),c.value=b,c.select(),document.execCommand("copy"),document.body.removeChild(c);var d=$(this);$(this).html('<i class="fas fa-check fa-fw"></i> Password Copied!'),$(this).addClass("copied"),setTimeout(function(){d.removeClass("copied"),d.html('<i class="far fa-arrow-alt-circle-up"></i> Copy Password</a>')},1e3)}),$(document).on("click","a[data-role=em]",function(){var a=$(this).data("id"),b=document.getElementById(a).value,c=document.createElement("textarea");if(document.body.appendChild(c),c.value=b,c.select(),document.execCommand("copy"),document.body.removeChild(c),"pickemup"==$(this).data("id"))var d='<i class="far fa-copy"></i> All Addresses</a>';else var d='<i class="far fa-copy"></i> Only Hosts</a>';var e=$(this);$(this).html('<i class="fas fa-check fa-fw"></i> Addresses Copied!'),$(this).addClass("copied"),setTimeout(function(){e.removeClass("copied"),e.html(d)},1e3)})}),$(document).ready(function(){$("input.timepicker").timepicker({timeFormat:"h:mm p",dynamic:!1,dropdown:!1,scrollbar:!1})}),$(".radio-group .radio").click(function(){close_navigation_first(),$(this).parent().find(".radio").removeClass("selected"),$(this).addClass("selected");var a=$(this).attr("value");$(this).parent().find("input").val(a)}),$('input[name="remember_me"]').change(function(){$(this).is(":checked")?($(".aa-rm-in").addClass("checkaroo"),$(".rm-rm").addClass("hot")):($(".aa-rm-in").removeClass("checkaroo"),$(".rm-rm").removeClass("hot"))}),$("#showLoginPass").click(function(){close_navigation_first();var a=document.getElementById("password");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide password'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show password'),a.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide password'),a.type="text"),!1}),$("#showSignupPass").click(function(){var a=document.getElementById("showPassword"),b=document.getElementById("showConf");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide passwords'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show passwords'),a.type="password",b.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide passwords'),a.type="text",b.type="text"),!1}),$(document).ready(function(){function a(a){"0"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add a PDF | 4 total'),"1"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining'),"2"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining'),"3"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining'),"4"==a&&$("#file-upload").html("That's all")}$("#side-nav-bkg").hide(),$(".day-content").hide(),$(".weekday-wrap").hide(),$("#msg-one").hide(),$("#why-join").hide(),$("#gottajoin").hide(),$("#mb-notes").hide(),$("#tz").hide(),$("#role-key").hide(),$("#lat-long").hide(),$("#one-tap").hide(),$("#desc-loc").hide(),$("#pdf-upload").hide(),$("#link-label").hide(),$("#sus-reason").hide(),$("#email-bob").hide();var b=document.getElementById("hid-f1"),c=document.getElementById("hid-f2"),d=document.getElementById("hid-f3"),e=document.getElementById("hid-f4");$(".pdf1").hasClass("fixerror")||b&&b.value?$(".pdf1").show():$(".pdf1").hide(),$(".pdf2").hasClass("fixerror")||c&&c.value?$(".pdf2").show():$(".pdf2").hide(),$(".pdf3").hasClass("fixerror")||d&&d.value?$(".pdf3").show():$(".pdf3").hide(),$(".pdf4").hasClass("fixerror")||e&&e.value?$(".pdf4").show():$(".pdf4").hide(),$("#file-upload").click(function(){var b=$(".pdf-wrap:visible").length+1;$(this).html();return $(".pdf1").is(":hidden")?($(".pdf1").slideDown(),void a(b)):$(".pdf2").is(":hidden")?($(".pdf2").slideDown(),void a(b)):$(".pdf3").is(":hidden")?($(".pdf3").slideDown(),void a(b)):$(".pdf4").is(":hidden")?($(".pdf4").slideDown(),void a(b)):void 0}),$(".pdf-remove").click(function(){var b=$(".pdf-wrap:visible").length-1,c=$(this).closest(".pdf-wrap");c.hasClass("pdf1")&&($("#hid-f1").val(""),$(".pdf1_name").val(""),$("#pdf1").removeClass("fixerror"),$(".pdf1").slideUp(),a(b)),c.hasClass("pdf2")&&($("#hid-f2").val(""),$(".pdf2_name").val(""),$("#pdf2").removeClass("fixerror"),$(".pdf2").slideUp(),a(b)),c.hasClass("pdf3")&&($("#hid-f3").val(""),$(".pdf3_name").val(""),$("#pdf3").removeClass("fixerror"),$(".pdf3").slideUp(),a(b)),c.hasClass("pdf4")&&($("#hid-f4").val(""),$(".pdf4_name").val(""),$("#pdf4").removeClass("fixerror"),$(".pdf4").slideUp(),a(b))}),$("#review-mtg, #update-mtg").click(function(a){var b=document.getElementById("file1").files[0],c=document.getElementById("file2").files[0],d=document.getElementById("file3").files[0],e=document.getElementById("file4").files[0],f=document.getElementById("pdf1"),g=document.getElementById("pdf2"),h=document.getElementById("pdf3"),i=document.getElementById("pdf4");void 0!==e&&(e&&e.size<=2097152||(alert('Your file "'+e.name+'" in position 4 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),i.classList.add("fixerror"),a.preventDefault())),void 0!==d&&(d&&d.size<=2097152||(alert('Your file "'+d.name+'" in position 3 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),h.classList.add("fixerror"),a.preventDefault())),void 0!==c&&(c&&c.size<=2097152||(alert('Your file "'+c.name+'" in position 2 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),g.classList.add("fixerror"),a.preventDefault())),void 0!==b&&(b&&b.size<=2097152||(alert('Your file "'+b.name+'" in position 1 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),f.classList.add("fixerror"),a.preventDefault()))}),a($(".pdf-wrap:visible").length),$(".day").click(function(){close_navigation_first();var a=$(this),b=$(this).next(".day-content");$(".day-content").not(b).slideUp(),$(".day").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".daily-glance-wrap").click(function(){close_navigation_first();var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".daily-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".manage-glance-wrap").click(function(){close_navigation_first();var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".manage-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".collapse-day").click(function(){close_navigation_first();var a=$(this);$(".day-content").not(a).slideUp(),$(".day").removeClass("active")}),$("#toggle-contact-form").click(function(){return close_navigation_first(),$(this).toggleClass("active").next().slideToggle(600),"close"===$.trim($(this).text())?$(this).html("comments | questions | suggestions"):$(this).html("close"),!1})}),$("#toggle-lat-long-msg").click(function(a){$("#lat-long").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$("#toggle-one-tap-msg").click(function(a){$("#one-tap").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$("#toggle-descriptive-location").click(function(a){$("#desc-loc").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$("#toggle-pdf-info").click(function(a){$("#pdf-upload").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$("#toggle-link-label").click(function(a){$("#link-label").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$(".pdf-remove").click(function(a){a.stopPropagation()}),$("#gmaps").click(function(a){a.stopPropagation()}),$(".pdf").click(function(a){a.stopPropagation()}),$("#preamble").click(function(a){a.stopPropagation()}),$("#twelvesteps").click(function(a){a.stopPropagation()}),$("#traditions").click(function(a){a.stopPropagation()}),$("#topics").click(function(a){a.stopPropagation()}),$("#daccaa").click(function(a){a.stopPropagation()}),$(".manage-edit").click(function(a){a.stopPropagation()}),$(".manage-delete").click(function(a){a.stopPropagation()}),$(".youtube").click(function(a){a.stopPropagation()}),$(".omw").change(function(){$(".omw").not(this).prop("checked",!1)}),$(".oc").change(function(){$(".oc").not(this).prop("checked",!1)}),$(document).ready(function(){$("#emailBob").click(function(){$.ajax({dataType:"JSON",url:"contact-process.php",type:"POST",data:$("#contactForm").serialize(),beforeSend:function(a){$("#msg").html('<span class="email-me">Sending - one moment...</span>')},success:function(a){a&&(console.log(a),"ok"==a.signal?$("#contactForm").html("<span>Your message was sent successfully.</span>"):$("#msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","#init-tz-submit",function(){"empty"!=$("#init-tz-select").val()?$("#init-set-tz").submit():$("#init-pick-tz").html("<p>Gotsta picka timezone</p>")}),$(document).on("click","#tz-submit",function(){"empty"!=$("#tz-select").val()?$("#tz-form").submit():$("#pick-tz").html("<p>Gotsta picka timezone</p>")})}),$(document).ready(function(){if($(document).on("click","a[data-role=emh]",function(){var a=$(this).data("id"),b=$("#"+a).children("span[data-target=mtgid]").text(),c=$("#"+a).children("span[data-target=vtz]").text(),d=$("#"+a).children("span[data-target=mtgtime]").text(),e=$("#"+a).children("span[data-target=mtgday]").text(),f=$("#"+a).children("span[data-target=mtgname]").text(),g=document.getElementById("theModal");$("#mtgid").val(b),$("#mtgname").html(d+", "+e+" - "+f),$("#vdt").val(e+", "+d),$("#vtz").val(c),$("#mtgnamez").val(f),$("#your-name").html('Your name<input name="name" id="emh-name" class="edit-input link-name" type="text" maxlength="30">'),$("#your-email").html('Your email<input name="email" id="emh-email" class="edit-input link-email" type="email" maxlength="250">'),$("#msg-title").html("Message the host of:"),$("#msg-label").html("Message"),$("#submit-links").html('<input type="button" id="emh-btn" class="send" value="Send">'),$("body").addClass("noscrollz"),g.style.display="block"}),$(".closefp")[0]){document.getElementsByClassName("closefp")[0].onclick=function(){$("#emh-contact").html('<input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="vdt" id="vdt"><input type="hidden" name="vtz" id="vtz"><input type="hidden" name="mtgname" id="mtgnamez"><label id="your-name"></label><label id="your-email"></label><label><span id="msg-label"></span><textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea></label><div id="emh-contact-msg"></div><div id="submit-links" class="submit-links"></div>'),$("body").removeClass("noscrollz"),theModal.style.display="none"}}$(document).on("click","#emh-btn",function(){$.ajax({dataType:"JSON",url:"contact-host-process.php",type:"POST",data:$("#emh-contact").serialize(),beforeSend:function(a){$("#emh-contact-msg").html('<span class="sending-msg">Sending - one moment...</span>')},success:function(a){a&&(console.log(a),"ok"==a.signal?$("#emh-contact").html('<span class="success-emh">Your message was sent successfully.</span>'):$("#emh-contact-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#emh-contact-msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){if($(document).on("click","a[data-role=logissue]",function(){var a=$(this).data("id"),b=$("#"+a).children("span[data-target=mtgid]").text(),c=$("#"+a).children("span[data-target=vtz]").text(),d=$("#"+a).children("span[data-target=mtgtime]").text(),e=$("#"+a).children("span[data-target=mtgday]").text(),f=$("#"+a).children("span[data-target=mtgname]").text(),g=$("#"+a).children("span[data-target=tuid]").text(),h=$("#"+a).children("span[data-target=ri]").text(),i=a+"_er",j=document.getElementById("theModal");"ns"!=g?($("#tuid").val(g),$("#mtgid").val(b),$("#mtgname").html(d+", "+e+" - "+f),$("#vdt").val(e+", "+d),$("#vtz").val(c),$("#mtgnamez").val(f),$("#ri").val(h),$("#msg-title").html('Abandoned meeting? Broken links?<div class="issue-header">Submitting this form will post an alert on this meeting to notify all visitors of an issue and will email the Host to give them the opportunity to fix it. 3 issues without a response from the Host will remove the meeting from the site.</div>'),$("#your-name").html(""),$("#your-email").html(""),$("#msg-label").html("Describe issue"),$("#submit-links").html('<input type="button" id="issue-btn" data-id="'+i+'" class="send" value="Submit">')):$("#emh-contact").html('<div class="log-issue-public">Logging issues is an integral part of keeping the information on this site reliable. As it carries a fair amount of responsibility on the part of the one reporting an issue, and to prevent it from being abused, this feature is available only while you are logged in. <div class="login-links"><a class="extras" href="login.php">Login</a><a class="extras" href="signup.php">Join</a></div></div>'),$("body").addClass("noscrollz"),j.style.display="block"}),$(document).on("click","a[data-role=logissued]",function(){var a=($(this).data("id"),document.getElementById("theModal"));$("#emh-contact").html('<div class="log-issue-public">You have already logged an issue about this meeting. The Host has been notified and if 2 more users log unanswered issues about this meeting it will be removed from the site.</div>'),$("body").addClass("noscrollz"),a.style.display="block"}),$(".closefp")[0]){document.getElementsByClassName("closefp")[0].onclick=function(){$("#emh-contact").html('<input type="hidden" name="tuid" id="tuid"><input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="vdt" id="vdt"><input type="hidden" name="vtz" id="vtz"><input type="hidden" name="mtgname" id="mtgnamez"><input type="hidden" name="ri" id="ri"><label id="your-name"></label><label id="your-email"></label><label><span id="msg-label"></span><textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea></label><div id="emh-contact-msg"></div><div id="submit-links" data-id="" class="submit-links"></div>'),$("body").removeClass("noscrollz"),theModal.style.display="none"}}$(document).on("click","#issue-btn",function(){var a=$(this).data("id");$.ajax({dataType:"JSON",url:"log-issue-process.php",type:"POST",data:$("#emh-contact").serialize(),beforeSend:function(a){$("#emh-contact-msg").html('<span class="sending-msg">Sending - one moment...</span>')},success:function(b){console.log(b),b&&("ok"==b.signal?($("#emh-contact").html('<span class="success-emh">The issue was noted successfully.</span>'),$("#"+a).addClass("errors-reported"),$("#"+a).html().indexOf("There has been an issue reported")>=0?$("#"+a).html('Attention: There have been 2 issues reported with this meeting that the Host has not addressed yet. If you find the meeting abandoned or any of the links do not work correctly please use the link above, "Log issue" to help keep the information on this site reliable. If 3 issues go unaddressed the meeting will be removed from the site until the necessary corrections are made.'):$("#"+a).html().indexOf("There have been 2 issues reported")>=0?$("#"+a).html("The issue you logged has tipped the scale. If you refresh your browser this meeting is no longer available for public view and will remain hidden until the Host addresses the issue(s)."):$("#"+a).html('Attention: There has been an issue reported with this meeting that the Host has not addressed yet. If you find the meeting abandoned or any of the links do not work correctly please use the link above, "Log issue" to help keep the information on this site reliable. If 3 issues go unaddressed the meeting will be removed from the site until the necessary corrections are made.')):$("#emh-contact-msg").html('<div class="alert alert-warning">'+b.msg+"</div>"))},error:function(){$("#emh-contact-msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","a[data-role=mb]",function(){$(this).data("id");$("body").addClass("noscrollz"),theModal.style.display="block"}),$(document).on("click","#mb-new",function(){var a=$("#user-posting").val(),b=$("#mb-title").val(),c=$("#emh-msg").val(),d=(c.match(/\n/g)||[]).length;if(d>0||c.trim().length>80)var e=c.split("\n",1)[0].substring(0,80)+"...";else if(c.trim().length>80)var e=c.substring(0,80)+"...";else var e=c;return d>6?void $("#emh-contact-msg").html('<div class="alert alert-warning">Tighten that up please. Too many line breaks (6 tops). Trying to avoid those long posts where people exploit the carriage return.</div>'):0==b.trim().length?($("#emh-contact-msg").html('<div class="alert alert-warning">You need a Title for your post.</div>'),void $("#mb-title").addClass("alert")):0==c.trim().length?($("#emh-contact-msg").html('<div class="alert alert-warning">You need some content for your post.</div>'),void $("#emh-msg").addClass("alert")):void $.ajax({dataType:"JSON",url:"process-mb.php",type:"POST",data:$("#mb").serialize(),beforeSend:function(a){$("#emh-contact-msg").html('<span class="sending-msg">Posting - one moment...</span>')},success:function(c){c&&(console.log(c),"ok"==c.signal?($("#mb").html('<input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="mtgname" id="mtgnamez"><input type="hidden" id="user-posting" value="'+a+'"><label>Title | Topic | Headline<input id="mb-title" name="mb-title" class="edit-input link-name" type="text" maxlength="50"></label><label>Body<textarea name="mb-post" id="emh-msg" class="edit-input link-msg" maxlength="250"></textarea></label><div id="emh-contact-msg"></div><div class="submit-links"><input type="button" id="mb-new" class="send" value="Post it"></div>'),$("#theModal").hide(),$("body").removeClass("noscrollz"),$("#empty-posts").html(""),$("#post-topics").prepend('<li style="border-bottom:1px dashed rgba(255,255,255,0.4);"><p class="mb-date">Just now | '+a.charAt(0)+'... Posted:</p><p class="title">'+b+'</p><p class="mb-body">'+e+"</p></li>")):$("#emh-contact-msg").html('<div class="alert alert-warning">'+c.msg+"</div>"))},error:function(){$("#emh-contact-msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})}),$(document).on("click","a[data-role=go-to-post]",function(){var a=$(this).data("id");$("#"+a).submit()}),$(document).on("click","a[data-role=delete-post]",function(){var a=$(this).data("id"),b=a.substring(a.indexOf("_")+1),c=$("#ybcwpb");$.ajax({dataType:"JSON",url:"process-delete-mb-post.php",type:"POST",data:$("#"+a).serialize(),beforeSend:function(a){},success:function(a){a&&(console.log(a),"ok"==a.signal&&(c?window.location.href="message-board.php":$("#li_"+b).remove()))},error:function(){$("#emh-contact-msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){$("#email-updates").on("change",function(a){close_navigation_first();var b=$("#opt-inout").html();$.ajax({dataType:"JSON",url:"process-email-optinout.php",type:"POST",data:$("#emailopt-form").serialize(),beforeSend:function(a){},success:function(a){a&&(console.log(a),"ok"==a.signal?"Email updates: Enabled"==b?($("#opt-inout").html("Email updates: OFF"),$("#email-opt-msg").html('<div class="alert alert-warning">You will not receive email updates from this website. If you have meeting(s) hosted for the public you will still get emails from visitors or if an issue is logged against your meeting.</div>')):($("#opt-inout").html("Email updates: Enabled"),$("#email-opt-msg").html("")):$("#email-opt-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#email-opt-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(document).ready(function(){$(".tab").hide(),$(".tab.focus").show(),$(".tabs .tab-links a").on("click",function(a){close_navigation_first();var b=$(this).attr("href");$(".tabs "+b).slideDown(400).siblings().slideUp(400),$(this).parent("li").addClass("focus").siblings().removeClass("focus"),a.preventDefault()})}),$(document).ready(function(){$(document).on("change","#transfer-usr",function(){var a=$("#transfer-usr").val().substr($("#transfer-usr").val().indexOf(",")+1),b=$("#transfer-usr").val().substr(0,$("#transfer-usr").val().indexOf(",")),c="<p>Email: "+$("#transfer-usr").val().substr($("#transfer-usr").val().indexOf(",")+1)+"</p>";"empty"!=a?($("#flash-email-top").html(c),$("#new-email-top").val(a),$("#new-usrnm-top").val(b)):($("#new-email-top").val("empty"),$("#flash-email-top").html(""))}),$(document).on("change","#transfer-usrz",function(){var a=$("#transfer-usrz").val().substr($("#transfer-usrz").val().indexOf(",")+1),b=$("#transfer-usrz").val().substr(0,$("#transfer-usrz").val().indexOf(",")),c="<p>Username: "+$("#transfer-usrz").val().substr(0,$("#transfer-usrz").val().indexOf(","))+"</p>";"empty"!=a?($("#flash-username-top").html(c),$("#new-email-topz").val(a),$("#new-usrnm-topz").val(b)):($("#new-email-topz").val("empty"),$("#flash-username-top").html(""))}),$(document).on("change","#mng-usr",function(){var a=$("#mng-usr").val().substr($("#mng-usr").val().indexOf(",")+1),b="<p>Email: "+$("#mng-usr").val().substr($("#mng-usr").val().indexOf(",")+1)+"</p>";"empty"!=a?$("#um-email-top").html(b):$("#um-email-top").html("")}),$(document).on("change","#mng-usrz",function(){var a=$("#mng-usrz").val().substr($("#mng-usrz").val().indexOf(",")+1),b="<p>Username: "+$("#mng-usrz").val().substr($("#mng-usrz").val().indexOf(",")+1)+"</p>";"empty"!=a?$("#um-un-btm").html(b):$("#um-un-btm").html("")}),$(document).on("change","#mng-usrzz",function(){var a=$("#mng-usrzz").val().substr($("#mng-usrzz").val().indexOf(",")+1),b="<p>Email: "+$("#mng-usrzz").val().split(",")[2].substr($("#mng-usrzz").val())+"</p>";"empty"!=a?$("#um-un-btmz").html(b):$("#um-un-btmz").html("")}),$("#whoops").click(function(){close_navigation_first(),location.reload()})}),$(document).ready(function(){$(document).on("click","#transfer-this-top",function(){close_navigation_first();var a=$("#new-usrnm-top").val(),b=$("#new-email-top").val();$.ajax({dataType:"JSON",url:"process-transfer-meeting.php",type:"POST",data:$("#transfer-form-top").serialize(),beforeSend:function(a){$("#trans-msg").html('<span class="sending-msg">Transferring - one moment...</span>')},success:function(c){c&&(console.log(c),"ok"==c.signal?($("#trans-h2").html("Meeting Transferred"),$("#current-host").html("New Host: "+a+" &bullet; "+b),$("#tabs").html(""),$("#transfer-form").html(""),$("#hide-on-success").html(""),$("#transfer-form-top").html(""),$("#trans-msg").html('<span class="sending-msg">Transfer successful!</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#trans-msg").html('<div class="alert alert-warning">'+c.msg+"</div>"))},error:function(){$("#trans-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})}),$(document).on("click","#transfer-this-topz",function(){close_navigation_first();var a=$("#new-usrnm-topz").val(),b=$("#new-email-topz").val();$.ajax({dataType:"JSON",url:"process-transfer-meeting.php",type:"POST",data:$("#transfer-form-topz").serialize(),beforeSend:function(a){$("#trans-msg").html('<span class="sending-msg">Transferring - one moment...</span>')},success:function(c){c&&(console.log(c),"ok"==c.signal?($("#trans-h2").html("Meeting Transferred"),$("#current-host").html("New Host: "+a+" &bullet; "+b),$("#tabs").html(""),$("#transfer-form").html(""),$("#hide-on-success").html(""),$("#transfer-form-top").html(""),$("#trans-msg").html('<span class="sending-msg">Transfer successful!</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#trans-msg").html('<div class="alert alert-warning">'+c.msg+"</div>"))},error:function(){$("#trans-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})}),$(document).on("click","#transfer-this",function(){close_navigation_first();var a=$("#new-email").val();$.ajax({dataType:"JSON",url:"process-transfer-meeting.php",type:"POST",data:$("#transfer-form").serialize(),beforeSend:function(a){$("#trans-msg").html('<span class="sending-msg">Transferring - one moment...</span>')},success:function(b){b&&(console.log(b),"ok"==b.signal?($("#trans-h2").html("Meeting Transferred"),$("#current-host").html("New Host: "+a),$("#tabs").html(""),$("#transfer-form").html(""),$("#transfer-form-top").html(""),$("#hide-on-success").html(""),$("#trans-msg").html('<span class="sending-msg">Transfer successful!</span>'),$("#imnadmin").length&&$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#trans-msg").html('<div class="alert alert-warning">'+b.msg+"</div>"))},error:function(){
$("#trans-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(".radio-groupz .radioz").click(function(){close_navigation_first();var a=$("#sus-note").val();if($(this).hasClass("user-suspended")&&$(this).hasClass("selected"))return $(this).toggleClass("user-suspended")&&$(this).toggleClass("selected"),$("#role-h2").toggleClass("downgrade"),$("#sus-reason").slideToggle(),void $("#gdtrfb").html('<a id="select-role-first">Select a User Role</a>');if($(this).hasClass("selected"))return $(this).toggleClass("selected"),void $("#gdtrfb").html('<a id="select-role-first">Select a User Role</a>');$(this).parent().find(".radioz").removeClass("selected"),$(this).addClass("selected");var b=$(this).attr("value");$(this).parent().find("input[name=admin]").val(b),0==$(this).parent().find("input").val()||2==$(this).parent().find("input").val()||3==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?$("#gdtrfb").html('<a id="change-user-role">Change User Role</a>'):($(this).removeClass("user-suspended"),$("#role-h2").removeClass("downgrade"),$("#role-h2").addClass("upgrade"),$("#gdtrfb").html('<a id="change-user-role">Change User Role</a>'),$("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">'+a+"</textarea>")):85==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?($("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">'+a+"</textarea>"),$("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>'),$("#role-h2").removeClass("upgrade"),$("#role-h2").addClass("downgrade"),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>'),$(this).addClass("user-suspended")):86==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?($("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">'+a+"</textarea>"),$("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>'),$("#role-h2").removeClass("upgrade"),$("#role-h2").addClass("downgrade"),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>'),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="select-role-first">You gotta pick a somethin</a>'),$("#sus-reason").slideUp().html(""))}),$(document).ready(function(){$(document).on("click","#suspend-user",function(){close_navigation_first(),$.ajax({dataType:"JSON",url:"process_suspend_user.php",type:"POST",data:$("#suspend-form").serialize(),beforeSend:function(a){$("#sus-msg").html('<span class="sending-msg">Working on it - one moment...</span>')},success:function(a){a&&(console.log(a),"86"==a.signal?($("#role-h2").html("User Demoted"),$("#current-role").html("Suspended - All meetings set to Draft"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg downgraded">You done smoked that cat right up outta here!</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):"85"==a.signal?($("#role-h2").html("User Demoted"),$("#current-role").html("Suspended - Any meetings remain active"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg downgraded">User is suspended but their meetings remain.</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#sus-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#sus-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","#change-user-role",function(){close_navigation_first(),$.ajax({dataType:"JSON",url:"process_change_role.php",type:"POST",data:$("#suspend-form").serialize(),beforeSend:function(a){$("#sus-msg").html('<span class="sending-msg">Working on it - one moment...</span>')},success:function(a){a&&(console.log(a),"2"==a.signal?($("#role-h2").html("User Managed"),$("#current-role").html("Level II Administrator"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to ADMIN Level II</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):"3"==a.signal?($("#role-h2").html("User Managed"),$("#current-role").html("Top Tier Administrator"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to ADMIN TOP TIER</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):"0"==a.signal?($("#role-h2").html("User Managed"),$("#current-role").html("Member"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to Member successfully</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#sus-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#sus-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})});