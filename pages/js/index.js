$("#button_save").click(function(){
  $.ajax({
    type:'post',
      url:full_url()+'/do_login',
      headers: { 'x-validate':x_validate()},
      dataType:'json',
      data:{
          user:g_encode($("#user").val()),
          pass:g_encode($("#pass").val())
      },
      success:function(response){
          if(response.status ==='success'){
              error_msg(1,response.msg);
          }
      }
  })
})
