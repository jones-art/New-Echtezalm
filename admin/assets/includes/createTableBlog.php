 <?php     

 $createTable = "CREATE TABLE IF NOT EXISTS blog
         (
         id int(11) NOT NULL AUTO_INCREMENT,
         blog_title varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         meta_keyword varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         meta_description varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         content varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         image varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         tag varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         created_on varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         created_by varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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