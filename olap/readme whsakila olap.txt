1. Letakkan file mondrian.war pada folder /tomcat/webapps   di folder instalasi XAMPP
2. Buka XAMPP Control Panel, Jalankan TOMCAT dengan klik catalina_start. Tunggu Hingga terbentuk folder mondrian. 
3. Setelah terbentuk folder mondrian, maka lakukan stop_catalina
4. Setelah stop_catalina maka kita bisa langsung memindahkan mondria.war
5. Setelah itu kita edit bagian index.html, untuk terintegrasi dengan whsakila 
6. Tambahkan mysql connector pada lib agar datawarehouse dapat terintegrasi.
7. Edit Test Page dan tambahkan whsakila.jsp ke dalam queries 
8. Kemudian untuk mengintegrasikan data antar tabel pada data warehouse buatlah dwsakila pada queries. Kemudian coba untuk run localhost:8080/mondrian/index.html maka olap akan muncul.


