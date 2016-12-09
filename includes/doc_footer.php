<footer id="ask-footer1" class="ask-footer1 container">
		<!--Footer Medium-->
			<div class="">
				<div class="">
					<div class="row" style="margin-left: -5px; margin-right: -5px;">
						<div class="col-md-3 col-sm-12 col-xs-12 padding5">
							<div class="ask-footer-content ask-footer-background">
								<h4 class="text-uppercase">Sports</h4>
								<ul class="custom-nav">
									<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Newest Sport/NS') ), true);?>">Newest Sport</a></li>
									<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Online Sport/OS') ), true);?>">Online Sport</a></li>
									<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Verified Sport/VS') ), true);?>">Verified Sport</a></li>
									<li><a href="sadari.php">Sadari site</a></li>
									<li><a href="">yangbang site</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12 padding5">
							<div class="ask-footer-content ask-footer-background">
								<h4 class="text-uppercase">Bonus</h4>
								<ul class="custom-nav">
									<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Welcome Bonus/WB') ), true);?>">Welcome bonus</a></li>
									<li><a href="">Daily deposit bonus</a></li>
									<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Free Money/FM') ), true);?>">Free money</a></li>
									<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Combo Bonus/CB') ), true);?>">Combo bonus</a></li>
									<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Other Bonus/OB') ), true);?>">Other bonus</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12 padding5">
							<div class="ask-footer-content ask-footer-background">
								<h4 class="text-uppercase">Complaint</h4>
								<ul class="custom-nav">
									<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'OP' ), true);?>">Open</a></li>
									<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'RE' ), true);?>">Resolved</a></li>
									<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'UN' ), true);?>">Unresolved</a></li>
									<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'PI' ), true);?>">Payment issue</a></li>
									<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'BI' ), true);?>">Bonus issue</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12 padding5">
							<div class="ask-footer-content ask-footer-background">
								<h4 class="text-uppercase">고객센터</h4>
								<ul class="custom-nav">
									<li><a href="advertise.php">Advertise</a></li>
									<li><a href="sports-policy.php">Sports policy</a></li>
									<li><a href="certificate-of-trust.php">Certificate of Trust</a></li>
									<li><a href="news.php?cat=Site-News%2FSN">Betting site news</a></li>
									<li><a href="news.php?cat=Blog%2FB">Blog</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ask-copyright">
				<p>copright &copy; 2016 | Betting time | All Right Reserved</p>
			</div>
		</footer>
		<!--Footer Medium End-->
		<?php require_once('includes/chatBox.php'); ?>
	</div><!-- main -->
	


	    <?php require_once('includes/signup_modal.php'); ?>
	    <?php require_once('includes/login_modal.php'); ?>
	    <div class="modal fade" id="modalSocial" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ask-modal-dialog">
        <div class="modal-content ask-modal-content">
        	<div class="ask-modal-content" style="width:95%;margin:10px auto;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title modalSocialHeader"></h4>
                </div>
                <div class="modal-body modalSocialBody">
                    
                </div>
            </div>
        </div>
    </div>
</div>
		
	    <!-- Modal -->
<!-- <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ko', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
}
</script> -->
<!-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="assets/js/function.js"></script>
<script src="assets/js/readmore.js"></script>
<script>
	$('#content-read-more').readmore({speed: 500});
