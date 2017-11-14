function start_loading(){
  var lod = document.createElement("div");
  lod.id="prelod";lod.style="width:100%;height:100%;position:fixed;color:#fff;top:0;left:0;z-index:999999;background:rgba(0,0,0,0.5)";
  lod.innerHTML = "<div style='position:absolute;left:50%;top:50%;margin-top:-10px;margin-left:-60px;height:20px;width:120px;'><img src='"+get_host()+"/core/img/loading.gif'> Loading . . .</div>";
  document.body.appendChild(lod);
}


function end_loading(){
    document.getElementById('prelod').remove();
}

function error_msg(type=1,text='~'){
    $("#msg_frame").remove();
    if(text ==='empty'){ var string="there are still empty of data that need to be completed, please check your data again";
    }else if(text === '~'){ var string ="there is an error in our system, please contact administrator";
    }else{ var string = text;}

    var div = document.createElement("div");
    if(type == '1'){ title = "Information !"; col = "green"; }else if(type == '2'){ title = "Notification !"; col = "orange";
    }else{ title = "Warning !"; col ="red"; }
    div.id="msg_frame";
    msg = "<div class='system_msg'><div class='col-sm-3'></div><div class='inline_msg col-sm-6'>"+
          "<div class='title'><h3 style='color:"+col+"'>"+title+"</h3></div>"+
          "<div class='text'>"+string+"</div>"+
          '<div class="btn_msg t_align_center" style="margin-left:-20px"><center><input type="submit" id="btnclose" class="btn btn-success btn-lg" onclick=close_msg("msg_frame") value="Close Message" style="padding:10px 40px;color:#fff"/></center></div>'+
          "</div><div class='col-sm-3'></div></div>";
    div.innerHTML = msg;
    document.body.appendChild(div);
    document.getElementById('btnclose').focus();
}



function close_msg(id){
    document.getElementById(id).remove();
}


function get_host(){
  var http = location.protocol;
  var slashes = http.concat("//");
  var host = slashes.concat(window.location.hostname);

  return host;
}


function patch_url(x){
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);
    var url = window.location.pathname.split( '/' );
    return host+'/'+url[x];
}

function full_url(){
    var url      = window.location.href;
    return url;
}

function segment(x){
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);
    var url = window.location.pathname.split( '/' );
    return url[x];
}



function hex2a(hex) {
    var str = '';
    for (var i = 0; i < hex.length; i += 2) {
        var v = parseInt(hex.substr(i, 2), 16);
        if (v) str += String.fromCharCode(v);
    }
    return str;
}

