function copyToClipboardMsg(a,b){var c,d=copyToClipboard(a);c=d?'<i class="far fas fa-check"></i> ID copied!':"Press Ctrl+c to copy","string"==typeof b&&(b=document.getElementById(b)),b.innerHTML=c,b.style.background="#86e483",b.style.color="#106f0e",b.style.border="1px solid #fff",setTimeout(function(){b.innerHTML='<i class="far fa-arrow-alt-circle-up"></i> Copy ID',b.style.background="#626262",b.style.color="#fff",b.style.border="1px solid #757575"},1e3)}function copyToClipboardMsg_pswd(a,b){var c,d=copyToClipboard_pswd(a);c=d?'<i class="far fas fa-check"></i> Password copied!':"Press Ctrl+c to copy","string"==typeof b&&(b=document.getElementById(b)),b.innerHTML=c,b.style.background="#86e483",b.style.color="#106f0e",b.style.border="1px solid #fff",setTimeout(function(){b.innerHTML='<i class="far fa-arrow-alt-circle-up"></i> Copy Password',b.style.background="#626262",b.style.color="#fff",b.style.border="1px solid #757575"},1e3)}function copyToClipboard(a){var b,c,d="_hiddenCopyText_",e="INPUT"===a.tagName||"TEXTAREA"===a.tagName;if(e)f=a,b=a.selectionStart,c=a.selectionEnd;else{if(!(f=document.getElementById(d))){var f=document.createElement("textarea");f.style.position="absolute",f.style.left="-9999px",f.style.top="0",f.id=d,document.body.appendChild(f)}f.textContent=a.textContent}var g=document.activeElement;f.focus(),f.setSelectionRange(0,f.value.length);var h;try{h=document.execCommand("copy")}catch(i){h=!1}return g&&"function"==typeof g.focus&&g.focus(),e?a.setSelectionRange(b,c):f.textContent="",h}function copyToClipboard_pswd(a){var b,c,d="_hiddenCopyText_",e="INPUT"===a.tagName||"TEXTAREA"===a.tagName;if(e)f=a,b=a.selectionStart,c=a.selectionEnd;else{if(!(f=document.getElementById(d))){var f=document.createElement("textarea");f.style.position="absolute",f.style.left="-9999px",f.style.top="0",f.id=d,document.body.appendChild(f)}f.textContent=a.textContent}var g=document.activeElement;f.focus(),f.setSelectionRange(0,f.value.length);var h;try{h=document.execCommand("copy")}catch(i){h=!1}return g&&"function"==typeof g.focus&&g.focus(),e?a.setSelectionRange(b,c):f.textContent="",h}$(document).ready(function(){$(".foot").click(function(){$(".foot").hasClass("slide-up")?($(".foot").addClass("slide-down",250,"linear"),$(".foot").removeClass("slide-up")):($(".foot").removeClass("slide-down"),$(".foot").addClass("slide-up",250,"linear"))})});for(var but=document.getElementsByClassName("btn"),txt=document.getElementsByClassName("input-copy"),x=0;x<but.length;x++)!function(a){but[a].addEventListener("click",function(){copyToClipboardMsg(txt[a],but[a])},!1)}(x);for(var butz=document.getElementsByClassName("btnz"),txtz=document.getElementsByClassName("input-copyz"),x=0;x<butz.length;x++)!function(a){butz[a].addEventListener("click",function(){copyToClipboardMsg_pswd(txtz[a],butz[a])},!1)}(x);$(document).ready(function(){$("input.timepicker").timepicker({timeFormat:"h:mm p",dynamic:!1,dropdown:!1,scrollbar:!1})}),$(".radio-group .radio").click(function(){$(this).parent().find(".radio").removeClass("selected"),$(this).addClass("selected");var a=$(this).attr("value");$(this).parent().find("input").val(a)}),$('input[name="remember_me"]').change(function(){$(this).is(":checked")?($(".aa-rm-in").addClass("checkaroo"),$(".rm-rm").addClass("hot")):($(".aa-rm-in").removeClass("checkaroo"),$(".rm-rm").removeClass("hot"))}),$("button#showLoginPass").click(function(){var a=document.getElementById("password");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide password'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show password'),a.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide password'),a.type="text"),!1}),$("button#showSignupPass").click(function(){var a=document.getElementById("showPassword"),b=document.getElementById("showConf");return $(this).toggleClass("showPassOn"),'<i class="far fa-eye-slash"></i> Hide passwords'===$.trim($(this).html())?($(this).html('<i class="far fa-eye"></i> Show passwords'),a.type="password",b.type="password"):($(this).html('<i class="far fa-eye-slash"></i> Hide passwords'),a.type="text",b.type="text"),!1}),$(document).ready(function(){function a(a){"0"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add a PDF | 4 total'),"1"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining'),"2"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining'),"3"==a&&$("#file-upload").html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining'),"4"==a&&$("#file-upload").html("That's all")}$(".day-content").hide(),$(".weekday-wrap").hide(),$("#msg-one").hide(),$("#lat-long").hide(),$("#desc-loc").hide(),$("#pdf-upload").hide(),$("#link-label").hide(),$("#sus-reason").hide(),$("#email-bob").hide();var b=document.getElementById("hid-f1"),c=document.getElementById("hid-f2"),d=document.getElementById("hid-f3"),e=document.getElementById("hid-f4");$(".pdf1").hasClass("fixerror")||b&&b.value?$(".pdf1").show():$(".pdf1").hide(),$(".pdf2").hasClass("fixerror")||c&&c.value?$(".pdf2").show():$(".pdf2").hide(),$(".pdf3").hasClass("fixerror")||d&&d.value?$(".pdf3").show():$(".pdf3").hide(),$(".pdf4").hasClass("fixerror")||e&&e.value?$(".pdf4").show():$(".pdf4").hide(),$("#file-upload").click(function(){var b=$(".pdf-wrap:visible").length+1;$(this).html();return $(".pdf1").is(":hidden")?($(".pdf1").slideDown(),void a(b)):$(".pdf2").is(":hidden")?($(".pdf2").slideDown(),void a(b)):$(".pdf3").is(":hidden")?($(".pdf3").slideDown(),void a(b)):$(".pdf4").is(":hidden")?($(".pdf4").slideDown(),void a(b)):void 0}),$(".pdf-remove").click(function(){var b=$(".pdf-wrap:visible").length-1,c=$(this).closest(".pdf-wrap");c.hasClass("pdf1")&&($("#hid-f1").val(""),$(".pdf1_name").val(""),$("#pdf1").removeClass("fixerror"),$(".pdf1").slideUp(),a(b)),c.hasClass("pdf2")&&($("#hid-f2").val(""),$(".pdf2_name").val(""),$("#pdf2").removeClass("fixerror"),$(".pdf2").slideUp(),a(b)),c.hasClass("pdf3")&&($("#hid-f3").val(""),$(".pdf3_name").val(""),$("#pdf3").removeClass("fixerror"),$(".pdf3").slideUp(),a(b)),c.hasClass("pdf4")&&($("#hid-f4").val(""),$(".pdf4_name").val(""),$("#pdf4").removeClass("fixerror"),$(".pdf4").slideUp(),a(b))}),$("#review-mtg, #update-mtg").click(function(a){var b=document.getElementById("file1").files[0],c=document.getElementById("file2").files[0],d=document.getElementById("file3").files[0],e=document.getElementById("file4").files[0],f=document.getElementById("pdf1"),g=document.getElementById("pdf2"),h=document.getElementById("pdf3"),i=document.getElementById("pdf4");void 0!==e&&(e&&e.size<=2097152||(alert('Your file "'+e.name+'" in position 4 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),i.classList.add("fixerror"),a.preventDefault())),void 0!==d&&(d&&d.size<=2097152||(alert('Your file "'+d.name+'" in position 3 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),h.classList.add("fixerror"),a.preventDefault())),void 0!==c&&(c&&c.size<=2097152||(alert('Your file "'+c.name+'" in position 2 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),g.classList.add("fixerror"),a.preventDefault())),void 0!==b&&(b&&b.size<=2097152||(alert('Your file "'+b.name+'" in position 1 is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.'),f.classList.add("fixerror"),a.preventDefault()))}),a($(".pdf-wrap:visible").length),$(".day").click(function(){var a=$(this),b=$(this).next(".day-content");$(".day-content").not(b).slideUp(),$(".day").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".daily-glance-wrap").click(function(){var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".daily-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".manage-glance-wrap").click(function(){var a=$(this),b=$(this).next(".weekday-wrap");$(".weekday-wrap").not(b).slideUp(),$(".manage-glance-wrap").not(a).removeClass("active"),$(b).slideToggle(),$(a).hasClass("active")?$(a).removeClass("active"):$(a).addClass("active")}),$(".collapse-day").click(function(){var a=$(this);$(".day-content").not(a).slideUp(),$(".day").removeClass("active")}),$("#toggle-contact-form").click(function(){return $(this).toggleClass("active").next().slideToggle(600),"close"===$.trim($(this).text())?$(this).html('<i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i>'):$(this).html('<i class="fa fa-times-circle close-left" aria-hidden="true"></i> close <i class="fa fa-times-circle close-right" aria-hidden="true"></i>'),!1})}),setTimeout(function(){$("#success-wrap").fadeOut(1500)},2e3),$("#toggle-public-msg").click(function(a){a.preventDefault(),a.stopPropagation(),$("#msg-one").is(":hidden")?($("#msg-one").fadeIn(500),$("#toggle-public-msg").html("Close")):($("#msg-one").fadeOut(500),$("#toggle-public-msg").html("Readme"))}),$("#toggle-private-msg").click(function(a){a.preventDefault(),a.stopPropagation(),$("#msg-one").is(":hidden")?($("#msg-one").fadeIn(500),$("#toggle-private-msg").html("Close")):($("#msg-one").fadeOut(500),$("#toggle-private-msg").html("Extras"))}),$("#toggle-lat-long-msg").click(function(a){$("#lat-long").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$(document).click(function(){$("#lat-long").fadeOut(500)}),$("#toggle-descriptive-location").click(function(a){$("#desc-loc").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$(document).click(function(){$("#desc-loc").fadeOut(500)}),$("#toggle-pdf-info").click(function(a){$("#pdf-upload").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$(document).click(function(){$("#pdf-upload").fadeOut(500)}),$("#toggle-link-label").click(function(a){$("#link-label").fadeIn(500),a.preventDefault(),a.stopPropagation()}),$(document).click(function(){$("#link-label").fadeOut(500)}),$(document).click(function(){$("#msg-one").fadeOut(500),$("#toggle-public-msg").html("Readme"),$("#toggle-private-msg").html("Extras")}),$(".pdf-remove").click(function(a){a.stopPropagation()}),$("#gmaps").click(function(a){a.stopPropagation()}),$(".pdf").click(function(a){a.stopPropagation()}),$("#preamble").click(function(a){a.stopPropagation()}),$("#twelvesteps").click(function(a){a.stopPropagation()}),$("#traditions").click(function(a){a.stopPropagation()}),$("#topics").click(function(a){a.stopPropagation()}),$("#daccaa").click(function(a){a.stopPropagation()}),$(".manage-edit").click(function(a){a.stopPropagation()}),$(".manage-delete").click(function(a){a.stopPropagation()}),$(".youtube").click(function(a){a.stopPropagation()}),$(".omw").change(function(){$(".omw").not(this).prop("checked",!1)}),$(".oc").change(function(){$(".oc").not(this).prop("checked",!1)}),$(document).ready(function(){$("#emailBob").click(function(){$.ajax({dataType:"JSON",url:"contact-process.php",type:"POST",data:$("#contactForm").serialize(),beforeSend:function(a){$("#msg").html('<span class="email-me">Sending - one moment...</span>')},success:function(a){a&&(console.log(a),"ok"==a.signal?$("#contactForm").html("<span>Your message was sent successfully.</span>"):$("#msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","a[data-role=emh]",function(){var a=$(this).data("id"),b=$("#"+a).children("span[data-target=mtgid]").text(),c=$("#"+a).children("span[data-target=mtgtime]").text(),d=$("#"+a).children("span[data-target=mtgday]").text(),e=$("#"+a).children("span[data-target=mtgname]").text(),f=document.getElementById("theModal");$("#mtgid").val(b),$("#mtgname").html(c+", "+d+" - "+e),$("#mtgnamez").val(c+", "+d+" - "+e),$("body").addClass("noscrollz"),f.style.display="block"}),document.getElementsByClassName("closefp")[0].onclick=function(){$("#emh-contact").html('<input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="mtgname" id="mtgnamez"><label>Your name<input name="name" id="emh-name" class="edit-input link-name" type="text" maxlength="30"></label><label>Your email<input name="email" id="emh-email" class="edit-input link-email" type="email" maxlength="250"></label><label>Message<textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea></label><div id="emh-contact-msg"></div><div class="submit-links"><input type="button" id="emh-btn" class="send" value="Send"></div>'),$("body").removeClass("noscrollz"),theModal.style.display="none"}}),$(document).ready(function(){$(document).on("click","#emh-btn",function(){$.ajax({dataType:"JSON",url:"contact-host-process.php",type:"POST",data:$("#emh-contact").serialize(),beforeSend:function(a){$("#emh-contact-msg").html('<span class="sending-msg">Sending - one moment...</span>')},success:function(a){a&&(console.log(a),"ok"==a.signal?$("#emh-contact").html('<span class="success-emh">Your message was sent successfully.</span>'):$("#emh-contact-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#emh-contact-msg").html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","#transfer-this",function(){var a=$("#new-email").val();$.ajax({dataType:"JSON",url:"process-transfer-meeting.php",type:"POST",data:$("#transfer-form").serialize(),beforeSend:function(a){$("#trans-msg").html('<span class="sending-msg">Transferring - one moment...</span>')},success:function(b){b&&(console.log(b),"ok"==b.signal?($("#current-host").html("New Host: "+a),$("#trans-msg").html('<span class="sending-msg">Transfer successful!</span>'),$("#th-btn").html("")):$("#trans-msg").html('<div class="alert alert-warning">'+b.msg+"</div>"))},error:function(){$("#trans-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(".radio-groupz .radioz").click(function(){$(this).parent().find(".radioz").removeClass("selected"),$(this).addClass("selected");var a=$(this).attr("value");$(this).parent().find("input").val(a),0==$(this).parent().find("input").val()||2==$(this).parent().find("input").val()||3==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?$("#gdtrfb").html('<a id="change-user-role">Change User Role</a>'):($(this).removeClass("user-suspended"),$("#role-h2").removeClass("downgrade"),$("#role-h2").addClass("upgrade"),$("#gdtrfb").html('<a id="change-user-role">Change User Role</a>'),$("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason"></textarea>')):85==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?($("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason"></textarea>'),$("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>'),$("#role-h2").removeClass("upgrade"),$("#role-h2").addClass("downgrade"),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>'),$(this).addClass("user-suspended")):86==$(this).parent().find("input").val()?$("#sus-reason").is(":hidden")?($("#sus-reason").slideToggle().html('<p>Reason</p><textarea name="reason"></textarea>'),$("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>'),$("#role-h2").removeClass("upgrade"),$("#role-h2").addClass("downgrade"),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>'),$(this).addClass("user-suspended")):($("#gdtrfb").html('<a id="select-role-first">You gotta pick a somethin</a>'),$("#sus-reason").slideUp().html(""))}),$(document).ready(function(){$(document).on("click","#suspend-user",function(){$.ajax({dataType:"JSON",url:"process_suspend_user.php",type:"POST",data:$("#suspend-form").serialize(),beforeSend:function(a){$("#sus-msg").html('<span class="sending-msg">Working on it - one moment...</span>')},success:function(a){a&&(console.log(a),"86"==a.signal?($("#current-role").html("Suspended - All meetings set to Draft"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">You done smoked that cat right up outta here!</span>'),$("#th-btn").html("")):"85"==a.signal?($("#current-role").html("Suspended - Any meetings remain active"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User is suspended but their meetings remain.</span>'),$("#th-btn").html("")):$("#sus-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#sus-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})}),$(document).ready(function(){$(document).on("click","#change-user-role",function(){$.ajax({dataType:"JSON",url:"process_change_role.php",type:"POST",data:$("#suspend-form").serialize(),beforeSend:function(a){$("#sus-msg").html('<span class="sending-msg">Working on it - one moment...</span>')},success:function(a){a&&(console.log(a),"2"==a.signal?($("#current-role").html("Level II Administrator"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to ADMIN Level II</span>'),$("#th-btn").html("")):"3"==a.signal?($("#current-role").html("Top Tier Administrator"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to ADMIN TOP TIER</span>'),$("#th-btn").html("")):"0"==a.signal?($("#current-role").html("Member"),$("#suspend-form").html(""),$("#sus-msg").html('<span class="sending-msg">User priviliges set to Member successfully</span>'),$("#th-btn").html("")):$("#sus-msg").html('<div class="alert alert-warning">'+a.msg+"</div>"))},error:function(){$("#sus-msg").html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>')},complete:function(){}})})});