</script>
<script src="assets/js/lightbox-plus-jquery.min.js"></script>
<script src="assets/js/jquery.rateyo.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/jquery.cookie.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script type="text/javascript">
	$.loadChat = function(cu){
		if(cu){
			$.getJSON('chat_hndlr.php?a=READ&u=' + cu, function(d){
				$.each(d.chats, function(i, v){
					var _O = $('.' + i + ':eq(0)');
					$(_O).find(v.chatid).remove();
					if(d.stage == '_G')
						$(v.chats).appendTo(_O);
					else
						$(v.chats).prepandTo(_O);
					$(_O).on('scroll', function() {
				        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
				            $(_O).data('scroll', 1);
				        } else {
				        	$(_O).data('scroll', 0);
				        }
				    });
				    if($(_O).data('scroll')){
				    	$(_O).animate({ scrollTop: $(_O).prop("scrollHeight")}, 0);
					}
					$('.chat-msg-unread').each(function(){
						if($(this).not(':visible')){
							//alert('Hi');
						}
					});
				});
				//$.loadChat(cu);
			});
		}
		return true;
	};
	$(document).ready(function(){
		$(document).on('click', '.chatSend', function(){
			var _FO = $(this).parents('.myChatForm:eq(0)');
			$.post('chat_hndlr.php', $(_FO).serialize(), function(d){});
			$(_FO).find('.chatText').val('');
			var _O = $(this).parents('.chatBody:eq(0)').find('.___chatBoxBody___:eq(0)');
			$(_O).data('scroll', 1);																																																																																																																																																																																																																				
			return false;
		});
		$(document).on('keydown', '.chatText', function(event){
			if(event.keyCode == 13){
				$(this).parents('.myChatForm').find('.chatSend').click();
				event.preventDefault();
				return false;
			}
			return true;
		});

		setInterval(function(){ $.loadChat('<?php echo User::loggedInUserId();?>'); }, 1000);
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change', '#nickName', function(){
			jQuery.ajax({
				url: "check_availability.php",
				data:'nickName='+$("#nickName").val(),
				type: "POST",
				success:function(data){
					$("#user-availability-status").html('*' + data);
				},
				error:function (){}
			});
		});

		$(document).on('click', '.commentsFilter', function(){
			var t = $(this).data('filter');
			$('.commentsContainer > table.commentFilterTbl').addClass('commentFilterTblTmp');
			var x = [1, 2, 3, 4, 5];
			switch(t){
				case 'ALL':
				default:
					$('.commentsContainer > table.commentFilterTblTmp').each(function(){
						var p = $(this).data('rate');
						var i = $(this).data('idx');
						var c = $(this).clone();
						var cls = 'commentFilterTbl_' + p;
						$(c).addClass(cls).removeClass('commentFilterTblTmp');
						if($('.commentsContainer > table.commentFilterTblTmp:eq(' + i + ')').size() > 0){
							$(c).insertAfter('.commentsContainer > table.commentFilterTblTmp:eq(' + i + ')');
						} else {
							$(c).appendTo('.commentsContainer');
						}
					});
				break;
				case 'GOOD':
					$.each(x, function(i, v){
						var cls = 'commentFilterTbl_' + v;
						$('<span class="' + cls + ' tmpCommentFilterTbl"></span>').insertAfter('.commentsContainer > div.commentsFilterArea');
					});
					$('.commentsContainer > table.commentFilterTblTmp').each(function(){
						var p = $(this).data('rate');
						var c = $(this).clone();
						var cls = 'commentFilterTbl_' + p;
						$(c).addClass(cls).removeClass('commentFilterTblTmp');
						$(c).insertAfter('.commentsContainer > .' + cls + ':first');
					});
				break;
				case 'BAD':
					$.each(x, function(i, v){
						var cls = 'commentFilterTbl_' + v;
						$('<span class="' + cls + ' tmpCommentFilterTbl"></span>').appendTo('.commentsContainer');
					});
					$('.commentsContainer > table.commentFilterTblTmp').each(function(){
						var p = $(this).data('rate');
						var c = $(this).clone();
						var cls = 'commentFilterTbl_' + p;
						$(c).addClass(cls).removeClass('commentFilterTblTmp');
						//alert($('.commentsContainer > .' + cls + ':last-child').size());
						$(c).insertAfter('.commentsContainer > .' + cls + ':last');
					});
				break;
			}
			$('.commentsContainer > table.commentFilterTblTmp').remove();
			$('.commentsContainer > span.tmpCommentFilterTbl').remove();
			return false;
		});
		
		
		// $(document).on('show', '#myModal', function () {
		//   $('#myModalTwo').modal('hide');
		// });
		// $(document).on('show', '#myModalTwo', function () {
		//   $('#myModal').modal('hide');
		// })

		$(document).on('click', '.myModalThreeBtn, .myModalTwoBtn, .myModalBtn', function () {
			$(this).parents('.modal').find('.close').click();
		});

		<?php if(isset($_SESSION['postBack']['postLogin']) && count($_SESSION['postBack']['postLogin']) > 0 && !$User->checkLoginStatus()){ ?>
			// $('#signIn').bind( "click", function() {
			// 	alert("hi");
			// });
			// $('#signIn').click();
			// $(window).on('load', function(){
			// 	$('.myModalBtn').click();
			// });
		<?php } ?>
	});
</script>
<?php //print_r($_SESSION['postBack']['postLogin']);?>
</body>
</html>