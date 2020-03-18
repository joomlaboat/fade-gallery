CREATE TABLE IF NOT EXISTS `#__fadegallery` (
  `id` int(10) NOT NULL auto_increment,
  `galleryname` varchar(50) NOT NULL,
  `folder` varchar(255),
  `filelist` text NOT NULL,
  `width` int(10) unsigned NOT NULL DEFAULT '400',
  `height` int(10) unsigned NOT NULL DEFAULT '300',
  `interval` int(10) unsigned NOT NULL DEFAULT '6000',
  `fadetime` int(10) unsigned NOT NULL DEFAULT '2000',
  `fadestep` int(10) unsigned NOT NULL DEFAULT '20',
  `align` varchar(20),
  `cssstyle` varchar(255),
  `padding` int(6) unsigned NOT NULL DEFAULT '0',
  `randomize` int(1) NOT NULL DEFAULT '0',
  `thelink` varchar(255),
  
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
