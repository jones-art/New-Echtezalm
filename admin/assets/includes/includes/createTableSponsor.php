<?php

$createSponsorTable = "CREATE TABLE IF NOT EXISTS `sponsors` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `uploaded_on` timestamp NOT NULL,
 `uploaded_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

$ex = $connect2db->prepare($createSponsorTable);
$ex->execute();
?>