 <?php     

 $createTable = "CREATE TABLE IF NOT EXISTS review
         (
         id int(11) NOT NULL AUTO_INCREMENT,
         review_title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         customer_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         rating varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         image varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         status varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         visibility varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         review varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         created_by varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         created varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
   
   $ex = $connect2db->prepare($createTable);
   $ex->execute();
         // if($connect2db->query($createTable) === TRUE){
         //    echo "<script>alert('Table created');</script>";
         // }else{
         //  echo "<script>alert('Failed to create table, already exist');</script>";
         // } 

?>