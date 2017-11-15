$("#button_save").click(function(){
  $.ajax({
    type:'post',
      url:full_url()+'/save_data',
      headers: { 'x-validate':x_validate()},
      dataType:'json',
      data:{
          user:g_encode($("#foo").val()),
          pass:g_encode($("#bar").val())
      },
      success:function(response){
          if(response.status ==='success'){
              error_msg(1,response.msg);
          }
      }
  })
})
