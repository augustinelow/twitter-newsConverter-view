$(document).ready(function(){
	$(".catbtn").click(function(){
		var catid = $(this).attr("data-catid");
		var id = $("#id").html();
		var articleTitle = $("#articleTitle").attr("value");
		var link = $("#link").attr("value");
		var notes = $("#notes").attr("value");
		var nextId= id-1;
		$.ajax({
			type:"POST",
			url:"updateAjax.php",
			data:{category:catid,articleTitle:articleTitle,link:link,notes:notes,id:id},
			success:function(data){
				//alert(data);
				window.location="view.php?id="+nextId;
			}		
		});
	});
	
	$(".del_tweet_btn").click(function(){
		var str_id = $(this).attr("data_id_str");
		$.ajax({
			type:"POST",
			url:"deleteTweetsAjax.php",
			data:{id:str_id,action:"delete_tweet_by_id"},
			success:function(data){
				$("#"+str_id).hide();
			}		
		});		

	});
	
	$(".del_othertweets_butthis_btn").click(function(){
		var str_id = $(this).attr("data_id_str");
		var link = $(this).attr("data_link");
		var curr = $(this);
		$.ajax({
			type:"POST",
			url:"deleteTweetsAjax.php",
			data:{id:str_id,link:link,action:"delete_tweet_by_link_butthis"},
			success:function(data){
				curr.parent().parent().siblings().hide();
			}		
		});				

	});
	
	$(".del_all_tweet_with_link_btn").click(function(){
		var link = $(this).attr("data_link");
		curr= $(this);
		$.ajax({
			type:"POST",
			url:"deleteTweetsAjax.php",
			data:{link:link,action:"delete_tweet_by_link"},
			success:function(data){
				curr.parent().parent().hide();
			}		
		});		
	});
});

