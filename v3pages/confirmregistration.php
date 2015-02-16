 <div class="successHolder topMargin whiteText" >
           <?=isset($message)?$message:"";?>
 </div>
<script>
	$(document).ready(function(){
		$(".successHolder").show();
		$(".leftHolder").css({"margin-left":"180px","min-height":"45px"});
	})
</script>

