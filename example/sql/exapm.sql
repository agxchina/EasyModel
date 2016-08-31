CREATE TABLE `pirates` (
  `piratesid` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' comment '姓名',
  `order` tinyint(1) not null default 0  comment '入队顺序',
  `reward` int(10) NOT NULL default 0 comment '赏金',
  `devilnutid` tinyint(1) not null default 0 comment '拥有恶魔果实',
  `position` varchar(100)  NOT NULL default '' comment '职位',
  `sword` int(10)  NOT NULL default 0 comment '战斗值',
  `fight` varchar(100)  NOT NULL default '' comment '战斗方式',
  PRIMARY KEY  (`piratesid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment '海贼';

CREATE TABLE `devilnut` (
  `devilnutid` int(11) NOT NULL auto_increment,
  `devilnuttypeid` int(11) NOT NULL default 0 comment '果实类型',
  `devilnutname` varchar(100) NOT NULL default '' comment '果实名称',
  `color` varchar(100) NOT NULL default '' comment '果实颜色',
  `owner` int(10) NOT NULL default 0 comment '拥有者',
  `devilnutdescript` varchar(100) NOT NULL default '' comment '描述',
  PRIMARY KEY  (`devilnutid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8  comment '恶魔果实';

CREATE TABLE `devilnuttype` (
  `devilnuttypeid` int(11) NOT NULL auto_increment,
  `devilnuttyptename` varchar(100) NOT NULL default '' comment '果实类型名称',
  `devilnuttypedescript` varchar(100) NOT NULL default '' comment '果实类型描述',
  PRIMARY KEY  (`devilnuttypeid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8  comment '果实类型';

insert into devilnuttype values (1,'超人系','超人系....');
insert into devilnuttype values (2,'动物系','动物系....');
insert into devilnuttype values (3,'自然系','自然系....');

insert into devilnut values (1,1,'橡胶果实','橡胶果实..',1,'黄色');
insert into devilnut values (2,1,'花花果实','花花果实..',4,'黄色');
insert into devilnut values (3,2,'人人果实','人人果实..',5,'蓝色');
insert into devilnut values (4,3,'火火果实','火火果实..',1,'红色');

insert into pirates values (1,'路飞',1,4000000000,1,'船长',999999,'橡胶jet、橡胶图章');
insert into pirates values (2,'索罗',2,2000000000,0,'武士、杂工',888888,'三刀流');
insert into pirates values (3,'娜美',3,20000000,0,'航海士',1000,'大棍子');
insert into pirates values (4,'罗宾',4,80000000,1,'历史学家',666666,'手');
insert into pirates values (5,'乔巴',5,20000000,1,'船医',222222,'变身');

CREATE TABLE `t_menu` (
  `menuid` char(36) NOT NULL,
  `parentid` char(36) DEFAULT NULL,
  `menu_name` varchar(200) DEFAULT NULL,
  `menu_descript` varchar(200) DEFAULT NULL,
  `sref` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '参数',
  `isParent` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否有子节点',
  `level` varchar(200) DEFAULT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `add_userid` char(36) DEFAULT NULL,
  `delete_userid` char(36) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单导航表';

INSERT INTO `t_menu` VALUES ('000', '-1', '菜单', '菜单', 'd', '', '0', '0', '', '2', '0', '', '', '2016-07-18 16:42:32', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('04f4438c-c66d-32fb-8744-ea2cf8e1009c', 'ea9c75f7-d7a8-3f69-9d3f-70aec917bfb2', '教室座位', '教室座位', 'app.seatmanage', '', '0', '0', '0', '0', '0', '', '', '2016-07-01 09:26:08', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('178e238e-884c-3959-9baf-8780ca58b23d', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '添加咨询', '二级导航', 'app.consultation', '', '0', '0', '0', '0', '0', '', '', '2016-06-21 14:20:06', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('3113543a-89a0-3544-b5e5-6ebb4cc2cc63', 'd8ce9092-2c7c-11e6-83c2-0050569ffab9', '菜单管理', '权限管理', 'app.rightsmanagement', '', '0', '0', '', '9', '0', '', '0000-00-00 00:00:00', '2016-07-18 16:42:14', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('326fd1b9-6b3e-3299-931e-c0bd4807e7cc', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '无效管理', '无效管理', 'app.invalidManagement', '', '0', '0', '0', '0', '0', '', '', '2016-07-05 20:35:41', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('44817bcc-06a1-3d35-ada2-897e530980de', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '添加反馈', '添加反馈', 'app.feedback', '', '0', '0', '0', '0', '0', '', '', '2016-06-28 19:36:10', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('4eabbda0-b34f-3e8a-9833-9e18bbdbb058', 'ea9c75f7-d7a8-3f69-9d3f-70aec917bfb2', '报名排队', '报名排队', 'app.cutinline', '', '0', '0', '0', '0', '0', '', '', '2016-07-08 10:08:00', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('4f56ca8d-2c7d-11e6-83c2-0050569ffab9', 'd8ce9092-2c7c-11e6-83c2-0050569ffab9', '角色管理', '二级导航', 'app.roles', '', '0', '0', '', '10', '0', '', '', '2016-07-18 16:42:16', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('6b7eb83a-5c67-30ff-a1a9-28f943abbd11', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '审批流', '审批流', 'app.approval', null, '0', '1', '0', '0', '0', '', '', '2016-07-20 13:35:42', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('7d051081-2c7d-11e6-83c2-0050569ffab9', 'd8ce9092-2c7c-11e6-83c2-0050569ffab9', '角色与功能菜单管理', '三级导航', 'app.rolerights', '', '1', '0', '', '13', '0', '', '', '2016-06-20 17:54:06', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('82d2e43c-2c7d-11e6-83c2-0050569ffab9', 'd8ce9092-2c7c-11e6-83c2-0050569ffab9', '用户授权', '三级导航', 'app.usergroupmanagement', '', '1', '0', '', '14', '0', '', '', '2016-06-20 17:54:06', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('95382146-c970-32cd-b6fb-fcbb1eb1dfda', '6b7eb83a-5c67-30ff-a1a9-28f943abbd11', '我的审批流程', '我的审批流程', 'app.allApproval', null, '0', '0', '0', '0', '0', '', '', '2016-07-20 13:40:16', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '000', '咨询管理', '咨询管理', '~', '1', '0', '1', '0', '1', '0', '', '', '2016-06-21 14:27:48', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('9fe814e9-e039-3cae-bfa8-62a8f8922ed3', 'd8ce9092-2c7c-11e6-83c2-0050569ffab9', '基础数据', '基础数据1', 'basivarea', '', '0', '1', '', '15', '0', '', '0000-00-00 00:00:00', '2016-07-11 15:16:41', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('acc45a3a-2c7d-11e6-83c2-0050569ffab9', 'e6238842-2c7c-11e6-83c2-0050569ffab9', '建表', '二级导航', 'app.jianbiao', '', '0', '0', '', '7', '0', '', '', '2016-07-18 16:42:26', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('b05f8102-2c7d-11e6-83c2-0050569ffab9', 'e6238842-2c7c-11e6-83c2-0050569ffab9', '反馈', '二级导航', 'edu.hxsd.test', '', '0', '0', '', '6', '0', '', '', '2016-06-13 16:32:41', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('b418b231-2c7d-11e6-83c2-0050569ffab9', 'e6238842-2c7c-11e6-83c2-0050569ffab9', '报名', '二级导航', 'app.studentapply', '', '0', '0', 'e6238842-2c7c-11e6-83c2-0050569ffab9_', '6', '0', '', '', '2016-06-20 10:10:23', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('b4e7ec31-4cb7-32e9-838e-e4430c0cb7ce', '9fe814e9-e039-3cae-bfa8-62a8f8922ed3', '地域', '地域', 'app.areadimension', '', '0', '0', '', '1', '0', '', '0000-00-00 00:00:00', '2016-06-15 13:16:09', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('b9459489-2c7d-11e6-83c2-0050569ffab9', 'e6238842-2c7c-11e6-83c2-0050569ffab9', '缴费', '二级导航ff', 'app.jifei', '', '0', '0', 'e6238842-2c7c-11e6-83c2-0050569ffab9_', '4', '0', '', '', '2016-07-18 16:42:37', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('c0057045-7af9-3925-9547-2136bd71694a', 'd8ce9092-2c7c-11e6-83c2-0050569ffab9', '用户组管理', '用户组管理', 'app.userteammanagement', '', '0', '0', '', '11', '0', '', '0000-00-00 00:00:00', '2016-06-20 17:49:17', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('c311c756-e8fb-33e4-af2d-ad67c2f5326a', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '废弃管理', '废弃管理', 'app.discardManagement', '', '0', '0', '0', '0', '0', '', '', '2016-07-05 09:28:29', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('c40c4d60-25ca-3192-9790-142ccc2dbf68', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '教育顾问', '教育顾问', 'app.education_adviser', '', '0', '0', '0', '0', '0', '', '', '2016-06-24 09:16:27', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('d8ce9092-2c7c-11e6-83c2-0050569ffab9', '000', '后台设置', '一级导航', 'edu.hxsd.test', '3', '0', '1', '', '3', '0', '', '', '2016-07-18 16:41:44', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('da234c53-ff14-382a-aa60-2c1e963d388b', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '咨询量管理', '咨询量管理', 'app.Inquiriesmanage', '', '0', '0', '0', '0', '0', '', '', '2016-06-20 17:03:49', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('e6238842-2c7c-11e6-83c2-0050569ffab9', '9bc0436b-ee7d-30a1-b691-8d940a6d4d2c', '招生管理', '一级导航', 'df', '', '0', '1', '', '1', '0', '', '', '2016-07-18 16:42:27', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('e837d650-692b-3725-bb58-51f2c4808957', '6b7eb83a-5c67-30ff-a1a9-28f943abbd11', '我发起的流程', '我发起的流程', 'app.myApprove', null, '0', '0', '0', '0', '0', '', '', '2016-07-20 13:40:41', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('ea9c75f7-d7a8-3f69-9d3f-70aec917bfb2', '000', '已报名管理', '已报名管理', '#', '2', '0', '1', '', '2', '0', '', '', '2016-07-18 16:41:35', '0000-00-00 00:00:00', null);
INSERT INTO `t_menu` VALUES ('f3c240ef-26ab-3a4d-a21d-3528c92ea5e9', '9fe814e9-e039-3cae-bfa8-62a8f8922ed3', '系-专业', '系-专业', 'app.majordimension', '', '0', '0', '', '2', '0', '', '0000-00-00 00:00:00', '2016-06-20 17:31:30', '0000-00-00 00:00:00', null);

