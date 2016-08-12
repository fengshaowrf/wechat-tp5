CREATE TABLE `tp_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(128) NOT NULL,
  `app_secret` varchar(128) NOT NULL,
  `original_id` varchar(64) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `ping_key` varchar(128) DEFAULT NULL,
  `ping_test_key` varchar(128) DEFAULT NULL,
  `ping_id` varchar(128) DEFAULT NULL,
  `ping_mode` int(1) DEFAULT '1',
  `qr_code` varchar(128) DEFAULT '',
  `forward_url` varchar(255) DEFAULT NULL,
  `forward_token` varchar(255) DEFAULT NULL,
  `host` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