;!function(g) {
	var $0 = [], // result
		$1 = [], // tail
		$2 = [], // blocks
		$3 = [], // s1
		$4 = ("0123456789abcdef").split(""), // hex
		$5 = [], // s2
		$6 = [], // state
		$7 = false, // is state created
		$8 = 0, // len_cache
		$9 = 0, // len
		BUF = [];

	// use Int32Array if defined
	if(g.Int32Array) {
		$1 = new Int32Array(16);
		$2 = new Int32Array(16);
		$3 = new Int32Array(4);
		$5 = new Int32Array(4);
		$6 = new Int32Array(4);
		BUF = new Int32Array(4);
	}else{
		var i;
		for(i = 0;i < 16;i++) $1[i] = $2[i] = 0;
		for(i = 0;i < 4;i++) $3[i] = $5[i] = $6[i] = BUF[i] = 0;
	}

	// fill s1
	$3[0] = 128;
	$3[1] = 32768;
	$3[2] = 8388608;
	$3[3] = -2147483648;

	// fill s2
	$5[0] = 0;
	$5[1] = 8;
	$5[2] = 16;
	$5[3] = 24;

	function encode(s) {
		var utf = "",
			enc = "",
			start = 0,
			end = 0;

		for(var i = 0, j = s.length;i < j;i++) {
			var c = s.charCodeAt(i);

			if(c < 128) {
				end++;
				continue;
			}else if(c < 2048)
				enc = String.fromCharCode((c >> 6) | 192, (c & 63) | 128);
			else
				enc = String.fromCharCode((c >> 12) | 224, ((c >> 6) & 63) | 128, (c & 63) | 128);

			if(end > start)
				utf += s.slice(start, end);

			utf += enc;
			start = end = i + 1;
		}

		if(end > start)
			utf += s.slice(start, j);

		return utf;
	}

	function md5_update(s) {
		var i, I;

		s += "";
		$7 = false;
		$8 = $9 = s.length;

		if($9 > 63) {
			getBlocks(s.substring(0, 64));
			md5cycle($2);
			$7 = true;

			for(i = 128;i <= $9;i += 64) {
				getBlocks(s.substring(i - 64, i));
				md5cycleAdd($2);
			}

			s = s.substring(i - 64);
			$9 = s.length;
		}

		$1[0] = $1[1] = $1[2] = $1[3] =
		$1[4] = $1[5] = $1[6] = $1[7] =
		$1[8] = $1[9] = $1[10] = $1[11] =
		$1[12] = $1[13] = $1[14] = $1[15] = 0;

		for(i = 0;i < $9;i++) {
			I = i & 3;
			if(I === 0)
				$1[i >> 2] = s.charCodeAt(i);
			else
				$1[i >> 2] |= s.charCodeAt(i) << $5[I];
		}
		$1[i >> 2] |= $3[i & 3];

		if(i > 55) {
			if($7) md5cycleAdd($1);
			else {
				md5cycle($1);
				$7 = true;
			}

			return md5cycleAdd([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, $8 << 3, 0]);
		}

		$1[14] = $8 << 3;

		if($7) md5cycleAdd($1);
		else md5cycle($1);
	}

	function getBlocks(s) {
		for(var i = 16;i--;) {
			var I = i << 2;
			$2[i] = s.charCodeAt(I) + (s.charCodeAt(I + 1) << 8) + (s.charCodeAt(I + 2) << 16) + (s.charCodeAt(I + 3) << 24);
		}
	}

	function md5(data, ascii, arrayOutput) {
		md5_update(ascii ? data : encode(data));

		var tmp = $6[0];$0[1] = $4[tmp & 15];
		$0[0] = $4[(tmp >>= 4) & 15];
		$0[3] = $4[(tmp >>= 4) & 15];
		$0[2] = $4[(tmp >>= 4) & 15];
		$0[5] = $4[(tmp >>= 4) & 15];
		$0[4] = $4[(tmp >>= 4) & 15];
		$0[7] = $4[(tmp >>= 4) & 15];
		$0[6] = $4[(tmp >>= 4) & 15];

		tmp = $6[1];$0[9] = $4[tmp & 15];
		$0[8] = $4[(tmp >>= 4) & 15];
		$0[11] = $4[(tmp >>= 4) & 15];
		$0[10] = $4[(tmp >>= 4) & 15];
		$0[13] = $4[(tmp >>= 4) & 15];
		$0[12] = $4[(tmp >>= 4) & 15];
		$0[15] = $4[(tmp >>= 4) & 15];
		$0[14] = $4[(tmp >>= 4) & 15];

		tmp = $6[2];$0[17] = $4[tmp & 15];
		$0[16] = $4[(tmp >>= 4) & 15];
		$0[19] = $4[(tmp >>= 4) & 15];
		$0[18] = $4[(tmp >>= 4) & 15];
		$0[21] = $4[(tmp >>= 4) & 15];
		$0[20] = $4[(tmp >>= 4) & 15];
		$0[23] = $4[(tmp >>= 4) & 15];
		$0[22] = $4[(tmp >>= 4) & 15];

		tmp = $6[3];$0[25] = $4[tmp & 15];
		$0[24] = $4[(tmp >>= 4) & 15];
		$0[27] = $4[(tmp >>= 4) & 15];
		$0[26] = $4[(tmp >>= 4) & 15];
		$0[29] = $4[(tmp >>= 4) & 15];
		$0[28] = $4[(tmp >>= 4) & 15];
		$0[31] = $4[(tmp >>= 4) & 15];
		$0[30] = $4[(tmp >>= 4) & 15];

		return arrayOutput ? $0 : $0.join("");
	}

	function R(q, a, b, x, s1, s2, t) {
		a += q + x + t;
		return ((a << s1 | a >>> s2) + b) << 0;
	}

	function md5cycle(k) {
		md5_rounds(0, 0, 0, 0, k);

		$6[0] = (BUF[0] + 1732584193) << 0;
		$6[1] = (BUF[1] - 271733879) << 0;
		$6[2] = (BUF[2] - 1732584194) << 0;
		$6[3] = (BUF[3] + 271733878) << 0;
	}

	function md5cycleAdd(k) {
		md5_rounds($6[0], $6[1], $6[2], $6[3], k);

		$6[0] = (BUF[0] + $6[0]) << 0;
		$6[1] = (BUF[1] + $6[1]) << 0;
		$6[2] = (BUF[2] + $6[2]) << 0;
		$6[3] = (BUF[3] + $6[3]) << 0;
	}

	function md5_rounds(a, b, c, d, k) {
		var bc, da;

		if($7) {
			a = R(((c ^ d) & b) ^ d, a, b, k[0], 7, 25, -680876936);
			d = R(((b ^ c) & a) ^ c, d, a, k[1], 12, 20, -389564586);
			c = R(((a ^ b) & d) ^ b, c, d, k[2], 17, 15, 606105819);
			b = R(((d ^ a) & c) ^ a, b, c, k[3], 22, 10, -1044525330);
		}else{
			a = k[0] - 680876937;
			a = ((a << 7 | a >>> 25) - 271733879) << 0;
			d = k[1] - 117830708 + ((2004318071 & a) ^ -1732584194);
			d = ((d << 12 | d >>> 20) + a) << 0;
			c = k[2] - 1126478375 + (((a ^ -271733879) & d) ^ -271733879);
			c = ((c << 17 | c >>> 15) + d) << 0;
			b = k[3] - 1316259209 + (((d ^ a) & c) ^ a);
			b = ((b << 22 | b >>> 10) + c) << 0;
		}

		a = R(((c ^ d) & b) ^ d, a, b, k[4], 7, 25, -176418897);
		d = R(((b ^ c) & a) ^ c, d, a, k[5], 12, 20, 1200080426);
		c = R(((a ^ b) & d) ^ b, c, d, k[6], 17, 15, -1473231341);
		b = R(((d ^ a) & c) ^ a, b, c, k[7], 22, 10, -45705983);
		a = R(((c ^ d) & b) ^ d, a, b, k[8], 7, 25, 1770035416);
		d = R(((b ^ c) & a) ^ c, d, a, k[9], 12, 20, -1958414417);
		c = R(((a ^ b) & d) ^ b, c, d, k[10], 17, 15, -42063);
		b = R(((d ^ a) & c) ^ a, b, c, k[11], 22, 10, -1990404162);
		a = R(((c ^ d) & b) ^ d, a, b, k[12], 7, 25, 1804603682);
		d = R(((b ^ c) & a) ^ c, d, a, k[13], 12, 20, -40341101);
		c = R(((a ^ b) & d) ^ b, c, d, k[14], 17, 15, -1502002290);
		b = R(((d ^ a) & c) ^ a, b, c, k[15], 22, 10, 1236535329);

		a = R(((b ^ c) & d) ^ c, a, b, k[1], 5, 27, -165796510);
		d = R(((a ^ b) & c) ^ b, d, a, k[6], 9, 23, -1069501632);
		c = R(((d ^ a) & b) ^ a, c, d, k[11], 14, 18, 643717713);
		b = R(((c ^ d) & a) ^ d, b, c, k[0], 20, 12, -373897302);
		a = R(((b ^ c) & d) ^ c, a, b, k[5], 5, 27, -701558691);
		d = R(((a ^ b) & c) ^ b, d, a, k[10], 9, 23, 38016083);
		c = R(((d ^ a) & b) ^ a, c, d, k[15], 14, 18, -660478335);
		b = R(((c ^ d) & a) ^ d, b, c, k[4], 20, 12, -405537848);
		a = R(((b ^ c) & d) ^ c, a, b, k[9], 5, 27, 568446438);
		d = R(((a ^ b) & c) ^ b, d, a, k[14], 9, 23, -1019803690);
		c = R(((d ^ a) & b) ^ a, c, d, k[3], 14, 18, -187363961);
		b = R(((c ^ d) & a) ^ d, b, c, k[8], 20, 12, 1163531501);
		a = R(((b ^ c) & d) ^ c, a, b, k[13], 5, 27, -1444681467);
		d = R(((a ^ b) & c) ^ b, d, a, k[2], 9, 23, -51403784);
		c = R(((d ^ a) & b) ^ a, c, d, k[7], 14, 18, 1735328473);
		b = R(((c ^ d) & a) ^ d, b, c, k[12], 20, 12, -1926607734);

		bc = b ^ c;
		a = R(bc ^ d, a, b, k[5], 4, 28, -378558);
		d = R(bc ^ a, d, a, k[8], 11, 21, -2022574463);
		da = d ^ a;
		c = R(da ^ b, c, d, k[11], 16, 16, 1839030562);
		b = R(da ^ c, b, c, k[14], 23, 9, -35309556);
		bc = b ^ c;
		a = R(bc ^ d, a, b, k[1], 4, 28, -1530992060);
		d = R(bc ^ a, d, a, k[4], 11, 21, 1272893353);
		da = d ^ a;
		c = R(da ^ b, c, d, k[7], 16, 16, -155497632);
		b = R(da ^ c, b, c, k[10], 23, 9, -1094730640);
		bc = b ^ c;
		a = R(bc ^ d, a, b, k[13], 4, 28, 681279174);
		d = R(bc ^ a, d, a, k[0], 11, 21, -358537222);
		da = d ^ a;
		c = R(da ^ b, c, d, k[3], 16, 16, -722521979);
		b = R(da ^ c, b, c, k[6], 23, 9, 76029189);
		bc = b ^ c;
		a = R(bc ^ d, a, b, k[9], 4, 28, -640364487);
		d = R(bc ^ a, d, a, k[12], 11, 21, -421815835);
		da = d ^ a;
		c = R(da ^ b, c, d, k[15], 16, 16, 530742520);
		b = R(da ^ c, b, c, k[2], 23, 9, -995338651);

		a = R(c ^ (b | ~d), a, b, k[0], 6, 26, -198630844);
		d = R(b ^ (a | ~c), d, a, k[7], 10, 22, 1126891415);
		c = R(a ^ (d | ~b), c, d, k[14], 15, 17, -1416354905);
		b = R(d ^ (c | ~a), b, c, k[5], 21, 11, -57434055);
		a = R(c ^ (b | ~d), a, b, k[12], 6, 26, 1700485571);
		d = R(b ^ (a | ~c), d, a, k[3], 10, 22, -1894986606);
		c = R(a ^ (d | ~b), c, d, k[10], 15, 17, -1051523);
		b = R(d ^ (c | ~a), b, c, k[1], 21, 11, -2054922799);
		a = R(c ^ (b | ~d), a, b, k[8], 6, 26, 1873313359);
		d = R(b ^ (a | ~c), d, a, k[15], 10, 22, -30611744);
		c = R(a ^ (d | ~b), c, d, k[6], 15, 17, -1560198380);
		b = R(d ^ (c | ~a), b, c, k[13], 21, 11, 1309151649);
		a = R(c ^ (b | ~d), a, b, k[4], 6, 26, -145523070);
		d = R(b ^ (a | ~c), d, a, k[11], 10, 22, -1120210379);
		c = R(a ^ (d | ~b), c, d, k[2], 15, 17, 718787259);
		b = R(d ^ (c | ~a), b, c, k[9], 21, 11, -343485551);

		BUF[0] = a;
		BUF[1] = b;
		BUF[2] = c;
		BUF[3] = d;
	}

	g.md5 = g.md5 || md5;
}(typeof global === "undefined" ? window : global);


