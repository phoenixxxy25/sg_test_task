function post_query( url, name, data ) {
	var str = '';
	//alert('WORKING');

	$.each( data.split('.'), function(k, v) {
		str += '&' + v + '=' + $('#' + v).val();
	} );


	$.ajax({
		url : url+'Request',
		type: 'POST',
		data: name + '_f=1' + str,
		cache: false,
		success: function( result ) {

			obj = jQuery.parseJSON( result );
			if(obj.fail != null)  fail_message(obj.fail)
			else {
				if(obj.redirect != null) { redirect(obj.redirect);}
				else { alert(obj.fail); }
			}
		}
	});

}


function redirect( url ) {
	window.location.href='/' + url;
}

function fail_message(message) {
	$('#fail_message_pool').html('<div class="error_pool">'+message+'</div>');
}

function addComment(id, text, author, rating){
	$('#comments_pool').append('<div class="comment_item"  id="c'+id+'"><span style="font-weight: bold;">'+author+'</span> rating:<span id="cr'+id+'">'+rating+'</span><br><div class="commText" id="cText'+id+'">'+text+'</div><button onclick="deleteCommentary('+id+')" class="comm_control_btn btn_del_comm">удалить</button><button onclick="editComm('+id+')" class="comm_control_btn btn_edit_comm">редактировать</button></div>');
}


function checkFail(obj)
	{
		if(obj.fail != null){
			fail_message(obj.fail);
			return true;
		}
		else return false;
	}

	function sendCommentary(postid){
		//alert($('#comment').val());
		if($('#comment').val().length < 3){
       		fail_message("Ошибка: Слишком короткий комментарий!");
   		}
   		else {
			var message = $('#comment').val();
			var author = 'NIGGA';
			//console.log(message);

			$.ajax({
			   type:'POST',
			   url:'/comment/'+postid,
			   data: {text: message},
			   success:function(data){
			   		obj = jQuery.parseJSON(data);
			   		if(checkFail(obj) == false){
			   			addComment(obj.comment_id, obj.comment_text, obj.comment_author, 0);
			   			$('#comment').val("");
		   			}
		   			if($('#no_one_c') != null) $('#no_one_c').remove();
		   		}
		   			
			});
		}
	}

	// function rewriteCommentary(id){
	// 	var new_text = $('#comment').val();
	// 	var commid = id;
	// 	$.ajax({
	// 	   type:'POST',
	// 	   url:'/comment/'+commid,
	// 	   data: {r: 'r', ntext: new_text},
	// 	   success:function(data){
	// 	   		obj = jQuery.parseJSON(data);
	// 	   		if(obj.update_result != null) {
	// 	   			$('#cText'+commid).text(obj.update_result); //$('#cText'+commid).val(obj.update_result);
	// 				$('#c'+id).css("display","block");
	// 				$('#comment').val("");

	// 				$('#canceleditcomm').remove(); $('#editcomm').remove();
	// 				$('#comm_control').html('<button id="send_comment" onclick="sendCommentary(0)" class="comm_control_btn" type="button">Отправить</button>');


	// 	   		}
		   		
 //   			}
	// 	});		
	// }

	function deleteCommentary(id){
		var commid = id;
		console.log(commid);
		$.ajax({
		   type:'POST',
		   url:'/comment/'+commid,
		   data: {d: 'd'},
		   success:function(data){
		   		obj = jQuery.parseJSON(data);
		   		if(obj.delete_result != null){
		   			if(obj.delete_result == 'done') { $('#c'+commid).remove(); }
	   				else if(obj.delete_result == 'fail'){ alert('not deleted!'); }
   					else { alert('error'); }
		   		}

   			}
		});
	}

	function rateCommentary(id){
		var commid = id;
		
		$.ajax({
		   type:'POST',
		   url:'/comment/'+commid,
		   data: {rt: 'rt'},
		   success:function(data){
		   		obj = jQuery.parseJSON(data);
		   		if(obj.rate_result != null){
			   		if(obj.rate_result != 'fail')
			   		{
			   			$('#cr'+commid).html(obj.rate_result);
			   		}
			   	}
	   		}
		});
	}


	function editComm(id){

		var ctext = $('#cText'+id).text().replace(/\s+/g, ' ');
		$('#comment').val(ctext); //$('#comment').val(ctext);
		$('#send_comment').remove();
		$('#c'+id).css("display","none");

		$('#comm_control').html('<button id="canceleditcomm" onclick="cancelEditComm('+id+')" class="comm_control_btn btn_del_comm" type="button">Отменить</button><button id="editcomm" onclick="rewriteCommentary('+id+')" class="comm_control_btn btn_edit_comm" type="button">Сохранить</button>');
		//buttons created
	}

	// function cancelEditComm(id)
	// {
	// 	$('#comment').val("");
	// 	$('#editcomm').remove();
	// 	$('#canceleditcomm').remove();
	// 	$('#c'+id).css("display","block");
	// 	$('#comm_control').html('<button id="send_comment" onclick="sendCommentary(0)" class="comm_control_btn" type="button">Отправить</button>');
	// }

	function deletePost(id)
	{
		var post_id = id*1;
		$.ajax({
		   type:'POST',
		   url:'deleteRequest',
		   data: {id: post_id},
		   success:function(data){
		   		obj = jQuery.parseJSON(data);
		   		if(obj.delete_post_result != null){
		   			if(obj.delete_post_result == 'done') redirect('');
	   				else fail_message(obj.delete_post_result);
		   		}
		   		else { alert('error'); }
	   		}
		});
	}
