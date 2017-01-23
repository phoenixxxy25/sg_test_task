<button onclick="redirect('')" class="comm_control_btn btn_home">Главная</button>
<h1>Article #<?=$post_stuff['post']['id']?></h1>

<div id="fail_message_pool"></div>

<button onclick="deletePost(<?=$post_stuff['post']['id']?>)" class="comm_control_btn btn_del">Удалить</button>

<div class="block" style="margin: 0">
	<article><?=$post_stuff['post']['text']?><h3>Автор:<?=$post_stuff['post']['author']?></h3></article>
</div>

<div class="comments">
	<div id="comments_pool">
		<textarea id="comment" class="comm_ta" maxlength="99" placeholder="Комментарий"></textarea>
		<div id="comm_control" class="comm_control">
			<button id="send_comment" onclick="sendCommentary(<?=$post_stuff['post']['id']?>)" class="comm_control_btn" type="button">Отправить</button>
		</div>

	<h3>Комментарии:</h3>

		<?if($post_stuff['comments']){?>
			<?foreach ($post_stuff['comments'] as $key => $comment) {?>

				<div class="comment_item"  id="c<?=$comment['id']?>">

					<span style="font-weight: bold;"><?=$comment['author']?></span>
					 rating:<span id="cr<?=$comment['id']?>"><?=$comment['rating']?></span><br>
					<div class="commText" id="cText<?=$comment['id']?>">
						<?=$comment['text']?>
					</div>
					
					<?if(isset($_SESSION['user_id'])){?> 
						<?if($_SESSION['user_login'] == $comment['author']){?>
							<button onclick="deleteCommentary(<?=$comment['id']?>)" class="comm_control_btn btn_del_comm">удалить</button>
							<button onclick="editComm(<?=$comment['id']?>)" class="comm_control_btn btn_edit_comm">редактировать</button>
						<?}?>
						<?if($_SESSION['user_login'] != $comment['author']){?>
							<button onclick="rateCommentary(<?=$comment['id']?>)" class="comm_control_btn btn_rate_comm">+1</button>
						<?}?>
					<?}?>

				</div>

		<?}} else {?>
			<h3 id="no_one_c">комментариев пока нет</h3>
		<?}?>
	</div>
</div>



<script type="text/javascript">
	<!--Временно-вынуждено-->
	function cancelEditComm(id)
	{
		$('#comment').val("");
		$('#editcomm').remove();
		$('#canceleditcomm').remove();
		$('#c'+id).css("display","block");
		$('#comm_control').html('<button id="send_comment" onclick="sendCommentary(<?=$post_stuff['post']['id']?>)" class="comm_control_btn" type="button">Отправить</button>');
	}

		function rewriteCommentary(id){
		var new_text = $('#comment').val();
		var commid = id;
		$.ajax({
		   type:'POST',
		   url:'/comment/'+commid,
		   data: {r: 'r', ntext: new_text},
		   success:function(data){
		   		obj = jQuery.parseJSON(data);
		   		if(obj.update_result != null) {
		   			$('#cText'+commid).text(obj.update_result); //$('#cText'+commid).val(obj.update_result);
					$('#c'+id).css("display","block");
					$('#comment').val("");

					$('#canceleditcomm').remove(); $('#editcomm').remove();
					$('#comm_control').html('<button id="send_comment" onclick="sendCommentary(<?=$post_stuff['post']['id']?>)" class="comm_control_btn" type="button">Отправить</button>');


		   		}
		   		
   			}
		});		
	}


</script>