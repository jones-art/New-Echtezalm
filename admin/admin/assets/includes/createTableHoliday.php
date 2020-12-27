 <?php     
 $createTable = "CREATE TABLE IF NOT EXISTS tbl_holiday
         (
         id int(11) NOT NULL AUTO_INCREMENT,
         holiday_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
         date varchar(55) COLLATE utf8_unicode_ci NOT NULL,
         created_on varchar(55) COLLATE utf8_unicode_ci NOT NULL,
         created_by int(55),
         PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
   
   $ex = $connect2db->prepare($createTable);
   $ex->execute();
?>