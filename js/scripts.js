function openNav(){var a=document.getElementById("side-nav");"300px"==a.style.width?a.style.width="0px":a.style.width="300px"}function closeNav(){document.getElementById("side-nav").style.width="0",$(".top-nav").removeClass("acty")}function close_navigation_first(){var a=document.getElementById("side-nav");"300px"==a.style.width&&($(".top-nav").removeClass("acty"),a.style.width="0px",stopPropagation())}$(document).ready(function(){var a=window.location.href;$("#url").val(a),$(".top-nav").on("click",function(){this.classList.toggle("acty")})}),$(document).ready(function(){$("#toggle-msg-one").click(function(a){a.preventDefault(),a.stopPropagation(),$("#msg-one").is(":hidden")?$("#msg-one").fadeIn(500):$("#msg-one").fadeOut(500)}),$("#toggle-role-key").click(function(a){a.preventDefault(),a.stopPropagation(),$("#role-key").is(":hidden")?$("#role-key").fadeIn(500):$("#role-key").fadeOut(500)})}),$(document).click(function(){var a=document.getElementById("side-nav");$("#msg-one").is(":visible")?$("#msg-one").fadeOut(500):$("#role-key").is(":visible")?$("#role-key").fadeOut(500):$("#lat-long").is(":visible")?$("#lat-long").fadeOut(500):$("#desc-loc").is(":visible")?$("#desc-loc").fadeOut(500):$("#pdf-upload").is(":visible")?$("#pdf-upload").fadeOut(500):$("#link-label").is(":visible")?$("#link-label").fadeOut(500):"300px"==a.style.width&&closeNav()}),$(".top-nav").click(function(a){a.stopPropagation()}),$(document).ready(function(){$("#usr-role-go").click(function(){close_navigation_first();var a=$("#mng-usr").val();"empty"!=a&&(window.location=a)}),$("#usr-role-goz").click(function(){close_navigation_first();var a=$("#mng-usrz").val();"empty"!=a&&(window.location=a)}),$("#usr-role-gozz").click(function(){close_navigation_first();var a=$("#mng-usrzz").val();"empty"!=a&&(window.location=a)})}),$(document).ready(function(){$(document).on("click","a[data-role=rnote]",function(){close_navigation_first();var a=$(this).data("id"),b=$("#uid_"+a).html();if($("#round2_"+a).html().length)var c=$("#"+a).html().replaceAll("<br>","\n").replaceAll("<br><br>","\n\n").trim();else var c=$("#"+a).html().replaceAll("<br>\n","\n").replaceAll("<br>\n<br>","\n").trim();$("#"+a).addClass("formhere"),$("#"+a).html('<form id="revise-sus-note"><textarea id="sus-note" name="reason" maxlength="250">'+c+'</textarea><input type="hidden" name="user-id" value="'+b+'"></form>'),$("#a_"+a).html('<a data-id="'+a+'" data-role="unote" class="reason-note rt sicon"><div class="tooltip"><span class="tooltiptext type">Save Edit</span><i class="far fa-save"></i></div></a> <a data-role="cnote" data-id="'+a+'" class="reason-note rt cicon"><div class="tooltip right"><span class="tooltiptext type">Cancel Edit</span><i class="fas fa-ban"></i></div></a>')}),$(document).on("click","a[data-role=cnote]",function(){close_navigation_first();var a=$(this).data("id");if($("#round2_"+a).html().length)var b=$("#round2_"+a).html();else var b=$("#on_"+a).html();$("#error_"+a).html(""),$("#"+a).html(b),$("#a_"+a).html('<a data-id="'+a+'" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right"><span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>'),$("#"+a).removeClass("formhere")}),$(document).on("click","a[data-role=unote]",function(){close_navigation_first();var a=$(this).data("id"),b=$("#sus-note").val().replaceAll("\n","<br>").trim();$.ajax({dataType:"JSON",url:"process-edit-sus_note.php",type:"POST",data:$("#revise-sus-note").serialize(),beforeSend:function(a){},success:function(c){c&&("ok"==c.signal?($("#a_"+a).html('<a data-id="'+a+'" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right"><span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>'),$("#"+a).removeClass("formhere"),$("#"+a).removeClass("emsg"),$("#error_"+a).html(""),$("#"+a).html(b),$("#round2_"+a).html(b)):$("#error_"+a).html('<div class="alert alert-warning ump">'+c.msg+"</div>"))},error:function(){$("#"+a).html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","a[data-role=ic]",function(){var a=$(this).data("id"),b=document.getElementById(a).value,c=document.createElement("textarea");document.body.appendChild(c),c.value=b,c.select(),document.execCommand("copy"),document.body.removeChild(c);var d=$(this);$(this).html('<i class="fas fa-check fa-fw"></i> ID Copied!'),$(this).addClass("copied"),setTimeout(function(){d.removeClass("copied"),d.html('<i class="far fa-arrow-alt-circle-up"></i> Copy ID</a>')},1e3)}),$(document).on("click","a[data-role=pc]",function(){var a=$(this).data("id"),b=document.getElementById(a).value,c=document.createElement("textarea");document.body.appendChild(c),c.value=b,c.select(),document.execCommand("copy"),document.body.removeChild(c);var d=$(this);$(this).html('<i class="fas fa-check fa-fw"></i> Password Copied!'),$(this).addClass("copied"),setTimeout(function(){d.removeClass("copied"),d.html('<i class="far fa-arrow-alt-circle-up"></i> Copy Password</a>')},1e3)}),$(document).on("click","a[data-role=em]",function(){var a=$(this).data("id"),b=document.getElementById(a).value,c=document.createElement("textarea");document.body.appendChild(c),c.value=b,c.select(),document.execCommand("copy"),document.body.removeChild(c);var d=$(this);$(this).html('<i class="fas fa-check fa-fw"></i> Addresses Copied!'),$(this).addClass("copied"),setTimeout(function(){d.removeClass("copied"),d.html('<i class="far fa-copy"></i> Copy Addresses</a>')},1e3)})}),$(document).ready(function(){$("input.timepicker").timepicker({timeFormat:"h:mm p",dynamic:!1,dropdown:!1,scrollbar:!1})}),$(".radio-group .radio").click(function(){close_navigation_first(),$(this).parent().find(".radio").removeClass("selected"),$(this).addClass("selected");var a=$(this).attr("value");$(this).parent().find("input").val(a)}),$('input[name="remember_me"]').change(function(){$(this).is(":checked")?($(".aa-rm-in").addClass("checkaroo"),$(".rm-rm").addClass("hot")):($(".aa-rm-in").removeClass("checkaroo"),$(".rm-rm").removeClass("hot"))}),$("#showLoginPass").click(function(){close_navigation_first();var a=document.getElementById("password");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide password'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show password'),a.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide password'),a.type="text"),!1}),$("#showSignupPass").click(function(){var a=document.getElementById("showPassword"),b=document.getElementById("showConf");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide passwords'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show passwords'),a.type="password",b.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide passwords'),a.type="text",b.type="text"),!1}),$(document).ready(function(){function a(a){"0"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add a PDF | 4 total'),"1"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining'),"2"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining'),"3"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining'),"4"==a&&$("#file-upload").html("That's all")}$(".day-content").hide(),$(".weekday-wrap").hide(),$("#msg-one").hide(),$("#role-key").hide(),$("#lat-long").hide(),$("#desc-loc").hide(),$("#pdf-upload").hide(),$("#link-label").hide(),$("#sus-reason").hide(),$("#email-bob").hide();var b=document.getElementById("hid-f1"),c=document.getElementById("hid-f2"),d=document.getElementById("hid-f3"),e=document.getElementById("hid-f4");$(".pdf1").hasClass("fixerror")||b&&b.value?$(".pdf1").show():$(".pdf1").hide(),$(".pdf2").hasClass("fixerror")||c&&c.value?$(".pdf2").show():$(".pdf2").hide(),$(".pdf3").hasClass("fixerror")||d&&d.value?$(".pdf3").show():$(".pdf3").hide(),$(".pdf4").hasClass("fixerror")||e&&e.value?$(".pdf4").show():$(".pdf4").hide(),$("#file-upload").click(function(){var b=$(".pdf-wrap:visible").length+1;$(this).html();return $(".pdf1").is(":hidden")?($(".pdf1").slideDown(),void a(b)):$(".pdf2").is(":hidden")?($(".pdf2").slideDown(),void a(b)):$(".pdf3").is(":hidden")?($(".pdf3").slideDown(),void a(b)):$(".pdf4").is(":hidden")?($(".pdf4").slideDown(),void a(b)):void 0}),$(".pdf-remove").click(function(){var b=$(".pdf-wrap:visible").length-1,c=$(this).closest(".pdf-wrap");c.hasClass("pdf1")&&($("#hid-f1").val(""),$(".pdf1_name").val(""),$("#pdf1").removeClass("fixerror"),$(".pdf1").slideUp(),a(b)),c.hasClass("pdf2")&&($("#hid-f2").val(""),$(".pdf2_name").val(""),$("#pdf2").removeClass("fixerror"),$(".pdf2").slideUp(),a(b)),c.hasClass("pdf3")&&($("#hid-f3").val(""),$(".pdf3_name").val(""),$("#pdf3").removeClass("fixerror"),$(".pdf3").slideUp(),a(b)),c.hasClass("pdf4")&&($("#hid-f4").val(""),$(".pdf4_name").val(""),$("#pdf4").removeClass("fixerror"),$(".pdf4").slideUp(),a(b))}),$("#review-mtg, #update-mtg").click(function(a){var b=document.getElementById("file1").files[0],c=document.getElementById("file2").files[0],d=document.getElementById("file3").files[0],e=document.getElementById("file4").files[0],f=document.getElementById("pdf1"),g=document.getElementById("pdf2"),h=document.getElementById("pdf3"),i=document.getElementById("pdf4");void 0!==e&&(e&&e.size<=2097152||(alert('Your file "'+e.name+'" in position 4 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),i.classList.add("fixerror"),a.preventDefault())),void 0!==d&&(d&&d.size<=2097152||(alert('Your file "'+d.name+'" in position 3 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),h.classList.add("fixerror"),a.preventDefault())),void 0!==c&&(c&&c.size<=2097152||(alert('Your file "'+c.name+'" in position 2 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),g.classList.add("fixerror"),a.preventDefault())),void 0!==b&&(b&&b.size<=2097152||(alert('Your file "'+b.name+'" in position 1 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),f.classList.add("fixerror"),a.preventDefault()))}),a($(".pdf-wrap:visible").length),$(".day").click(function(){close_navigation_first();var a=$(this),b=$(this).next(".day-content");$(".day-content").not(b).slideUp(),$(".day").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".daily-glance-wrap").click(function(){close_navigation_first();var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".daily-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".manage-glance-wrap").click(function(){close_navigation_first();var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".manage-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".collapse-day").click(function(){close_navigation_first();var a=$(this);$(".day-content").not(a).slideUp(),$(".day").removeClass("active")}),$("#toggle-contact-form").click(function(){return close_navigation_first(),$(this).toggleClass("active").next().slideToggle(600),"close"===$.trim($(this).text())?$(this).html("comments | questions | suggestions"):$(this).html("close"),!1})}),$("#toggle-lat-long-msg").click(function(a){$("#lat-long").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$("#toggle-descriptive-location").click(function(a){$("#desc-loc").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$("#toggle-pdf-info").click(function(a){$("#pdf-upload").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$("#toggle-link-label").click(function(a){$("#link-label").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$(".pdf-remove").click(function(a){a.stopPropagation()}),$("#gmaps").click(function(a){a.stopPropagation()}),$(".pdf").click(function(a){a.stopPropagation()}),$("#preamble").click(function(a){a.stopPropagation()}),$("#twelvesteps").click(function(a){a.stopPropagation()}),$("#traditions").click(function(a){a.stopPropagation()}),$("#topics").click(function(a){a.stopPropagation()}),$("#daccaa").click(function(a){a.stopPropagation()}),$(".manage-edit").click(function(a){a.stopPropagation()}),$(".manage-delete").click(function(a){a.stopPropagation()}),$(".youtube").click(function(a){a.stopPropagation()}),$(".omw").change(function(){$(".omw").not(this).prop("checked",!1)}),$(".oc").change(function(){$(".oc").not(this).prop("checked",!1)}),$(document).ready(function(){$("#emailBob").click(function(){$.ajax({dataType:"JSON",url:"contact-process.php",type:"POST",data:$("#contactForm").serialize(),beforeSend:function(a){$("#msg").html('<span class="email-me">Sending - one moment...</span>')},success:function(a){a&&(console.log(a),"ok"==a.signal?$("#contactForm").html("<span>Your message was sent successfully.</span>"):$("#msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","a[data-role=emh]",function(){var a=$(this).data("id"),b=$("#"+a).children("span[data-target=mtgid]").text(),c=$("#"+a).children("span[data-target=mtgtime]").text(),d=$("#"+a).children("span[data-target=mtgday]").text(),e=$("#"+a).children("span[data-target=mtgname]").text(),f=document.getElementById("theModal");$("#mtgid").val(b),$("#mtgname").html(c+", "+d+" - "+e),$("#mtgnamez").val(c+", "+d+" - "+e),$("body").addClass("noscrollz"),f.style.display="block"}),document.getElementsByClassName("closefp")[0].onclick=function(){$("#emh-contact").html('<input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="mtgname" id="mtgnamez"><label>Your name<input name="name" id="emh-name" class="edit-input link-name" type="text" maxlength="30"></label><label>Your email<input name="email" id="emh-email" class="edit-input link-email" type="email" maxlength="250"></label><label>Message<textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea></label><div id="emh-contact-msg"></div><div class="submit-links"><input type="button" id="emh-btn" class="send" value="Send"></div>'),$("body").removeClass("noscrollz"),theModal.style.display="none"}}),$(document).ready(function(){$(document).on("click","#emh-btn",function(){$.ajax({dataType:"JSON",url:"contact-host-process.php",type:"POST",data:$("#emh-contact").serialize(),beforeSend:function(a){$("#emh-contact-msg").html('<span class="sending-msg">Sending - one moment...</span>')},success:function(a){a&&(console.log(a),"ok"==a.signal?$("#emh-contact").html('<span class="success-emh">Your message was sent successfully.</span>'):$("#emh-contact-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#emh-contact-msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){$(".tab").hide(),$(".tab.focus").show(),$(".tabs .tab-links a").on("click",function(a){close_navigation_first();var b=$(this).attr("href");$(".tabs "+b).slideDown(400).siblings().slideUp(400),$(this).parent("li").addClass("focus").siblings().removeClass("focus"),a.preventDefault()})}),$(document).ready(function(){$(document).on("change","#transfer-usr",function(){var a=$("#transfer-usr").val().substr($("#transfer-usr").val().indexOf(",")+1),b=$("#transfer-usr").val().substr(0,$("#transfer-usr").val().indexOf(",")),c="<p>Email: "+$("#transfer-usr").val().substr($("#transfer-usr").val().indexOf(",")+1)+"</p>";"empty"!=a?($("#flash-email-top").html(c),$("#new-email-top").val(a),$("#new-usrnm-top").val(b)):($("#new-email-top").val("empty"),$("#flash-email-top").html(""))}),$(document).on("change","#transfer-usrz",function(){var a=$("#transfer-usrz").val().substr($("#transfer-usrz").val().indexOf(",")+1),b=$("#transfer-usrz").val().substr(0,$("#transfer-usrz").val().indexOf(",")),c="<p>Username: "+$("#transfer-usrz").val().substr(0,$("#transfer-usrz").val().indexOf(","))+"</p>";"empty"!=a?($("#flash-username-top").html(c),$("#new-email-topz").val(a),$("#new-usrnm-topz").val(b)):($("#new-email-topz").val("empty"),$("#flash-username-top").html(""))}),$(document).on("change","#mng-usr",function(){var a=$("#mng-usr").val().substr($("#mng-usr").val().indexOf(",")+1),b="<p>Email: "+$("#mng-usr").val().substr($("#mng-usr").val().indexOf(",")+1)+"</p>";"empty"!=a?$("#um-email-top").html(b):$("#um-email-top").html("")}),$(document).on("change","#mng-usrz",function(){var a=$("#mng-usrz").val().substr($("#mng-usrz").val().indexOf(",")+1),b="<p>Username: "+$("#mng-usrz").val().substr($("#mng-usrz").val().indexOf(",")+1)+"</p>";"empty"!=a?$("#um-un-btm").html(b):$("#um-un-btm").html("")}),$(document).on("change","#mng-usrzz",function(){var a=$("#mng-usrzz").val().substr($("#mng-usrzz").val().indexOf(",")+1),b="<p>Username: "+$("#mng-usrzz").val().substr($("#mng-usrzz").val().indexOf(",")+1)+"</p>";"empty"!=a?$("#um-un-btmz").html(b):$("#um-un-btmz").html("")}),$("#whoops").click(function(){close_navigation_first(),location.reload()})}),$(document).ready(function(){$(document).on("click","#transfer-this-top",function(){close_navigation_first();var a=$("#new-usrnm-top").val(),b=$("#new-email-top").val();$.ajax({dataType:"JSON",url:"process-transfer-meeting.php",type:"POST",data:$("#transfer-form-top").serialize(),beforeSend:function(a){$("#trans-msg").html('<span class="sending-msg">Transferring - one moment...</span>')},success:function(c){c&&(console.log(c),"ok"==c.signal?($("#trans-h2").html("Meeting Transferred"),$("#current-host").html("New Host: "+a+" &bullet; "+b),$("#tabs").html(""),$("#transfer-form").html(""),$("#hide-on-success").html(""),$("#transfer-form-top").html(""),$("#trans-msg").html('<span class="sending-msg">Transfer successful!</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#trans-msg").html('<div class="alert alert-warning">'+c.msg+"</div>"))},error:function(){$("#trans-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})}),$(document).on("click","#transfer-this-topz",function(){close_navigation_first();var a=$("#new-usrnm-topz").val(),b=$("#new-email-topz").val();$.ajax({dataType:"JSON",url:"process-transfer-meeting.php",type:"POST",data:$("#transfer-form-topz").serialize(),beforeSend:function(a){$("#trans-msg").html('<span class="sending-msg">Transferring - one moment...</span>')},success:function(c){c&&(console.log(c),"ok"==c.signal?($("#trans-h2").html("Meeting Transferred"),$("#current-host").html("New Host: "+a+" &bullet; "+b),$("#tabs").html(""),$("#transfer-form").html(""),$("#hide-on-success").html(""),$("#transfer-form-top").html(""),$("#trans-msg").html('<span class="sending-msg">Transfer successful!</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#trans-msg").html('<div class="alert alert-warning">'+c.msg+"</div>"))},error:function(){$("#trans-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})}),$(document).on("click","#transfer-this",function(){close_navigation_first();var a=$("#new-email").val();$.ajax({dataType:"JSON",url:"process-transfer-meeting.php",type:"POST",data:$("#transfer-form").serialize(),beforeSend:function(a){$("#trans-msg").html('<span class="sending-msg">Transferring - one moment...</span>')},success:function(b){b&&(console.log(b),"ok"==b.signal?($("#trans-h2").html("Meeting Transferred"),$("#current-host").html("New Host: "+a),$("#tabs").html(""),$("#transfer-form").html(""),$("#transfer-form-top").html(""),$("#hide-on-success").html(""),$("#trans-msg").html('<span class="sending-msg">Transfer successful!</span>'),$("#imnadmin").length&&$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#trans-msg").html('<div class="alert alert-warning">'+b.msg+"</div>"))},error:function(){$("#trans-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(".radio-groupz .radioz").click(function(){close_navigation_first();var a=$("#sus-note").val();if($(this).hasClass("user-suspended")&&$(this).hasClass("selected"))return $(this).toggleClass("user-suspended")&&$(this).toggleClass("selected"),$("#role-h2").toggleClass("downgrade"),$("#sus-reason").slideToggle(),void $("#gdtrfb").html('<a id="select-role-first">Select a User Role</a>');if($(this).hasClass("selected"))return $(this).toggleClass("selected"),void $("#gdtrfb").html('<a id="select-role-first">Select a User Role</a>');$(this).parent().find(".radioz").removeClass("selected"),$(this).addClass("selected");var b=$(this).attr("value");$(this).parent().find("input[name=admin]").val(b),0==$(this).parent().find("input").val()||2==$(this).parent().find("input").val()||3==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?$("#gdtrfb").html('<a id="change-user-role">Change User Role</a>'):($(this).removeClass("user-suspended"),$("#role-h2").removeClass("downgrade"),$("#role-h2").addClass("upgrade"),$("#gdtrfb").html('<a id="change-user-role">Change User Role</a>'),$("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">'+a+"</textarea>")):85==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?($("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">'+a+"</textarea>"),$("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>'),$("#role-h2").removeClass("upgrade"),$("#role-h2").addClass("downgrade"),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>'),$(this).addClass("user-suspended")):86==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?($("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">'+a+"</textarea>"),$("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>'),$("#role-h2").removeClass("upgrade"),$("#role-h2").addClass("downgrade"),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>'),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="select-role-first">You gotta pick a somethin</a>'),$("#sus-reason").slideUp().html(""))}),$(document).ready(function(){$(document).on("click","#suspend-user",function(){close_navigation_first(),$.ajax({dataType:"JSON",url:"process_suspend_user.php",type:"POST",data:$("#suspend-form").serialize(),beforeSend:function(a){$("#sus-msg").html('<span class="sending-msg">Working on it - one moment...</span>')},success:function(a){a&&(console.log(a),"86"==a.signal?($("#role-h2").html("User Demoted"),$("#current-role").html("Suspended - All meetings set to Draft"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg downgraded">You done smoked that cat right up outta here!</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):"85"==a.signal?($("#role-h2").html("User Demoted"),$("#current-role").html("Suspended - Any meetings remain active"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg downgraded">User is suspended but their meetings remain.</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#sus-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#sus-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","#change-user-role",function(){close_navigation_first(),$.ajax({dataType:"JSON",url:"process_change_role.php",type:"POST",data:$("#suspend-form").serialize(),beforeSend:function(a){$("#sus-msg").html('<span class="sending-msg">Working on it - one moment...</span>')},success:function(a){a&&(console.log(a),"2"==a.signal?($("#role-h2").html("User Managed"),$("#current-role").html("Level II Administrator"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to ADMIN Level II</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):"3"==a.signal?($("#role-h2").html("User Managed"),$("#current-role").html("Top Tier Administrator"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to ADMIN TOP TIER</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):"0"==a.signal?($("#role-h2").html("User Managed"),$("#current-role").html("Member"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to Member successfully</span>'),$("#whoops").html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>'),$("#th-btn").html("")):$("#sus-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#sus-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})});