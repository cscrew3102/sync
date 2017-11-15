# sync
sync php framework
===========================================================================================

untuk pemasangan cukup buat file di dalam folder pages/views/index.php

di file index yang ada di view adalah untuk design template keseluruhan serta cukup menggunakan modal bawaan bootstrap 
sehingga membuat form edit akan lebih mudah

untuk perintah javascript cukup buat file di pages/js dengan extensi pages/js/index.js
sedangkan untuk seluruh proses dapat anda tuliskan di file pages/model/index.php

1.framework ini dirancang untuk seluruh pengiriman data menggunakan format json sehingga akan lebih ringan dan cepat dalah pengiriman data dan tidak mmebutuhkan jaringan internet yang besar jika sudah online.

2.framework dirancang dengan pengiriman data yang ter encryption sehingga proses pengiriman data dari server ke client maupun dari client ke server dalam kondisi data ter encrytion sehingga pengguna akan merasa lebih aman.

3.core framework ini dirancang untuk bisa menangani beberapa aplikasi sekaligus sehingga ukuran file tidak membengkak karna adanya core yang menumpuk dan secara otomatis akan lebih hemat space.

4.dengan penggunaan yang mudah karna semua controller sudah ditangani oleh core system sehingga anda tidak perlu lagi mendefinisikan file yang akan dipanggil.

5.dengan membuat file dengan nama yang sama antara views,model, dan js seluruh file anda sudah terkoneksi secara otomatis karna core system sudah menangani hal tersebut.

6.untuk membuat sub aplikasi anda hanya cukup membuat folder di dalam folder pages dengan nama yang sesuai dengan link yang akan anda panggil nantinya, misalnya administrator

7.do dalam folder administrator tersebuta anda buat lagi folder dengan nama views,model, dan js persisi dengan nama folder diatasnya


