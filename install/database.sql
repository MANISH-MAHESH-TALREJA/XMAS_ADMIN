--
-- Database: `envato_christmas_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'viaviwebtech@gmail.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home_banner`
--

CREATE TABLE `tbl_home_banner` (
  `id` int(11) NOT NULL,
  `banner_name` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `banner_image` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `banner_url` varchar(150) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE `tbl_quiz` (
  `id` int(10) NOT NULL,
  `quiz_title` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `option1` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `option2` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `option3` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `option4` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `quiz_ans` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`id`, `quiz_title`, `option1`, `option2`, `option3`, `option4`, `quiz_ans`, `status`) VALUES
(22, 'What does Alvin want for Christmas?', 'A Hula Hoop', 'An iPod', 'A Bottle of Rum', 'A New Car', 'A Hula Hoop', 1),
(23, 'What is the all-time best-selling Christmas recording?', 'Jingle Bells', 'White Christmas', 'Rudolph the Red-Nosed Reindeer', 'Frosty the Snowman', 'White Christmas', 1),
(24, 'What is the name of Tiny Tim\\\'s father in the story, \\\'A Christmas Carol\\\'?', 'The Scandinavian drink \'Glogg\' ', 'The French drink \'Lait de Poule\'', 'The Austrian drink \'Gluhwein', 'The German drink \'Biersuppe\'', 'The French drink \'Lait de Poule\'', 1),
(25, 'What should little children leave out for Santa on Christmas Eve?', 'A Bottle of Wine', 'Chewing Gum', 'Cookies and Milk', 'Chedder Cheese', 'Cookies and Milk', 1),
(26, 'What tree is mentioned in the Christmas song ?Twelve Days of Christmas??', 'A Lemon Tree', 'A Plum Tree A', 'A Pear Tree', 'An Apple Tree', 'A Pear Tree', 1),
(27, 'When are the \\\'12 Days of Christmas\\\'?', 'December 21 to January 1', 'Christmas Eve to January 4', 'December 26 to January 6', 'December 14 to December 25', 'December 26 to January 6', 1),
(28, 'When is the \\\'Feast of Stephen\\\'?', 'December 12', 'January 1', 'December 6', 'December 26', 'December 26', 1),
(29, 'Where did the real St. Nicholas live?', 'North Pole', 'Holland', 'Germany', 'Turkey', 'Turkey', 1),
(30, 'Where does Santa Claus live?', 'Iceland', 'Turkey', 'Scotland', 'Lapland', 'Lapland', 1),
(31, 'Where was Mommy kissing Santa Claus?', 'In the Corner', 'In a Dark Alley', 'In the Bedroom', 'Under the Mistletoe', 'Under the Mistletoe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ringtone`
--

CREATE TABLE `tbl_ringtone` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ringtone_name` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `ringtone_link` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `tags` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_ringtone`
--

INSERT INTO `tbl_ringtone` (`id`, `user_id`, `ringtone_name`, `ringtone_link`, `tags`, `total_views`, `status`) VALUES
(1, 1, 'chipmunk_christmaseee', '9342_test.mp3', 'ring2', 9, 1),
(6, 1, 'christmas_bells', '33851_test.mp3', 'ring4', 9, 1),
(9, 1, 'chipmunk christmas1', '73018_test.mp3', 'xmas', 17, 1),
(10, 1, 'Rain over me', '72727_Rain-over-me.mp3', 'Ringtone', 1, 1),
(11, 1, 'Why I Love You So Much', '18398_Why-I-Love-You-So-Much.mp3', 'Ringtone', 0, 1),
(12, 1, 'Romantic violin smartphone', '36178_Romantic-violin-smartphone.mp3', 'Romantic', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `onesignal_app_id` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `onesignal_rest_key` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `envato_buyer_name` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `envato_purchase_code` text CHARACTER SET utf8mb4 NOT NULL,
  `envato_buyer_email` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `envato_purchased_status` int(1) NOT NULL DEFAULT 0,
  `package_name` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `app_fcm_key` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `app_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_logo` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_version` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_author` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_contact` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_website` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_description` text CHARACTER SET utf8mb4 NOT NULL,
  `app_developed_by` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_privacy_policy` text CHARACTER SET utf8mb4 NOT NULL,
  `app_update_status` varchar(10) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false',
  `app_new_version` double NOT NULL DEFAULT 1,
  `app_update_desc` text CHARACTER SET utf8mb4 NOT NULL,
  `app_redirect_url` text CHARACTER SET utf8mb4 NOT NULL,
  `cancel_update_status` varchar(10) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false',
  `banner_ad_type` varchar(30) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'admob',
  `banner_facebook_id` text CHARACTER SET utf8mb4 NOT NULL,
  `interstital_ad_type` varchar(30) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'admob',
  `interstital_facebook_id` text CHARACTER SET utf8mb4 NOT NULL,
  `native_ad` varchar(20) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false',
  `native_ad_type` varchar(30) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'admob',
  `native_ad_id` text CHARACTER SET utf8mb4 NOT NULL,
  `native_facebook_id` text CHARACTER SET utf8mb4 NOT NULL,
  `native_cat_position` int(10) NOT NULL DEFAULT 1,
  `native_position` int(10) NOT NULL DEFAULT 1,
  `publisher_id` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `interstital_ad` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `interstital_ad_id` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `interstital_ad_click` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `banner_ad` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `banner_ad_id` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `android_ad_network` text CHARACTER SET utf8mb4 NOT NULL,
  `banner_applovin_id` text CHARACTER SET utf8mb4 NOT NULL,
  `interstitial_applovin_id` text CHARACTER SET utf8mb4 NOT NULL,
  `native_applovin_id` text CHARACTER SET utf8mb4 NOT NULL,
  `start_ads_id` text CHARACTER SET utf8mb4 NOT NULL,
  `banner_wortise_id` varchar(255) DEFAULT NULL,
  `interstitial_wortise_id` varchar(255) DEFAULT NULL,
  `native_wortise_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `onesignal_app_id`, `onesignal_rest_key`, `envato_buyer_name`, `envato_purchase_code`, `envato_buyer_email`, `envato_purchased_status`, `package_name`, `app_fcm_key`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `app_update_status`, `app_new_version`, `app_update_desc`, `app_redirect_url`, `cancel_update_status`, `banner_ad_type`, `banner_facebook_id`, `interstital_ad_type`, `interstital_facebook_id`, `native_ad`, `native_ad_type`, `native_ad_id`, `native_facebook_id`, `native_cat_position`, `native_position`, `publisher_id`, `interstital_ad`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `android_ad_network`, `banner_applovin_id`, `interstitial_applovin_id`, `native_applovin_id`, `start_ads_id`, `banner_wortise_id`, `interstitial_wortise_id`, `native_wortise_id`) VALUES
(1, '', '', '', '', '-', 0, 'com.vpapps.christmasfun', 'AAAAANHTqdo:APA91bELFY3QQ64MeA0lP94YTyjGc8cIja8_eHrVHtAXVC0rfL0xOvS-EB0OIKrsxMFxOt1mU6ZYKbNX4p16kEh8hshcUmFusrb5C9AQ6uimEA5l0Q-py2ZAzH6dOnuOJpIQErtOeQCidf', 'Christmas Fun Special', 'icon.png', 'info@viaviweb.com', '1.0.0', 'viaviwebtech', '+91 9227777522', 'www.viaviweb.com', '<p>As Viavi Webtech is finest offshore IT company which has expertise in the below mentioned all technologies and our professional, dedicated approach towards our work has always satisfied our clients as well as users. We have reached to this level because of the dedication and hard work of our 10+ years experienced team as well as new ideas of freshers, they always provide the best solutions. Here are the promising services served by Viavi Webtech.</p>\r\n\r\n<p>Contact on Skype &amp; Email for more information.</p>\r\n\r\n<p><strong>Skype ID:</strong> support.viaviweb <strong>OR</strong> viaviwebtech</p>\r\n\r\n<p><strong>Email:</strong> info@viaviweb.com <strong>OR </strong>viaviwebtech@gmail.com</p>\r\n\r\n<p><strong>Website:</strong> http://www.viaviweb.com</p>\r\n', 'Viavi Webtech', '<p><strong>We are committed to protecting your privacy</strong></p>\r\n\r\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\r\n\r\n<p><strong>Information Collected</strong></p>\r\n\r\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\r\n\r\n<p><strong>Information Use</strong></p>\r\n\r\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\r\n\r\n<p><strong>Disclosing Information</strong></p>\r\n\r\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\r\n\r\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\r\n\r\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\r\n\r\n<p><strong>Changes to this Policy</strong></p>\r\n\r\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\r\n\r\n<p><strong>Contacting Us</strong></p>\r\n\r\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at hd@dummy.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>\r\n', 'false', 1, 'New app update', 'https://play.google.com/store/apps/developer?id=Viaan+Parmar', 'true', 'admob', 'Only Admin Can See', 'admob', '', 'true', 'facebook', '', '', 2, 6, '', 'true', '', '5', 'true', '', '', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms`
--

CREATE TABLE `tbl_sms` (
  `id` int(10) NOT NULL,
  `sms` text CHARACTER SET utf8mb4 NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sms`
--

INSERT INTO `tbl_sms` (`id`, `sms`, `status`) VALUES
(2, 'As Santa Claus fill our house\r\nwith his loving gifts,\r\nlet us fill our hearts with all\r\nthat is beautiful!\r\nLove, Blessings and lots of Christmafdeewxwdswdewds Wishes!', 1),
(8, 'Bells are ringing the wishes of christmas day the flying snowflakes send my most sincere blessings to you merry christmas. ', 1),
(19, 'From home to home and heart to heart,\r\nFrom one place to another,\r\nThe warmth and joy of Christmas,\r\nBrings us closer to each other.\r\nMerry X-Mas', 1),
(20, 'Let the spirit of love gently fill our hearts and homes.\r\nLet the spirit of joy and generous cheer fill our hearts and homes.\r\nLet the cherish moments of Christmas bring happiness and prosperity for everyone.', 1),
(21, 'Christmas ka yeh pyara tyohaar\r\nJeevan mein laye khushiyan apaar,\r\nSanta clause aaye aapke dwar,\r\nSubhkamna hamari kare sweekar.\r\nMerry Christmas.', 1),
(22, 'Lets welcome the year which is fresh and new,\r\nLets cherish each moment it beholds, \r\nLets celebrate this blissful New year. Merry X-mas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallpaper`
--

CREATE TABLE `tbl_wallpaper` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `wall_name` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `tags` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_wallpaper`
--

INSERT INTO `tbl_wallpaper` (`id`, `user_id`, `image`, `wall_name`, `tags`, `status`, `total_views`) VALUES
(30, 1, '5740_15_2016.jpg', 'Christmas Wallpaper', 'Christmas Wallpaper, Christmas Tree', 1, 19),
(31, 1, '77452_16_2016.jpeg', 'Christmas Wallpaper', 'Christmas Wallpaper, Christmas Tree', 1, 34),
(32, 1, '91170_17_2016.jpeg', 'Christmas Wallpaper', 'Christmas Wallpaper, Christmas Tree', 1, 30),
(33, 1, '47513_18_2016.jpeg', 'Christmas Wallpaper', 'Christmas Wallpaper, Christmas Tree,Christmas', 1, 20),
(34, 1, '76376_19_2016.jpg', 'Christmas Wallpaper', 'Christmas Wallpaper, Christmas Tree', 1, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ringtone`
--
ALTER TABLE `tbl_ringtone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sms`
--
ALTER TABLE `tbl_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wallpaper`
--
ALTER TABLE `tbl_wallpaper`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_ringtone`
--
ALTER TABLE `tbl_ringtone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sms`
--
ALTER TABLE `tbl_sms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_wallpaper`
--
ALTER TABLE `tbl_wallpaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;