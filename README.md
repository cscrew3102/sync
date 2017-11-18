sync framework v.1.0
===========================================================================================
edit config file on root dir

```
define('BASEURL','sync'); //leave blank if your project in root dir
```
create sub app
```
define('DIR_ROOT','admin staff');  // just separate with spaces
```
model authentication
```
define('BASEPATH')OR exit('exception alert');
```

**simple query**

get one row data
```
$query=$this::view_data('*','tabel',array('id'=>"'$id'"));
$result = $query->current();
```
you can used basic query to
```
$query=$this::view_data('*',"tabel WHERE id='$id'");
$result = $query->current();
```

get all data looping
```
$query = $this::view_data('*','tabel',array('id'=>"'$id'"));
foreach($query as $result){
    echo $result->field;
}
```
**view error query**
```
write this above your query
define('QUERY',TRUE);
```
**ajax request**
```
$("#login_siswa").click(function(){
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
			if(response.status === 'success'){
				redirect('./');
			}else{
				error_msg(2,response.msg);
			}
      }
  })
})
```
**get your data model**
```
$this::form_post('field');
```
**get your link post**
```
$url = $this::last_segment();
if($url === 'do_login' && $this::ajax_request()){
	//get your post field here
}
```
**to decode your encoded post**
```
$this::g_decode($field_post);
```
**session authentication**
```
$this::user_auth('session_name',ROOT_HOST.'/login');
```