// base64  encode and decode
//=================================================
var base64 = {
// private property
_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

// public method for encoding
encode : function (input) {
    var output = "";
    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
    var i = 0;

    input = Base64._utf8_encode(input);

    while (i < input.length) {

        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;

        if (isNaN(chr2)) {
            enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
            enc4 = 64;
        }

        output = output +
        Base64._keyStr.charAt(enc1) + Base64._keyStr.charAt(enc2) +
        Base64._keyStr.charAt(enc3) + Base64._keyStr.charAt(enc4);

    }

    return output;
},

// public method for decoding
decode : function (input) {
    var output = "";
    var chr1, chr2, chr3;
    var enc1, enc2, enc3, enc4;
    var i = 0;

    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

    while (i < input.length) {

        enc1 = Base64._keyStr.indexOf(input.charAt(i++));
        enc2 = Base64._keyStr.indexOf(input.charAt(i++));
        enc3 = Base64._keyStr.indexOf(input.charAt(i++));
        enc4 = Base64._keyStr.indexOf(input.charAt(i++));

        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;

        output = output + String.fromCharCode(chr1);

        if (enc3 != 64) {
            output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
            output = output + String.fromCharCode(chr3);
        }

    }

    output = Base64._utf8_decode(output);

    return output;

},

// private method for UTF-8 encoding
_utf8_encode : function (string) {
    string = string.replace(/\r\n/g,"\n");
    var utftext = "";

    for (var n = 0; n < string.length; n++) {

        var c = string.charCodeAt(n);

        if (c < 128) {
            utftext += String.fromCharCode(c);
        }
        else if((c > 127) && (c < 2048)) {
            utftext += String.fromCharCode((c >> 6) | 192);
            utftext += String.fromCharCode((c & 63) | 128);
        }
        else {
            utftext += String.fromCharCode((c >> 12) | 224);
            utftext += String.fromCharCode(((c >> 6) & 63) | 128);
            utftext += String.fromCharCode((c & 63) | 128);
        }

    }

    return utftext;
},

// private method for UTF-8 decoding
_utf8_decode : function (utftext) {
    var string = "";
    var i = 0;
    var c = c1 = c2 = 0;

    while ( i < utftext.length ) {

        c = utftext.charCodeAt(i);

        if (c < 128) {
            string += String.fromCharCode(c);
            i++;
        }
        else if((c > 191) && (c < 224)) {
            c2 = utftext.charCodeAt(i+1);
            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
            i += 2;
        }
        else {
            c2 = utftext.charCodeAt(i+1);
            c3 = utftext.charCodeAt(i+2);
            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }

    }
    return string;
}
}

