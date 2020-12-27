 <?php     

 $createTable = "CREATE TABLE IF NOT EXISTS ayas
         (
         id int(11) NOT NULL AUTO_INCREMENT,
         page_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         page_title varchar(255), 
         status enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
         file1 varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         file2 varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         file3 varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         uploaded_on timestamp,
         uploaded_by varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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