function StrtoHex(str) {
	var hex = '';
	for(var i=0;i<str.length;i++) {
		hex += ''+str.charCodeAt(i).toString(16);
	}
	return hex;
}


function HextoStr(hex){
  var str = '';
  for (var i = 0; i < hex.length; i += 2) {
      var v = parseInt(hex.substr(i, 2), 16);
      if (v) str += String.fromCharCode(v);
  }
  return str;
}

function b64encode(string){
    var chart = btoa(string);
    return chart;
}



function b64decode(string){
    var chart = atob(string);
    return chart;
}

function strrev(s) {
  var o = '';
  for (var i = s.length - 1; i >= 0; i--)
    o += s[i];
  return o;
}



// set header request ajax
//===============================================
function md5_header(){
    var jam = new Date();
    var jadi = jam.getFullYear()+'/'+(parseInt(jam.getMonth())+1)+'/'+jam.getDate();

    return md5(jadi);
}

function rands(){
    var st = Math.floor(Math.random() * (3 - 1 + 1)) + 1;
    var str = Math.floor(Math.random() * (9 - 1 + 1)) + 1;
    var strs = Math.floor(Math.random() * (9 - 1 + 1)) + 1;

    return st+''+str+''+strs;
}


function g_encode(string){
    for(a=1;a<=3;a++){
        string = strrev(b64encode(string+rands()));
    }
    return b64encode(StrtoHex(string));
}


function g_decode(string){
    var string = b64decode(string);
     string = HextoStr(string);
     strings = strrev(string);
    for(a=1;a<=2;a++){
        strings = strrev(b64decode(strings)).substring(3);
    }
    var tl = (b64decode(strings).length)-3;
    var maning= b64decode(strings).substring(0,tl);
    return maning;

}

function url_encode(string){
    var string = b64encode(string);
    string = strrev(string);
    string = b64encode(string);

    return StrtoHex(string);
}


function url_decode(string){
    var string = HextoStr(string);
    string = b64decode(string);
    string = strrev(string);

    return b64decode(string);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function x_validate(){
    var string = g_encode('banyumasweb');
    return string;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}


function json_form(data){
    var string = '{"data":[{';
    var strings='';stringa='';
    for(a=0;a<data.length;a++){
        strings += '"'+data[a][0]+'":'+data[a][1]+',';
    }
    strings = strings.replace(/,+$/, '');
    stringa +=string+''+strings+'}]}';
    return g_encode(stringa);
}

function redirect(x){
	window.location.replace(x);
}
